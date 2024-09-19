<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MealNotification extends Component
{
    /**
     * Create a new component instance.
     */

    public $message;
    public $meal_notification_id;
    
    public function __construct($message = '', $meal_notification_id = '')
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.meal-notification');
    }
}
