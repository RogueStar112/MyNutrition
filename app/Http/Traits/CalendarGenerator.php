<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use DateTime;

use App\Models\Macronutrients;


use Auth;


use App\Models\Meal;
use App\Models\MealItems;

trait CalendarGenerator {

    public function getMonthsBetween($startDate, $endDate) {
      $startDateObject = new DateTime($startDate);
      $endDateObject = new DateTime($endDate);

      $months = [];
      $currentMonth = $startDateObject->format('m');
      $currentYear = $startDateObject->format('Y');

      while ($startDateObject <= $endDateObject) {
        $months[] = (int) $currentMonth;
        $currentMonth++;
        if ($currentMonth > 12) {
          $currentMonth = 1;
          $currentYear++;
        }
        $startDateObject->setDate($currentYear, $currentMonth, 1);
      }

      return $months;
    }

    public function viewModeCalories() {

      $user_id = Auth::user()->id;

      $html = '';

      $dayLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
      foreach ($dayLabels as $dayLabel)
      {
          $html .= "<span class='day-label'>" . $dayLabel . '</span>';
      }


      $calories_each_day = [];

      $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date)->subMonth();
      
      $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
      $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);

      while($startOfCalendar <= $endOfCalendar)
      {
          $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'dull' : '';
          $extraClass .= $startOfCalendar->isToday() ? ' today' : '';

          $day = $startOfCalendar->format('j');
          $month = $startOfCalendar->format('m');
          $year = $startOfCalendar->format('Y');

          $day_select = $startOfCalendar->format("Y-m-d");

          $meal_select = Meal::where('user_id', $user_id)
                            ->whereBetween('time_planned', ["$day_select" . ' 00:00:00', $day_select . ' 23:59:59'])
                            ->orderByRaw('time_planned ASC')
                            ->get();

          $calories_calculated = 0;

          foreach($meal_select as $meal_date => $meal) {

            $meal_items_select = MealItems::where('meal_id', $meal->id)
            ->get();



            foreach($meal_items_select as $meal_item) {

              $meal_item_servingsize = $meal_item->serving_size;
              $meal_item_quantity = $meal_item->quantity;

              $foods = Macronutrients::find((int)$meal_item->food_id);
              
              $calories_calculated += (int)(($foods->calories/$foods->serving_size)*$meal_item_servingsize*$meal_item_quantity);
                                                   
            }

        

          }
            


          $html .= '<span class="day" data-calendar-day=' . $year . '-' . $month . '-' . $day . 
                    ' class="day flex '.$extraClass.'"><span class="content-day" id="content-day-' . $year . '-' . $month . '-' . $day .'" class="content">' . $day . '<br>' . '<span class="text-blue-500">' . $calories_calculated . '</span></span></span>';
          $startOfCalendar->addDay();
      }
      
      return $html;

    }

    public function calendar($date = null, $startDate = null, $endDate = null)
    {
        // credit to: https://jonathanbriehl.com/posts/build-a-simple-calendar-with-carbon-and-laravel#disqus_thread

        $monthsBetween = $this->getMonthsBetween($startDate, $endDate);
        $html = '<div class="flex justify-center w-full">';

        for ($i=0; $i<count($monthsBetween)-1; $i++) {
          
          $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date)->subMonth();
      
          $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
          $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);

          if ($i < 1) {
            $html .= '<div class="calendar">';
          } else {
            $html .= '<div class="calendar hidden">';
          }
          
          $html .= '<div class="sidebar">';
            $html .= '<div class="month-year">';
            $html .= '<span class="month">' . $date->format('M') . '</span>';
            $html .= '<span class="year">' . $date->format('Y') . '</span>';
            $html .= '</div>';

            $html .= "<div class='view-modes [&>*]:rounded-lg [&>*]:m-4 flex flex-col gap-3'>";
            $html .= "<button id='viewmode-default' class='bg-stone-500 w-full p-4 rotate-90 active-mode'>Default</button>";
            $html .= "<button id='viewmode-calories' class='bg-blue-500 w-full p-4 rotate-90'>Calories</button>";
            $html .= "<button id='viewmode-meals' class='bg-green-500 w-full p-4 rotate-90'>Meals</button>";
            $html .= "<button id='viewmode-macros' class='bg-orange-500 w-full p-4 rotate-90'>Macros</button>";
            $html .= "</div>";
          $html .= '</div>';

          $html .= '<div id="day-container" class="days">';

          $dayLabels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
          foreach ($dayLabels as $dayLabel)
          {
              $html .= "<span class='day-label'>" . $dayLabel . '</span>';
          }

          while($startOfCalendar <= $endOfCalendar)
          {
              $extraClass = $startOfCalendar->format('m') != $date->format('m') ? 'dull' : '';
              $extraClass .= $startOfCalendar->isToday() ? ' today' : '';

              $day = $startOfCalendar->format('j');
              $month = $startOfCalendar->format('m');
              $year = $startOfCalendar->format('Y');



              $html .= '<span class="day" data-calendar-day=' . $year . '-' . $month . '-' . $day . 
                        ' class="day flex '.$extraClass.'"><span class="content-day" id="content-day-' . $year . '-' . $month . '-' . $day .'" class="content">' . $day . '</span></span>';
              $startOfCalendar->addDay();
          }
          $html .= '</div></div>';

          // $date = Carbon::parse($date)->addMonth()->format('Y-m-d');

        }
        
        return $html;

        

        

    }


}
