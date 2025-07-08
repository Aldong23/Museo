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
#[Title('Create Account')]
class AccountManagementCreate extends Component
{
    public $employeeNo;
    public $position;
    public $firstname;
    public $middleInitial;
    public $lastname;
    public $suffix;
    public $email;
    public $password;

    public function submit()
    {

        $this->validate([
            'employeeNo' => 'required|unique:users,employee_no',
            'position' => 'required',
            'firstname' => 'required',
            'middleInitial' => 'nullable',
            'lastname' => 'required',
            'suffix' => 'nullable',
            'email' => 'required|email|unique:users,email'
        ]);


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

        if ($this->position === 'Administrative Staff') {

            $admin_staff = true;
        } else {
            $admin_staff = false;
        }

        if ($this->position === 'Technical Staff') {

            $tech_staff = true;
        } else {
            $tech_staff = false;
        }

        if ($this->position === 'Clerical, Inspection and Communication Section') {

            $clerical = true;
        } else {

            $clerical = false;
        }

        if ($this->position === 'Tourist Info and Assistance Section') {

            $tourist_asst = true;
        } else {
            $tourist_asst = false;
        }

        $password = Str::random(8);

        $user = User::create([
            'email' => $this->email,
            'position' => $this->position,
            'employee_no' => $this->employeeNo,
            'fname' => $this->firstname,
            'mname' => $this->middleInitial,
            'lname' => $this->lastname,
            'suffix' => $this->suffix,
            'password' => Hash::make($password),
            'is_admin_staff' => $admin_staff,
            'is_technical' => $tech_staff,
            'is_clerical' => $clerical,
            'is_tourist_assistance' => $tourist_asst,
        ]);

        if($user){
            flash()->success('Account created successfully!');
            AuditHelper::log('Add', "Added an Account");
            Mail::to($this->email)->send(new AccountPassword($user, $password));
        }else{
            flash()->warning('User not created!');
        }

        

        return redirect('/account-management');
    }


    public function render()
    {
        return view('livewire.admin.account-management.account-management-create');
    }
}
