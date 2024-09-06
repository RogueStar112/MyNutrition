<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyMeal extends Notification
{
    use Queueable;

    protected $meal;

    public function __construct($meal)
    {
        $this->meal = $meal;
    }

    public function via($notifiable)
    {
        return ['mail']; // Or other channels like 'database', 'broadcast', etc.
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("It's time for your meal: {$this->meal->meal_name}")
                    ->action('View Meal Details', url('/nutrition/meal/view' . $this->meal->id)) 
                    ->line('Thank you for using our app!');
    }
}
