<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Register extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $submissions;
    public function __construct($submissions)
    {
        $this->submissions = $submissions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.register');
    }
}
