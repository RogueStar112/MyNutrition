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
    public $servingUnitOptions;
    public $active;

    public $name;
    public $source;
    public $servingSize;

    public $servingUnit;
    public $calories;
    public $fat;
    public $carbs;
    public $protein;

    public $sugars;
    public $saturates;
    public $fibre;
    public $salt;

    public $description;


    public function __construct($index = '', $servingUnitOptions = '', $active = '',  $name = '', $source = '', $servingSize = '', $servingUnit = '', $calories = '', $fat = '', $carbs = '', $protein = '', $sugars = '', $saturates = '', $fibre = '', $salt = '', $description = '')
    {
        $this->index = $index;
        $this->servingUnitOptions = $servingUnitOptions;

        $this->active = $active;
        
        $this->name = $name;
        $this->source = $source;
        $this->servingSize = $servingSize;
        $this->servingUnit = $servingUnit;
        
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
        return view('components.food-input-item');
    }
}
