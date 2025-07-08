<?php

namespace App\Livewire\Admin\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.auth-layout')]
#[Title('Code Verification')]
class CodeVerification extends Component
{

    public $user;
    public $code;
    public $new_password;
    public $confirm_password;

    public function mount($id)
    {

        $this->user = User::find($id);
    }

    public function send()
    {

        $this->validate([
            'code' => 'required',
            'new_password' => 'required|min:8|same:confirm_password',
            'confirm_password' => 'required',
        ], [
            'new_password.same' => 'Confirm password not matched.',
            'code.required' => 'The reset password is required'
        ]);

        if (Hash::check($this->code, $this->user->password)) {

            $this->user->password = Hash::make($this->new_password);
            $this->user->save();

            flash()->success('Password changed successfully!');
            return redirect()->route('login');
        } else {

            session()->flash('error', 'You’ve entered an incorrect code!');
        }
    }


    public function render()
    {
        return view('livewire.admin.auth.code-verification');
    }
}
