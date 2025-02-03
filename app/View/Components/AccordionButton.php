<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AccordionButton extends Component
{
    public $targetId;

    public function __construct($targetId)
    {
        $this->targetId = $targetId;
    }

    public function render()
    {
        return view('components.accordion-button');
    }
}
