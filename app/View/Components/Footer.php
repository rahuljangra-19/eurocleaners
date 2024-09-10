<?php

namespace App\View\Components;

use App\Models\Component as ModelsComponent;
use App\Models\Language;
use App\Models\Page;
use App\Models\Project;
use App\Models\Service;
use App\Services\Page\PageUrlBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Footer extends Component
{
    public $data;
    public $services;
    public $projects;
    public $languageMeta;
    /**
     * Create a new component instance. 
     */
    public function __construct(
        private PageUrlBuilder $pageUrlBuilder
    ) {
        $localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');
        $this->data = ModelsComponent::where(['name' => 'footer', 'is_published' => true, 'language_id' => $localeId])->first()->items;
        $this->services = Service::where(['language_id' => $localeId, 'is_published' => true])->inRandomOrder()->limit(6)->where('language_id', $localeId)->get()->map(function ($query) {
            $query->slug =  $this->pageUrlBuilder->build($query, false);
            return $query;
        });
        $this->projects = Project::where(['language_id' => $localeId, 'is_published' => true])->inRandomOrder()->limit(4)->get()->map(function ($query) {
            $query->slug =  $this->pageUrlBuilder->build($query, false);
            return $query;
        });
        $this->languageMeta = Language::find($localeId)->meta;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.footer', ['data' => $this->data, 'services' => $this->services, 'projects' => $this->projects, 'languageMeta' => $this->languageMeta]);
    }
}
