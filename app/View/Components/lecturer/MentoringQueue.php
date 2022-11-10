<?php

namespace App\View\Components\lecturer;

use Illuminate\View\Component;

class MentoringQueue extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $mentoringsQueue;
    public function __construct($mentoringsQueue)
    {
        $this->mentoringsQueue = $mentoringsQueue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lecturer.mentoring-queue');
    }
}
