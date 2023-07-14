<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardItem extends Component
{   
    public $heading;
    public $colspan;
    public $icon;
    public $textalign;
    /**
     * Create a new component instance.
     */
    public function __construct($heading = '', $colspan = '', $icon = '', $textalign = "left")
    {
        $this->heading = $heading;
        $this->colspan = $colspan;
        $this->icon = $icon;
        $this->textalign = $textalign;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-item');
    }
}
