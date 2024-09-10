<?php

namespace App\Observers;

use App\Models\Project;
use App\Traits\SlugTrait;

class ProjectObserver
{
    use SlugTrait;
    public $parentPageName = 'Projects';
    /**
     * Handle the Project "created" event.
     */
    public function creating(Project $project): void
    {
        $project->parent_page_name = 'Projects';
        // $project->slug =   $this->createChildSlug($project, $this->parentPageName);
    }

    /**
     * Handle the Project "updated" event.
     */
    public function updating(Project $project): void
    {
        $project->parent_page_name = 'Projects';
    }

    /**
     * Handle the Project "deleted" event.
     */
    public function deleted(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     */
    public function restored(Project $project): void
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     */
    public function forceDeleted(Project $project): void
    {
        //
    }
}
