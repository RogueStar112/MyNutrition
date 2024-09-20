<?php

namespace App\Livewire;

use Livewire\Component;

class ShowMealNotifications extends Component
{   
    public $isVisible = false; // Initially hidden

    public function render()
    {
        return view('livewire.show-meal-notifications');
    }

    public function toggleVisibility()
    {
        $this->isVisible = ! $this->isVisible;
    }
}
