<?php

namespace App\Http\Traits;

use Carbon\Carbon;

trait CalendarGenerator {

    public function calendar($date = null)
    {
        // credit to: https://jonathanbriehl.com/posts/build-a-simple-calendar-with-carbon-and-laravel#disqus_thread

        $date = empty($date) ? Carbon::now() : Carbon::createFromDate($date);
    
        $startOfCalendar = $date->copy()->firstOfMonth()->startOfWeek(Carbon::MONDAY);
        $endOfCalendar = $date->copy()->lastOfMonth()->endOfWeek(Carbon::SUNDAY);

        $html = '<div class="calendar">';

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

            $html .= '<span class="day '.$extraClass.'"><span id="content-day-' . $day .'" class="content">' . $day . '</span></span>';
            $startOfCalendar->addDay();
        }
        $html .= '</div></div>';
        return $html;

        

    }


}
