<?php

namespace App\Services\Page;

use App\Interfaces\Pageable;
use App\Models\Language;
use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class PageUrlBuilder
{

    public function build(Pageable $pageable, bool $absolute = true): string
    {
        if (Session::get('default_lang_id')) {
            $default_lang_id = Session::get('default_lang_id');
        } else {
            $language = Language::where('is_default', true)->first();
            if ($language) {
                $default_lang_id = $language->id;
            } else {
                abort(403);
            }
        }
        if ($absolute) {
            $parts[] = URL('/');
        } else {
            $parts = [];
        }

        $slug = $pageable->getSlug();
        if (isset($pageable->parent_page) && !empty($pageable->parent_page)) {
            $slug = $this->createChildSlug($pageable, '', $pageable->parent_page);
        }
        if (isset($pageable->parent_page_name) && !empty($pageable->parent_page_name)) {
            $slug =  $this->createChildSlug($pageable, $pageable->parent_page_name);
        }

        if ($pageable->language_id == $default_lang_id) {
            $parts[] = $slug;
        } else {
            $langCode = $pageable->language ? $pageable->language->code : '';
            $parts[] = $langCode;
            $parts[] = $slug;
        }
        $slug = implode('/', $parts);

        if ($slug === '/') {
            return '/';
        }
        return trim($slug, '/');
    }

    function getParentSlug($parentId)
    {
        $page = Page::where('id', $parentId)->first();
        if ($page) {
            return $page->getSlug(); 
        }
    }

    function createChildSlug($data, $parentPageName = '', $parentId = '')
    {
        if (!empty($parentPageName)) {
            $parentPageSlug = $this->getParentSlugFromName($parentPageName, $data->language_id);
        }
        if (!empty($parentId)) {
            $parentPageSlug = $this->getParentSlug($parentId);
        }

        if ($parentPageSlug) {
            return ltrim($parentPageSlug . '/' . $data->getSlug(), '/');
        }
        // else {
        //     // if no parent page found then default language page slug will be added .
        //     $defaultLanguageParentPageSlug = Page::where('language_id', Language::where('is_default', true)->first()->id)->where('page_name', $parentPageName)->first();
        //     $parentPageSlug = $defaultLanguageParentPageSlug->slug;
        // }
        return $data->getSlug();
    }

    function getParentSlugFromName($pageName, $lang)
    {
        $page = Page::where(['page_name' => $pageName, 'language_id' => $lang])->first();
        if ($page) {
            return $page->getSlug();
        }
    }
}
