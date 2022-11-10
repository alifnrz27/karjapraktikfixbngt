<?php

namespace App\View\Components\student;

use Illuminate\View\Component;

class Title extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $titles;
    public $titleStatus;
    public $submissionStatus;
    public function __construct($titles, $titleStatus, $submissionStatus)
    {
        $this->titles = $titles;
        $this->titleStatus = $titleStatus;
        $this->submissionStatus = $submissionStatus;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student.title');
    }
}
