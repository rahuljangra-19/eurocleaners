<?php

namespace App\Observers;

use App\Models\Post;
use App\Traits\SlugTrait;

class PostObserver
{
    use SlugTrait;

    public $parentSlug = 'blogs/';
    /**
     * Handle the Post "created" event.
     */
    public function creating(Post $post): void
    {
        $post->sort_order = $post->id;
        $post->parent_page_name = 'Blogs';
    }

    /**
     * Handle the Post "updated" event.
     */
    public function updating(Post $post): void
    {
        $post->sort_order = $post->id;
        $post->parent_page_name = 'Blogs';

    }

    /**
     * Handle the Post "deleted" event.
     */
    public function deleted(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     */
    public function restored(Post $post): void
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     */
    public function forceDeleted(Post $post): void
    {
        //
    }
}
