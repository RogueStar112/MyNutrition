<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardLink extends Component
{
    /**
     * Create a new component instance.
     */
    public $heading;
    public $colspan;
    public $icon;
    public $textalign;
    public $href;
    /**
     * Create a new component instance.
     */
    public function __construct($heading = '', $colspan = '', $icon = '', $textalign = "left", $href = '')
    {
        $this->heading = $heading;
        $this->colspan = $colspan;
        $this->icon = $icon;
        $this->textalign = $textalign;
        $this->href = $href;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard-link');
    }
}
