<?php

use App\Models\Page;
use Illuminate\Support\Facades\Session;

if (!function_exists('haveContactPage')) {

    function haveContactPage()
    {
        $page =  Page::where(['page_name' => 'Contact', 'is_menu' => 1, 'language_id' => Session::get('local_lang_id') ?? config('app.local_lang_id')])->first();
        if ($page) {
            $default_lang_id = Session::get('default_lang_id');
            $default_lang_code = Session::get('default_lang_code');
            $page->slug = ($default_lang_id == session('local_lang_id')) ? $page->slug : session('locale') . '/' . $page->slug;
            return $page;
        }
    }
}
