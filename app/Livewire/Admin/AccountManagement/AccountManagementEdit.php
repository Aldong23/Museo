<?php

namespace App\Livewire\Admin\AccountManagement;

use App\Mail\AccountPassword;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Helpers\AuditHelper;

#[Layout('components.layouts.app')]
#[Title('Edit Account')]
class AccountManagementEdit extends Component
{
    public $userId;
    public $user;
    public $employeeNo;
    public $position;
    public $firstname;
    public $middleInitial;
    public $lastname;
    public $suffix;
    public $email;
    public $originalEmail;

    public function mount($id)
    {
        $this->userId = $id;
        $user = User::find($id);

        $this->employeeNo = $user->employee_no;
        $this->position = $user->position;
        $this->firstname = $user->fname;
        $this->middleInitial = $user->mname;
        $this->lastname = $user->lname;
        $this->suffix = $user->suffix;
        $this->email = $user->email;
        $this->originalEmail = $user->email;
    }

    public function submit()
    {
        $this->validate([
            'employeeNo' => 'required|unique:users,employee_no,' . $this->userId,
            'position' => 'required',
            'firstname' => 'required',
            'middleInitial' => 'nullable',
            'lastname' => 'required',
            'suffix' => 'nullable',
            'email' => 'required|email|unique:users,email,' . $this->userId
        ]);

        // Format the first and last names
        $this->firstname = Str::title(preg_replace('/[^a-zA-Z ]/', '', $this->firstname));
        $this->lastname = Str::title(preg_replace('/[^a-zA-Z ]/', '', $this->lastname));

        if ($this->middleInitial) {
            $this->middleInitial = Str::title(preg_replace('/[^a-zA-Z]/', '', $this->middleInitial));
            if (strlen($this->middleInitial) === 1) {
                $this->middleInitial .= '.';
            } else {
                $this->middleInitial = preg_replace('/\./', '', $this->middleInitial);
            }
        }

        $user = User::findOrFail($this->userId);

        // If no changes were made, do not update
        if (
            $user->employee_no === $this->employeeNo &&
            $user->position === $this->position &&
            $user->fname === $this->firstname &&
            $user->mname === $this->middleInitial &&
            $user->lname === $this->lastname &&
            $user->suffix === $this->suffix &&
            $user->email === $this->email
        ) {
            flash()->info('No changes detected. Account not updated.');
            return redirect('/account-management');
        }

        if ($this->email !== $this->originalEmail) {
            $password = Str::random(8);
            $user->password = Hash::make($password);
            try {
                AuditHelper::log('Update', "Updated {$user->fname} {$user->mname} {$user->lname} Account");
                Mail::to($this->email)->send(new AccountPassword($user, $password));
                flash()->success('Account updated successfully with new email and password sent.');
            } catch (\Throwable $th) {
                flash()->warning('Account updated, but error sending new password.');
            }
        }

        $user->employee_no = $this->employeeNo;
        $user->position = $this->position;
        $user->fname = $this->firstname;
        $user->mname = $this->middleInitial;
        $user->lname = $this->lastname;
        $user->suffix = $this->suffix;
        $user->email = $this->email;


        $user->save();

        flash()->success('Account updated successfully.');
        return redirect('/account-management');
    }


    public function render()
    {
        return view('livewire.admin.account-management.account-management-edit');
    }
}
