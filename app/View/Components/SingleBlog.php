<?php

namespace App\View\Components;

use App\Models\Page;
use App\Models\Post;
use App\Services\Page\PageUrlBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class SingleBlog extends Component
{
    public $data, $date;
    /** 
     * Create a new component instance.
     */
    public function __construct(
        readonly  private  PageUrlBuilder $PageUrlBuilder,
        $data,
        $date,
        $title,
        $id
    ) {
        $this->data = $data['attributes'];
        $this->data['created_at'] = $date;
        $this->data['title'] = $title;
        $this->data['id'] = $id;
        $this->data['author_details'] = ($this->data['author_details'][0]['attributes']) ? $this->data['author_details'][0]['attributes'] : [];
        $localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');

        $previous = Post::select('title', 'id', 'slug', 'parent_page_name','language_id')
            ->where('id', '<', $id)
            ->where('language_id', $localeId)
            ->first();
        $next = Post::select('title', 'id', 'slug', 'parent_page_name','language_id')->where('id', '>', $id)->where('language_id', $localeId)->first();

        if ($previous) {
            $previous->slug = $this->PageUrlBuilder->build($previous, true);
        }
        if ($next) {
            $next->slug = $this->PageUrlBuilder->build($next, true);
        }
        $this->data['previous'] = $previous;
        $this->data['next'] = $next;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.single-blog', ['post' => $this->data]);
    }
}
