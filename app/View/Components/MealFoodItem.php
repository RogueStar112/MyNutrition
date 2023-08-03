<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MealFoodItem extends Component
{   
    public $foodIndex;
    public $foods;
    public $servingSize;
    public $servingUnit;
    public $quantity;

    public function __construct($foodIndex = '', $foods = '', $servingSize = 100, $servingUnit = '', $quantity = 1)
    {
        $this->foodIndex = $foodIndex;
        $this->foods = $foods;
        $this->servingSize = $servingSize;
        $this->servingUnit = $servingUnit;
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
