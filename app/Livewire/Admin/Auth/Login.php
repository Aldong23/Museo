<?php

namespace App\Livewire\Admin\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Helpers\AuditHelper;

#[Layout('components.layouts.auth-layout')]
#[Title('Login')]
class Login extends Component
{

    public $email;
    public $password;
    public $remember = false;

    public function adminLogin()
    {

        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {

            AuditHelper::log('Logged in', 'Successfully Logged in');
            flash()->success('Login successful.');

            return redirect('/');
        } else {

            session()->flash('error', 'Invalid credentials.');
        }
    }

    public function render()
    {
        return view('livewire.admin.auth.login');
    }
}
