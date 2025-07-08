<?php

namespace App\Livewire\Visitor;

use App\Models\User;
use Livewire\Component;

class ReturningVisitorForm extends Component
{

    public function mount($id)
    {

        $user = User::find($id);

        if ($user) {
        }
    }
    public function render()
    {
        return view('livewire.visitor.returning-visitor-form');
    }
}
