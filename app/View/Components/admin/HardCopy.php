<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class HardCopy extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $hardcopy;
    public function __construct($hardcopy)
    {
        $this->hardcopy = $hardcopy;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.hard-copy');
    }
}
