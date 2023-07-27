<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MealSearchItem extends Component
{
    /**
     * Create a new component instance.
     */
    // public $index;
    // public $active;

    // public $name;
    // public $source;
    // public $servingSize;
    // public $calories;
    // public $fat;
    // public $carbs;
    // public $protein;

    public $foods;
    public $servingSize;
    public $quantity;

    public function __construct($foods = '', $servingSize = 1, $quantity = 1)

    {
        // $this->index = $index;
        // $this->active = $active;
        
        // $this->name = $name;
        // $this->source = $source;
        // $this->servingSize = $servingSize;
        
        // $this->calories = $calories;
        // $this->fat = $fat;
        // $this->carbs = $carbs;
        // $this->protein = $protein;

        $this->foods = $foods;
        $this->servingSize = $servingSize;
        $this->quantity = $quantity;

    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meal-search-item');
    }
}
