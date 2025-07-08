<?php

namespace App\Livewire\Visitor;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.visitor-layout')]
#[Title('Visitor id')]
class HomePage extends Component
{
    public function mount()
    {

        // $user = Auth::user();

        // if ($user->is_admin == true || $user->is_admin_staff == true || $user->is_technical == true || $user->clerical == true || $user->is_tourist_assistance == true) {

        //     return redirect('/dashboard');
        // }
    }
    public function render()
    {
        return view('livewire.visitor.home-page');
    }
}
