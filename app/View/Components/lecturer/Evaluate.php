<?php

namespace App\View\Components\lecturer;

use Illuminate\View\Component;

class Evaluate extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $evaluates;
    public function __construct($evaluates)
    {
        $this->evaluates = $evaluates;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lecturer.evaluate');
    }
}
