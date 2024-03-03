<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use DateTime;


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

    public function calendar($date = null, $startDate = null, $endDate = null)
    {
        // credit to: https://jonathanbriehl.com/posts/build-a-simple-calendar-with-carbon-and-laravel#disqus_thread

        $monthsBetween = $this->getMonthsBetween($startDate, $endDate);
        $html = '<div class="grid grid-cols-3 gap-3">';

        for ($i=0; $i<count($monthsBetween)-1; $i++) {
          
          $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date)->addMonth();
      
          $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
          $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);

          if ($i < 1) {
            $html .= '<div class="calendar">';
          } else {
            $html .= '<div class="calendar hidden">';
          }

          $html .= '<div class="month-year">';
          $html .= '<span class="month">' . $date->format('M') . '</span>';
          $html .= '<span class="year">' . $date->format('Y') . '</span>';
          $html .= '</div>';

          $html .= '<div class="days">';

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



              $html .= '<span class="day '.$extraClass.'"><span data-calendar-day=' . $year . '-' . $month . '-' . $day . ' class="content-day max-h-[32px]" id="content-day-' . $year . '-' . $month . '-' . $day .'" class="content">' . $day . '</span></span>';
              $startOfCalendar->addDay();
          }
          $html .= '</div></div>';

          // $date = Carbon::parse($date)->addMonth()->format('Y-m-d');

        }
        
        return $html;

        

        

    }


}
