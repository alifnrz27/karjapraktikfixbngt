<?php

namespace App\View\Components\lecturer;

use Illuminate\View\Component;

class Report extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $reports;
    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lecturer.report');
    }
}
