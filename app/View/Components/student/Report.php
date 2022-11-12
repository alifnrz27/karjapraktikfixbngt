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
    public $submissionStatus;
    public function __construct($reports, $reportStatus, $submissionStatus)
    {
        $this->reports = $reports;
        $this->reportStatus = $reportStatus;
        $this->submissionStatus = $submissionStatus;
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
