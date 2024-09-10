<?php

namespace App\View\Components;

use App\Models\Language;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;
use Illuminate\View\DynamicComponent;

class HeroSlider extends DynamicComponent
{
    public $data;
    public $languageMeta;
    public $haveContactPage;
    /**
     * Create a new component instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
        $localeId =  Session::get('local_lang_id') ?? config('app.local_lang_id');
        $this->languageMeta = Language::find($localeId)->meta;
        $this->haveContactPage = haveContactPage();
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero-slider', ['data' => $this->data['attributes'], 'languageMeta' => $this->languageMeta, 'haveContactPage' => $this->haveContactPage]);
    }
}
