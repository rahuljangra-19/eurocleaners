<?php

namespace App\Observers;

use App\Models\Component;

class ComponentObserver
{
    /**
     * Handle the Component "created" event.
     */
    public function updating(Component $component): void
    {
    
        $items = $component->items;
        $originalItems = $component->getOriginal('items');

        if (empty($items['image'])) {
            $items['image'] = isset($originalItems['image']) ? $originalItems['image'] : null;
            $component->items = $items;
        }
    }

    /**
     * Handle the Component "updated" event.
     */
    public function updated(Component $component): void
    {
        //
    }

    /**
     * Handle the Component "deleted" event.
     */
    public function deleted(Component $component): void
    {
        //
    }

    /**
     * Handle the Component "restored" event.
     */
    public function restored(Component $component): void
    {
        //
    }

    /**
     * Handle the Component "force deleted" event.
     */
    public function forceDeleted(Component $component): void
    {
        //
    }
}
