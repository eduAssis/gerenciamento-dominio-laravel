<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputField extends Component
{
    public function __construct(
        public string $name,
        public ?string $id,
        public string $label,
        public ?string $placeholder,
        public string $type = 'text',
        public bool $required = false
    ) {
        $this->id = $id ?? $name;
    }

    public function render()
    {
        return view('components.input-field');
    }
}