<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Booking extends Component
{
    public $data;
    /**
     * Create a new component instance.
     */
    public function __construct($data)
    {
        $this->data = $data['attributes'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        return view('components.booking', ['data' => $this->data]);
    }
}
