<?php

namespace App\View\Components\submission;

use Illuminate\View\Component;

class JobTraining extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $submissionStatus;
    public function __construct($submissionStatus)
    {
        $this->submissionStatus = $submissionStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.submission.job-training');
    }
}
