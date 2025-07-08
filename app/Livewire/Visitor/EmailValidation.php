<?php

namespace App\Livewire\Visitor;

use App\Models\Visitor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\URL;


#[Layout('components.layouts.auth-layout')]
#[Title('Email Validation')]
class EmailValidation extends Component
{
    public $email;

    public function validateEmail()
    {

        $this->validate([
            'email' => 'required|email'
        ]);

        $visitor = Visitor::where('email', $this->email)->first();

        if ($visitor) {
            
            $signedUrl = URL::temporarySignedRoute(
                'returning.visitor.form', 
                now()->addDay(),
                ['id' => $visitor->id]
            );
    
            return redirect($signedUrl);
        } else {
            return redirect()->route('visitor.form');
        }
    }
    public function render()
    {
        return view('livewire.visitor.email-validation');
    }
}
