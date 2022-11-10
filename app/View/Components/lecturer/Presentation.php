<?php

namespace App\View\Components\lecturer;

use Illuminate\View\Component;

class Presentation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $presentations;
    public function __construct($presentations)
    {
        $this->presentations = $presentations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lecturer.presentation');
    }
}
