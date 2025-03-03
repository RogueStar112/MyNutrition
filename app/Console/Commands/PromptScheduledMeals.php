<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Carbon\Carbon;

use Auth;

use App\Models\Meal;
use App\Models\MealNotifications;

class PromptScheduledMeals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:prompt-scheduled-meals';
    
    

    /**
     * The console command description.
     *
     * @var string
     */
    // protected $description = 'Command description';
    protected $description = 'Prompt users of meals that have not been processed yet.';


    public function __construct()
    {
        parent::__construct();
    }
 
    /**
     * Execute the console command.
     */
    public function handle()
    {   

        // $user_id = Auth::user()->id;

        $now = Carbon::now()->format('Y-m-d H:i:s');
        
        $meals = Meal::where('time_planned', '<=', $now)
                    ->where('is_eaten', '=', 0)
                    ->where('is_notified', '=', 0)
                    // ->where('user_id', '=', $user_id)
                    ->get();

        foreach ($meals as $meal) {
            // Prompt the user to edit the meal

            // if($meal->is_notified == 0) {

                $meal_notification = new MealNotifications();
                $meal_notification->meal_id = $meal->id;
                
                $meal_reminder_time = date("d/m/Y H:i", strtotime($meal->time_planned));
                $meal_name = $meal->name;
                
                $rng = rand(0, 2);

                switch($rng) {
                    case 0:
                        $meal_notification->message = "Your meal named $meal_name has passed the time planned ($meal_reminder_time). Have you eaten this meal?";
                        break;
                    case 1:
                        $meal_notification->message = "Your meal: $meal_name was planned at $meal_reminder_time. Have you eaten this?";
                        break;
                    case 2:
                        $meal_notification->message = "$meal_name was planned at $meal_reminder_time. Have you eaten it?";
                        break;

                }
                

                $meal_notification->is_accepted = 0;
                $meal_notification->type = 1;

                $meal_notification->save();
                $meal_notification->touch();

            // }    

                $meal->is_notified = 1;
                $meal->save();
        


            // $this->info("It's time to edit your meal: {$meal->meal_name}");
            // Log::info("It's time to edit your meal: {$meal->meal_name}");
            // Implement logic to prompt for editing
            // You can use user inputs or display options for editing
            // For example, ask for new meal name, new planned time, etc.
        }

        

    }


}
