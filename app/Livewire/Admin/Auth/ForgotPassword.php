<?php

namespace App\Livewire\Admin\Auth;

use App\Mail\ForgotPassword as MailForgotPassword;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.auth-layout')]
#[Title('Forgot Password')]
class ForgotPassword extends Component
{

    public $email;

    public function send()
    {

        $user = User::where('email', $this->email)->first();

        if ($user) {

            $password = Str::random(8);

            try {

                Mail::to($this->email)->send(new MailForgotPassword($user, $password));

                $user->password = $password;
                $user->save();

                flash()->success('Code verification set!');

                return redirect()->route('code.verification', ['id'  => $user->id]);
            } catch (\Throwable $th) {

                flash()->warning('Please check your internet connection!');
            }

            flash()->success('email found');
        } else {

            session()->flash('error', 'This email address does not exist!');
        }
    }
    public function render()
    {
        return view('livewire.admin.auth.forgot-password');
    }
}
