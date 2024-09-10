<?php

namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;
use App\Services\Page\PageUrlBuilder;

class Blogs extends Component
{
    public $data;
    /**
     * Create a new component instance.
     */
    public function __construct(private PageUrlBuilder $pageUrlBuilder, $data)
    {
        $this->data = $data['attributes'];
        $this->data['items'] =  $this->getAllBlogs();
    }

    private function getAllBlogs()
    {
        $localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');
        return Post::where('language_id', $localeId)->paginate(2)->through(function ($query) {
            $query->slug =  $this->pageUrlBuilder->build($query, true);
            return $query;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blogs', ['data' => $this->data]);
    }
}
