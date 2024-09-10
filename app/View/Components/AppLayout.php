<?php

namespace App\View\Components;

use App\Models\Language;
use App\Services\Navbar\NavbarBuilder;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class AppLayout extends Component
{
    public $navbarItems;
    public $haveContactPage;
    public $languageMeta;

    /**
     * Create a new component instance.
     */
    public function __construct(NavbarBuilder $navbarBuilder)
    {
        $this->navbarItems = $navbarBuilder->build();
        $this->haveContactPage = haveContactPage();
        $localeId =  Session::get('local_lang_id') ?? config('app.local_lang_id');
        $this->languageMeta = Language::find($localeId)->meta;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.app', ['navbarItems' => $this->navbarItems, 'haveContactPage' => $this->haveContactPage, 'languageMeta' => $this->languageMeta]);
    }
}
