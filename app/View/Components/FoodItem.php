<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FoodItem extends Component
{   
        /**
     * Create a new component instance.
     */
    public $index;
    public $name;
    public $source;
    public $calories;
    public $fat;
    public $carbs;
    public $protein;

    public function __construct($index = '', $name = '', $source = '', $calories = '', $fat = '', $carbs = '', $protein = '')
    {
        $this->index = $index;
        $this->name = $name;
        $this->source = $source;
        $this->calories = $calories;
        $this->fat = $fat;
        $this->carbs = $carbs;
        $this->protein = $protein;
    }

    public function render(): View|Closure|string
    {
        return view('components.food-item');
    }
}
