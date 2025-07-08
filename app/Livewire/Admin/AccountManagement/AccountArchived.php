<?php

namespace App\Livewire\Admin\AccountManagement;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use App\Helpers\AuditHelper;

#[Layout('components.layouts.app')]
#[Title('Account Management')]
class AccountArchived extends Component
{
    use WithPagination;

    public $page = 20;

    public $search;
    public $userInfo;

    public function openArchive($id)
    {
        $this->userInfo = User::onlyTrashed()->find($id);

        $this->dispatch('open-archive');
    }

    public function restoreUser($id)
    {
        $user = User::onlyTrashed()->find($id);
        if ($user) {
            $user->restore();
            AuditHelper::log('Restored', "Restored {$user->fname} {$user->mname} {$user->lname} Account");
            flash()->success('User restored successfully.');
        } else {
            flash()->error('User not found.');
        }

        $this->dispatch('close-archive');
    }

    public function render()
    {
        $users = User::onlyTrashed()
            ->where('is_admin', false)
            ->when($this->search, function ($q) {
                $q->where('fname', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->page);
        
        return view('livewire.admin.account-management.account-archived', compact('users'));
    
    }
}
