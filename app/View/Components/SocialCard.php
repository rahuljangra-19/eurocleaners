<?php

namespace App\View\Components;

use App\Models\Component as ModelsComponent;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SocialCard extends Component
{
    public $data;
    /** 
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->data = ModelsComponent::where('name', 'social-card')->first()->items;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        
        return view('components.social-card', ['data' => $this->data]);
    }
}
