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

    // notification types;
    // 1 - meal prompts post time planned
    // 2 - reminded of meal.

    public $notificationType = '';



    public $mealName = '';

    
    public function mount($id)
    {
        $this->result = MealNotifications::findOrFail($id);
        $this->key = $this->result->id;
        $this->mealId = $this->result->meal_id;
        $this->message = $this->result->message;
        $this->mealName = Meal::findOrFail($this->mealId)->name;
        $this->notificationType = $this->result->type;
    }

    public function markAsEaten() {

        if ($this->notificationType == 1) {

            $this->message = "Meal: $this->mealName eaten.";

            $changeMessage = $this->result;

            $changeMessage->message = $this->message;
            $changeMessage->is_accepted = 1;

            $changeMessage->save();

            $changeMeal = Meal::findOrFail($this->mealId);
            $changeMeal->is_eaten = 1;
            $changeMeal->save();

        }
        


    }

    public function markAsDeleted() {

        if ($this->notificationType == 1) {

            $this->message = "Meal: $this->mealName deleted.";

            $changeMessage = $this->result;

            $changeMessage->message = $this->message;
            $changeMessage->is_accepted = 2;

            $changeMessage->save();

            $changeMeal = Meal::findOrFail($this->mealId);
            $changeMeal->delete();

        }

    }

    public function dismissNotification() {

        $this->message = "Notification dismissed.";

        $changeMessage = $this->result;

        $changeMessage->message = $this->message;
        $changeMessage->is_accepted = 1;

        $changeMessage->save();

        $changeMeal = Meal::findOrFail($this->mealId);
        $changeMeal->is_notified = 1;
        $changeMeal->save();

        $this->result->delete();

  
    }
    
    public function render()
    {
        return view('livewire.meal-notification');
    }


}
