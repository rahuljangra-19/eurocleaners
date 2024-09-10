<?php

namespace App\View\Components;

use App\Models\Service;
use App\Services\ParameterService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Contact extends Component 
{
    public $data;
    public $services;
    public $map, $google_key;
    /**
     * Create a new component instance.
     */
    public function __construct(ParameterService $parameterService, $data)
    {
        $localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');
        $this->services = Service::where(['language_id' => $localeId])->where('language_id', $localeId)->get();
        $this->data = $data['attributes'];
        $this->map = $parameterService->getParameter('map');
        $this->google_key = $parameterService->getParameter('google key')['key'] ?? null;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact', ['services' => $this->services, 'data' => $this->data, 'map' => $this->map, 'google_key' => $this->google_key]);
    }
}
