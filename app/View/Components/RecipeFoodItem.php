<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecipeFoodItem extends Component
{
        /**
     * Create a new component instance.
     */
    public $index;
    public $name;
    public $servingSize;
    public $servingUnit;
    public $source;
    public $calories;
    public $fat;
    public $carbs;
    public $protein;

    public $sugars;
    public $saturates;
    public $fibre;
    public $salt;

    public $description;

    public function __construct($index = '', $name = '', $servingSize = '', $servingUnit = '', $source = '', $calories = '', $fat = '', $carbs = '', $protein = '', $sugars = '', $saturates = '', $fibre = '', $salt = '', $description = '')
    {
        $this->index = $index;
        $this->name = $name;
        $this->servingSize = $servingSize;
        $this->servingUnit = $servingUnit;
        $this->source = $source;
        $this->calories = $calories;
        $this->fat = $fat;
        $this->carbs = $carbs;
        $this->protein = $protein;

        $this->sugars = $sugars;
        $this->saturates = $saturates;
        $this->fibre = $fibre;
        $this->salt = $salt;

        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recipe-food-item');
    }
}
