<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class AfterPresentation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $afterPresentations;
    public function __construct($afterPresentations)
    {
        $this->afterPresentations = $afterPresentations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.after-presentation');
    }
}
