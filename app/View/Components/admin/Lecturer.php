<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Lecturer extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $lecturer;
    public $mentors;
    public $lecturerHistory;
    public function __construct($lecturer, $mentors, $lecturerHistory)
    {
        $this->lecturer = $lecturer;
        $this->mentors = $mentors;
        $this->lecturerHistory = $lecturerHistory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.lecturer');
    }
}
