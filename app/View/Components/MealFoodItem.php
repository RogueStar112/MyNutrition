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
    public $showNutrients;
    public $showMoreButton;
    
    public function __construct($foodIndex = '', $foods = '', $servingSize = 100, $servingUnit = '', $quantity = 1, $showNutrients = false, $showMoreButton = false)
    {
        $this->foodIndex = $foodIndex;
        $this->foods = $foods;
        $this->servingSize = $servingSize;
        $this->servingUnit = $servingUnit;
        $this->quantity = $quantity;
        $this->showNutrients = $showNutrients;
        $this->showMoreButton = $showMoreButton;

    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meal-food-item');
    }
}
