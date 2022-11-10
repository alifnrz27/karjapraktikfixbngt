<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class Status extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $status;
    public $statusHistory;
    public function __construct($status, $statusHistory)
    {
        $this->status = $status;
        $this->statusHistory = $statusHistory;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.status');
    }
}
