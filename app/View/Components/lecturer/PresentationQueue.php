<?php

namespace App\View\Components\lecturer;

use Illuminate\View\Component;

class PresentationQueue extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $presentationsQueue;
    public function __construct($presentationsQueue)
    {
        $this->presentationsQueue = $presentationsQueue;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lecturer.presentation-queue');
    }
}
