<?php

namespace App\Services\Navbar;

use App\Models\Page;
use App\Models\Project;
use App\Models\Service;
use App\Services\Page\PageUrlBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

readonly class NavbarBuilder
{
    public function __construct(
        private PageUrlBuilder $pageUrlBuilder
    ) {}

    /**
     * @return NavbarItem[]
     */
    public function build(): array
    {
        /** @var Collection<Page> $allPages */
        $localeId =  Session::get('local_lang_id') ?? config('app.local_lang_id');
        $pages = Page::query()
            ->where(['language_id' => $localeId, 'is_published' => true, 'is_menu' => true, 'parent_page' => null])
            // ->orderBy('sort_order', 'desc')
            ->get();

        $navbarItems = [];

        foreach ($pages as $page) {
            $childrenNavbarItems = [];
            // Check if this page has a submenu
            if ($page->have_sub_menu) {
                // Fetch child pages
                $childrenPages = Page::where('parent_page', $page->id)->get();
                // Check for specific page types 
                if (in_array($page->page_name, ['Services', 'Projects'])) {
                    $query = match ($page->page_name) {
                        'Projects' => Project::where('language_id', $localeId),
                        'Services' => Service::where('language_id', $localeId),
                    };
                    $childPages = $query->orderBy('sort_order')->get();
                    foreach ($childPages as $childrenPage) {
                        $childrenNavbarItems[] = new NavbarItem(
                            $childrenPage->title,
                            $this->pageUrlBuilder->build($childrenPage, false),
                            []
                        );
                    }
                } else {
                    foreach ($childrenPages as $childrenPage) {
                        $childrenNavbarItems[] = new NavbarItem(
                            $childrenPage->title,
                            $this->pageUrlBuilder->build($childrenPage, false),
                            []
                        );
                    }
                }
            }

            // Add the page to the navbar items
            $navbarItems[] = new NavbarItem(
                $page->title,
                $this->pageUrlBuilder->build($page, false),
                $childrenNavbarItems
            );
        }

        return $navbarItems;
    }
}
