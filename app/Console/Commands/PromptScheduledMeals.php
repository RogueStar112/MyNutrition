<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;

use Auth;

use App\Models\Meal;


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

        $now = Carbon::now()->format('Y-m-d H:i:s');
        $meals = Meal::where('time_planned', '<=', $now)
                    ->where('is_eaten', '=', 0)
                    ->get();

        foreach ($meals as $meal) {
            // Prompt the user to edit the meal
            $this->info("It's time to edit your meal: {$meal->meal_name}");
            // Implement logic to prompt for editing
            // You can use user inputs or display options for editing
            // For example, ask for new meal name, new planned time, etc.
        }

    }


}
