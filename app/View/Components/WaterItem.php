<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WaterItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct($type, $amount, $when)
    {
        $this->type = $type;
        $this->amount = $amount;
        $this->when = $when;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.water-item');
    }
}
