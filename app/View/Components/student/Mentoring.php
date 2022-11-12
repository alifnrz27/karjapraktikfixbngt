<?php

namespace App\View\Components\student;

use Illuminate\View\Component;

class Mentoring extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $mentoring;
     public $mentoringStatus;
     public $submissionStatus;
    public function __construct($mentoring, $mentoringStatus, $submissionStatus)
    {
        $this->mentoring = $mentoring;
        $this->mentoringStatus = $mentoringStatus;
        $this->submissionStatus = $submissionStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student.mentoring');
    }
}
