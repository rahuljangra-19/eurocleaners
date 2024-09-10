<?php

namespace App\View\Components;

use App\Models\Component as ModelsComponent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class ContactBox extends Component
{
    public $haveContactPage, $data;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->haveContactPage = haveContactPage();
        $localeId = Session::get('local_lang_id') ?? config('app.local_lang_id');
        $this->data = ModelsComponent::where('name', 'contact-box')->where(['language_id' => $localeId])->first()->items;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.contact-box', ['contactPage' => $this->haveContactPage,'data'=>$this->data]);
    }
}
