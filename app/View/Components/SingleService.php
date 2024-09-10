<?php

namespace App\View\Components;

use App\Models\Service;
use App\Services\Page\PageUrlBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class SingleService extends Component
{
    public $services, $data;
    /**
     * Create a new component instance.
     */
    public function __construct(private PageUrlBuilder $pageUrlBuilder, $data)
    {
        $localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');
        $this->data = $data['attributes'];
        $this->services = Service::where('language_id', $localeId)->limit(5)->inRandomOrder()->get()->map(function ($query) {
            $query->slug =  $this->pageUrlBuilder->build($query, false);
            return $query;
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.single-service', ['data' => $this->data, 'services' => $this->services]);
    }
}
