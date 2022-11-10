<?php

namespace App\View\Components\admin;

use Illuminate\View\Component;

class LetterMajor extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $replyLetters;
    public function __construct($replyLetters)
    {
        $this->replyLetters = $replyLetters;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.letter-major');
    }
}
