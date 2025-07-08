<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.visitor-layout')]
#[Title('Feedback Success')]
class AfterFeedback extends Component
{
    public function render()
    {
        return view('livewire.visitor.after-feedback');
    }
}
