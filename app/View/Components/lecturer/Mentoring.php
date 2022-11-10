<?php

namespace App\View\Components\lecturer;

use Illuminate\View\Component;

class Mentoring extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $mentorings;
    public function __construct($mentorings)
    {
        $this->mentorings = $mentorings;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

     
    public function render()
    {
        return view('components.lecturer.mentoring');
    }
}
