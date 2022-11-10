<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class BeforePresentation extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $beforePresentations;
    public function __construct($beforePresentations)
    {
        $this->beforePresentations = $beforePresentations;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.before-presentation');
    }
}
