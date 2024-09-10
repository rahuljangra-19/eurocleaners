<?php

namespace App\Traits;

use App\Models\Language;
use App\Models\Page;
use Illuminate\Support\Str;

trait SlugTrait
{
    public function __construct() {}

    function getParentSlug($parentId)
    {
        $page = Page::where('id', $parentId)->first();
        if ($page) {
            return $page->slug;
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
            $parentPageSlug = $parentPageSlug;
        } else {
            // if no parent page found then default language page slug will be added .
            $defaultLanguageParentPageSlug = Page::where('language_id', Language::where('is_default', true)->first()->id)->where('page_name', $parentPageName)->first();
            $parentPageSlug = $defaultLanguageParentPageSlug->slug;
        }

        if (!Str::startsWith($data->slug, $parentPageSlug)) {
            return ltrim($parentPageSlug . '/' . $data->slug, '/');
        }
        return $data->slug;
    }

    function getParentSlugFromName($pageName, $lang)
    {
        $page = Page::where(['page_name' => $pageName, 'language_id' => $lang])->first();
        if ($page) {
            return $page->slug;
        }
    }
}
