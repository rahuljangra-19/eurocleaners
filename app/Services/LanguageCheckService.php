<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;

trait LanguageCheckService
{

    public function checkLanguageStatus()
    {
        $localeId =  Session::get('local_lang_id') ?? config('app.local_lang_id');
        $language = Language::find($localeId);
        if (empty($language)) { // Language is deleted or disabled
            $language = Language::where('is_default', 1)->first();
            if ($language) {
                Session::forget('locale');
                Session::forget('local_lang_id');
                Artisan::call('optimize:clear');

                Session::put([
                    'locale' => $language->code,
                    'local_lang_id' => $language->id,
                ]);
                App::setLocale($language->code);
                Config::set('app.local_lang_id', $language->id);
                Session::save();

                return redirect()->to(URL('/'));
            } else {
                abort(500, 'No default language found');
            }
        }
        return true;
    }
}
