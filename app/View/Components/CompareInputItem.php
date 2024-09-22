<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CompareInputItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $index;

    public function __construct($index = '')
    {
        $this->index = $index;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.compare-input-item');
    }
}
