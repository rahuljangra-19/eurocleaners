<?php

namespace App\Http\Controllers;

use App\Models\Language;
use App\Models\Page;
use App\Models\User;
use App\Services\LanguageCheckService;
use App\Services\LanguageStatus;
use App\Services\Page\PageCacheBuilder;
use App\Services\Page\PageUrlBuilder;
use Illuminate\Container\Attributes\Cache;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Laravel\Nova\Fields\Slug;
use PharIo\Manifest\Url;

class PageController extends Controller
{
    use LanguageCheckService;

    private $languages = [];
    private $default_lang_code, $default_lang_id;
    public function __construct()
    {
        $this->languages = Language::pluck('code')->toArray();
        $language = Language::where('is_default', true)->first();
        if ($language) {
            $this->default_lang_code = $language->code;
            $this->default_lang_id = $language->id;
        }
    }

    public function index(Request $request, PageCacheBuilder $pageCacheBuilder, PageUrlBuilder $pageUrlBuilder)
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'language' => 'required|string|in:' . implode(',', $this->languages),
                'language_id' => 'required|integer',
                'page_slug' => 'required|string',
                'page_id' => 'required|integer'
            ]);

            $locale = $validated['language'];
            $language_id = $validated['language_id'];
            $page_slug = urldecode($validated['page_slug']);

            $pages = $this->prepareSlugCatalog($pageCacheBuilder, $pageUrlBuilder);
            
            if (array_key_exists($page_slug, $pages)) {
                $page = $pages[$page_slug];

                if ($page) {
                    Session::put([
                        'locale' => $locale,
                        'default_lang_code' => $this->default_lang_code,
                        'default_lang_id' => $this->default_lang_id,
                        'local_lang_id' => $language_id,
                    ]);
                    App::setLocale($locale);
                    Config::set('app.local_lang_id', $language_id);

                    $pageId = $page->translated_page_id ?: $page->id;

                    $translatedPage = $page->model::where(function ($query) use ($pageId) {
                        $query->where('translated_page_id', $pageId)
                            ->orWhere('id', $pageId);
                    })
                        ->where('language_id', $language_id)
                        ->first();
                    if ($translatedPage) {
                        $url = url($pageUrlBuilder->build($translatedPage, false));
                    } else {
                        $url = ($locale === $this->default_lang_code) ? url('/') : url('/' . $locale);
                    }
                    return redirect()->to($url);
                }
            }
            return redirect()->back()->withErrors(['message' => 'Page not found.']);
        }
        return redirect()->back()->withErrors(['message' => 'Invalid request method.']);
    }


    public function load(Request $request, PageCacheBuilder $pageCacheBuilder,  PageUrlBuilder $pageUrlBuilder)
    {
        $result = $this->checkLanguageStatus();
        if ($result instanceof RedirectResponse) {
            return $result;
        }
        $slug = $request->path();
        $slug = urldecode($slug);
        $slugCatalog = $this->prepareSlugCatalog($pageCacheBuilder, $pageUrlBuilder);
        if (!array_key_exists($slug, $slugCatalog)) {
            abort(404);
        }
        $page = $slugCatalog[$slug];
        return view('pages.index', [
            'page' => $page,
        ]);
    }

    // protected function checkLanguageStatus($localeId)
    // {
    //     $language = Language::find($localeId);
    //     if (empty($language)) { // Language is deleted or disabled
    //         $language = Language::where('is_default', 1)->first();
    //         if ($language) {
    //             Session::forget('locale');
    //             Session::forget('local_lang_id');
    //             Artisan::call('optimize:clear');

    //             Session::put([
    //                 'locale' => $language->code,
    //                 'local_lang_id' => $language->id,
    //             ]);
    //             App::setLocale($language->code);
    //             Config::set('app.local_lang_id', $language->id);
    //             Session::save();
    //         } else {
    //             abort(500, 'No default language found');
    //         }
    //     }
    //     return true;
    // }

    public function createLocaleSlug($slug)
    {
        $locale =  Session::get('locale');
        $parts = explode('/', $slug);
        $currentLocale = in_array($parts[0], $this->languages) ? array_shift($parts) : null;
        $slugWithoutLocale = implode('/', $parts);

        if ($locale && $currentLocale !== $locale) {
            $slug = trim($locale . '/' . $slugWithoutLocale, '/');
        } elseif ($currentLocale) {
            $slug = trim($currentLocale . '/' . $slugWithoutLocale, '/');
        } else {
            $slug = trim($slug, '/');
        }
        return $slug;
    }

    /**
     * @return array<int, Pageable>
     */
    private function prepareSlugCatalog($pageCacheBuilder,  $pageUrlBuilder): array
    {
        $slugs = [];
        $pages = $pageCacheBuilder->getPages();
        foreach ($pages as $page) {
            $key = $pageUrlBuilder->build($page, false);
            $slugs[$key] = $page;
        }
        return $slugs;
    }
}
