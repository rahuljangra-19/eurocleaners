<?php

namespace App\View\Components;

use App\Models\Page;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Services\Page\PageUrlBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Projects extends Component
{
    public $data;
    public $localeId;
    public $category;

    /** 
     * Create a new component instance.
     */
    public function __construct(private PageUrlBuilder $pageUrlBuilder, $data, $category = null)
    {
        $this->localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');

        $this->data = $data['attributes'];
        $this->category = $category ?? ProjectCategory::where('language_id', $this->localeId)->get();
       
        $this->data['items'] =  $this->getAllProjects();
    }

    
    private function getAllProjects()
    {
        return Project::where('is_published', true)->where('language_id', $this->localeId)->get()->map(function ($query) {
            $query->category = ProjectCategory::whereIn('id', json_decode($query->category, true))->pluck('name')->toArray();
            $query->slug =  $this->pageUrlBuilder->build($query, true);
            return $query;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.projects', ['category' => $this->category, 'data' => $this->data]);
    }
}
