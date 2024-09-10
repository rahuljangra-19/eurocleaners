<?php

namespace App\Services\Page;

use App\Interfaces\Pageable;
use App\Models\Language;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;


class PageCacheBuilder
{
    /**
     * @var Collection<Pageable>
     */
    private Collection $pages;

    public function __construct()
    {
        $this->preparePagesCollection();
    }

    /**
     * @return Collection<Pageable>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    } 

    private function preparePagesCollection(): void
    {
        $pages = new Collection();
        $localeId =  Session::get('local_lang_id') ?? config('app.local_lang_id');

        foreach (Service::where(['language_id' => $localeId, 'is_published' => true])->with('language')->get() as $service) {
            $service->model = Service::class;
            $pages->push($service);
        }

        foreach (Post::where(['language_id' => $localeId, 'is_published' => true])->with('language')->get() as $post) {
            $post->model = Post::class;
            $pages->push($post);
        }

        foreach (Page::where(['language_id' => $localeId, 'is_published' => true])->with('language')->orderBy('sort_order', 'desc')->get() as $page) {
            $page->model = Page::class;
            $pages->push($page);
        }

        foreach (Project::where(['language_id' => $localeId, 'is_published' => true])->with('language')->get() as $project) {
            $project->model = Project::class;
            $pages->push($project);
        }
        $this->pages = $pages;
    }
}
