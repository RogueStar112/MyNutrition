<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class FoodItem extends Component
{
    public $meal_name = '';
    public $meal_calories = '';
    public $meal_fats = '';
    public $meal_carbs = '';
    public $meal_protein = '';
    public $meal_macros = '';
    public $meal_micros = '';
    // public $meal_item_names = '';
    // public $meal_item_nutrition = '';
    // public $meal_nutrition = '';
    public bool $show_meal_items = false;

    public function toggle_meal_items() {

        $this->show_meal_items = !$this->show_meal_items;
    }

    public function render()
    {
        return view('livewire.dashboard.food-item');
    }
}
