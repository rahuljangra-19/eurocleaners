<?php

namespace App\Observers;

use App\Models\Page;
use App\Traits\SlugTrait;
use Illuminate\Support\Str;

class PageObserver
{
    use SlugTrait;

    /**
     * Handle the Page "created" event.
     */
    public function creating(Page $page): void
    {
        // if ($page->parent_page) {
        //     $page->slug =  $this->createChildSlug($page, '', $page->parent_page);
        // }
        $page->page_name =  ucfirst($page->title);
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updating(Page $page): void
    {
        // if ($page->parent_page) {
        //     $page->slug =  $this->createChildSlug($page, '', $page->parent_page);
        // }
        // $page->page_name =  ucfirst($page->title);
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleting(Page $page): void
    {
    }

    /**
     * Handle the Page "restored" event.
     */
    public function restored(Page $page): void
    {
        //
    }

    /**
     * Handle the Page "force deleted" event.
     */
    public function forceDeleted(Page $page): void
    {
        //
    }
}
