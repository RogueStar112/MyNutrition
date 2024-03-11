<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\View\Components\FoodItem;
use App\View\Components\FoodInputItem;
use Illuminate\Support\Facades\DB;

use Auth;
use Illuminate\View\Component;

use App\Models\FoodSource;
use App\Models\Food;
use App\Models\FoodUnit;
use App\Models\Macronutrients;

use App\Models\UserHealthDetails;
use App\Models\UserHealthLogs;

class BodyStatsController extends Controller
{
    public function body_stats_form() {

        return view('nutrition_body_stats_form');

    }

    public function body_stats_store(Request $request) {

        /*

        UHD&UHL:
         - Weight measured in kg. Other measurements will be converted to kg.
         - Height measured in cm. Other measurements will be converted to cm.
         - BodyFat WIP.

        */

        $user_id = Auth::user()->id;

        $weight_val = (float)$request->input('current-weight');

        $weight_unit = $request->input('weight-unit');


        if($weight_unit == 'st') {
            $weight_val_stlbs = $request->input('current-weight-stlbs');

        } else {
            $weight_val_stlbs = 0;
        }





        $height_val = (float)$request->input('current-height');

        $height_unit = $request->input('height-unit');



        // convert ft-in to cm
        if($height_unit == 'ft') {
            $height_val = round(($height_val * 30.48), 1);

            $height_val_in = $request->input('current-height-in');

            $height_val = $height_val + round(($height_val_in * 2.5), 1);
        } else {
            $height_val_in = 0;
        }



        // Convert lbs to kg
        if($weight_unit == 'lbs') {

            $weight_val = (float)round($weight_val / 2.2, 1);



        }
 
        // Convert st-lbs to kg
        if($weight_unit == 'st') {

            $weight_val = (float)round($weight_val * 6.35, 1);

            $weight_val_stlbs = (float)round($weight_val_stlbs / 2.205, 1);

            $weight_val += $weight_val_stlbs;            

        }

        $bmi = round(($weight_val/($height_val/100)**2), 1);
        
        if($request->input('body-fat') != NULL) {

            $body_fat = (float)$request->input('body-fat');
        
        } else {

            $body_fat = NULL;

        }


        $last_updated = date("Y-m-d H:i:s");


        // UNCOMMENT FOR DEBUGGING PURPOSES ONLY
        // dd($user_id, $weight_val, $height_val, $bmi, $last_updated, $body_fat);


        $newUserHealthDetails = UserHealthDetails::updateOrCreate(
            ['user_id' => $user_id],
            ['weight' => $weight_val, 'height' => $height_val, 'bmi' => $bmi, 'bodyfat' => $body_fat, 'last_updated' => $last_updated]
        );

        // $newUserHealthDetails = new UserHealthDetails();

        // $newUserHealthDetails->user_id = $user_id;

        // $newUserHealthDetails->weight = $weight_val;

        // $newUserHealthDetails->height = $height_val;

        // $newUserHealthDetails->bmi = $bmi;

        // $newUserHealthDetails->bodyfat = $body_fat;

        // $newUserHealthDetails->last_updated = $last_updated;

        // $newUserHealthDetails->save();


        $newUserHealthLogs = new UserHealthLogs();

        $newUserHealthLogs->user_id = $user_id;

        $newUserHealthLogs->weight = $weight_val;

        $newUserHealthLogs->height = $height_val;

        $newUserHealthLogs->bmi = $bmi;

        $newUserHealthLogs->bodyfat = $body_fat;

        $newUserHealthLogs->time_updated = $last_updated;

        $newUserHealthLogs->save();

        return view('dashboard');
    }
}
