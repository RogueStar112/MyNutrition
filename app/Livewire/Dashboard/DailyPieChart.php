<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;

class DailyPieChart extends Component
{   

    public $day_selected = '';
    // public $pie_chart = [];
    
    public $pie_sum_calories = '';
    public $pie_sum_fat = '';
    public $pie_sum_carbs = '';
    public $pie_sum_protein = '';

    // public function mount()
    // {
    //     // $data = [
    //     //     'labels' => ['Jan', 'Feb', 'Mar'],
    //     //     'datasets' => [[
    //     //         'label' => 'Sales',
    //     //         'data' => [100, 200, 150],
    //     //         'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
    //     //     ]],
    //     // ];

    //     $this->chartJson = json_encode($this->pie_chart);
    // }



    public function render()
    {
        return view('livewire.dashboard.daily-pie-chart');
    }
}
