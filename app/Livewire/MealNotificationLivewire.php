<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Meal;
use App\Models\MealNotifications;

class MealNotificationLivewire extends Component
{   
    #[Reactive] 

    public $result = '';

    public $key = '';
    public $id = '';
    public $mealId = '';
    public $message = '';

    public $mealName = '';

    
    public function mount($id)
    {
        $this->result = MealNotifications::findOrFail($id);
        $this->key = $this->result->id;
        $this->mealId = $this->result->meal_id;
        $this->message = $this->result->message;
        $this->mealName = Meal::findOrFail($this->mealId)->name;
    }

    public function markAsEaten() {
        $this->message = "Meal: $this->mealName eaten.";

        $changeMessage = $this->result;

        $changeMessage->message = $this->message;
        $changeMessage->is_accepted = 1;

        $changeMessage->save();

        $changeMeal = Meal::findOrFail($this->mealId);
        $changeMeal->is_eaten = 1;
        $changeMeal->save();


    }

    public function markAsDeleted() {
        $this->message = "Meal: $this->mealName deleted.";

        $changeMessage = $this->result;

        $changeMessage->message = $this->message;
        $changeMessage->is_accepted = 2;

        $changeMessage->save();

        $changeMeal = Meal::findOrFail($this->mealId);
        $changeMeal->delete();

    }
    
    public function render()
    {
        return view('livewire.meal-notification');
    }


}
