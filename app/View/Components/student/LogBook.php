<?php

namespace App\View\Components\student;

use Illuminate\View\Component;

class LogBook extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $logbooks;
    public function __construct($logbooks)
    {
        $this->logbooks = $logbooks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.student.log-book');
    }
}
