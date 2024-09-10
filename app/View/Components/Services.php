<?php

namespace App\View\Components;

use App\Models\Page;
use App\Models\Service;
use App\Services\Page\PageUrlBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Services extends Component
{
    public $data = [];
    public $localeId;

    /** 
     * Create a new component instance.
     */
    public function __construct(private PageUrlBuilder $pageUrlBuilder, $data)
    {
        $this->localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');
        $this->data = $data['attributes'];
        $this->data['items'] =  $this->getAllServices();
    }

    private function getAllServices()
    {
        return Service::where('is_published', true)->where('language_id', $this->localeId)->get()->map(function ($query) {
            $query->slug =  $this->pageUrlBuilder->build($query, true);
            return $query;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.services', ['data' => $this->data]);
    }
}
