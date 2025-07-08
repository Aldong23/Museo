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
class AccountManagement extends Component
{
    use WithPagination;

    public $page = 20;

    public $search;
    public $userInfo;

    public function openView(User $user)
    {

        $this->userInfo = $user;

        $this->dispatch('open-view');
    }

    public function openArchive(User $user)
    {
        $this->userInfo = $user;

        $this->dispatch('open-archive');
    }

    public function archiveAccount($id)
    {
        $user = User::find($id);
        if ($user) {
            AuditHelper::log('Archived', "Archived {$user->fname} {$user->mname} {$user->lname} Account");
            $user->delete();
            flash()->success('User deleted successfully.');
        }

        $this->dispatch('close-archive');
    }

    public function render()
    {
       $users = User::query()
            ->where('is_admin', false)
            ->when($this->search, function ($q) {
                $q->where('fname', 'like', '%' . $this->search . '%');
            })
            ->paginate($this->page);

        return view('livewire.admin.account-management.account-management', [
            'users' => $users
        ]);
    }
}
