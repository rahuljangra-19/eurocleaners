<?php

namespace App\View\Components;

use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Services\Page\PageUrlBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class blogRightBar extends Component
{
    public $data;

    /**
     * Create a new component instance.
     */
    public function __construct(private PageUrlBuilder $pageUrlBuilder, $postId = '')
    {
        $localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');
        $this->data['services'] = Service::where(['language_id' => $localeId])->inRandomOrder()->get()->map(function ($query) {
            $query->slug =  $this->pageUrlBuilder->build($query, true);
            return $query;
        });
        $this->data['projects'] = Project::where(['language_id' => $localeId])->inRandomOrder()->get()->map(function ($query) {
            $query->slug =  $this->pageUrlBuilder->build($query, true);
            return $query;
        });
        if ($postId) {
            $this->data['posts']    = Post::where(['language_id' => $localeId])->whereNot('id', $postId)->latest()->limit(5)->get()->map(function ($query) {
                $query->slug =  $this->pageUrlBuilder->build($query, true);
                return $query;
            });
        } else {
            $this->data['posts']    = Post::where(['language_id' => $localeId])->latest()->limit(5)->get()->map(function ($query) {
                $query->slug =  $this->pageUrlBuilder->build($query, true);
                return $query;
            });
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog-right-bar', ['data' => $this->data]);
    }
}
