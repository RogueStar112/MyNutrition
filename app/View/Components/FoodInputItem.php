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

    public $name;
    public $source;
    public $servingSize;
    public $calories;
    public $fat;
    public $carbs;
    public $protein;


    public function __construct($index = '', $active = '', $name = '', $source = '', $servingSize = '', $calories = '', $fat = '', $carbs = '', $protein = '')
    {
        $this->index = $index;
        $this->active = $active;
        
        $this->name = $name;
        $this->source = $source;
        $this->servingSize = $servingSize;
        
        $this->calories = $calories;
        $this->fat = $fat;
        $this->carbs = $carbs;
        $this->protein = $protein;

        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.food-input-item');
    }
}
