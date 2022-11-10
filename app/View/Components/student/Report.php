<?php

namespace App\View\Components\student;

use Illuminate\View\Component;

class Report extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $reports;
    public $reportStatus;
    public function __construct($reports, $reportStatus)
    {
        $this->reports = $reports;
        $this->reportStatus = $reportStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student.report');
    }
}
