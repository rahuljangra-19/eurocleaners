<?php

namespace App\Observers;

use App\Models\Service;
use App\Traits\SlugTrait;

class ServiceObserver
{
    use SlugTrait;
    public $parentSlug = 'services/';
    /**
     * Handle the Service "created" event.
     */
    public function creating(Service $service): void
    {
        //    $service->slug =   $this->createChildSlug($this->parentSlug, $service);
        $service->parent_page_name = 'Services';
    }

    /**
     * Handle the Service "updated" event.
     */
    public function updating(Service $service): void
    {
        $service->parent_page_name = 'Services';
    }

    /**
     * Handle the Service "deleted" event.
     */
    public function deleted(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "restored" event.
     */
    public function restored(Service $service): void
    {
        //
    }

    /**
     * Handle the Service "force deleted" event.
     */
    public function forceDeleted(Service $service): void
    {
        //
    }
}
