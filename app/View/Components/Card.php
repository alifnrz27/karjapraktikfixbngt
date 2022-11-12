<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $academicYear;
     public $secondCard;
     public $thirdCard;
     public $fourthCard;
    public function __construct($academicYear, $secondCard, $thirdCard, $fourthCard)
    {
        $this->academicYear = $academicYear;
        $this->secondCard = $secondCard;
        $this->thirdCard = $thirdCard;
        $this->fourthCard = $fourthCard;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
