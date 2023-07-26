<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MealFoodItem extends Component
{   
    public $foods;
    public $servingSize;
    public $quantity;

    public function __construct($foods = '', $servingSize = 100, $quantity = 1)
    {

        $this->foods = $foods;
        $this->servingSize = $servingSize;
        $this->quantity = $quantity;

    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meal-food-item');
    }
}
