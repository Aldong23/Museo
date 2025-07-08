<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Helpers\AuditHelper;

class Profile extends Component
{
    use WithFileUploads;

    public $first_name;
    public $middle_initial;
    public $last_name;
    public $suffix;
    public $email;
    public $profile;

    public $position, $employee_number;

    public $new_password;
    public $confirm_password;
    public $current_password;

    public function mount()
    {
        $user = Auth::user();

        $this->first_name = $user->fname;
        $this->middle_initial = $user->mname;
        $this->last_name = $user->lname;
        $this->suffix = $user->suffix;
        $this->email = $user->email;
        $this->position = $user->position;
        $this->employee_number = $user->employee_no;
    }

    public function update()
    {

        $user = Auth::user();

        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required'
        ]);

        if ($this->profile) {
            $originalName = $this->profile->getClientOriginalName();
            $uniqueName = time() . '-' . uniqid() . '-' . $originalName;
            $path = $this->profile->storeAs('Profiles', $uniqueName, 'public');

            $user->profile = $path;
            $user->save();
        }

        $user->update([
            'fname' => $this->first_name,
            'mname' => $this->middle_initial,
            'lname' => $this->last_name,
            'suffix' => $this->suffix,
            'email' => $this->email,
        ]);

        AuditHelper::log('Update', 'Updated your profile details');
        flash()->success('Profile Updated!');
    }

    public function updatePass()
    {

        $user = Auth::user();

        $validated = $this->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password',
            'current_password' => 'required|min:8',
        ]);

        if ($validated) {

            if (Hash::check($this->current_password, $user->password)) {

                $user->update([
                    'password' => Hash::make($this->new_password),
                ]);
                AuditHelper::log('Update', 'Updated your password');
                flash()->success('Password Updated');
                $this->dispatch('confirm-close');
            } else {

                flash()->warning('password not match');
            }
        }
    }

    public function render()
    {

        return view('livewire.admin.profile', [
            'user' => Auth::user()
        ]);
    }
}
