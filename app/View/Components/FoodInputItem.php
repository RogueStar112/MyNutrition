<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FoodInputItem extends Component
{
    /**
     * Create a new component instance.
     */

    public $index;
    public $active;

    public function __construct($index = '', $active = '')
    {
        $this->index = $index;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.food-input-item');
    }
}
