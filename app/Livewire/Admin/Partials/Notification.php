<?php

namespace App\Livewire\Admin\Partials;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Notification extends Component
{
    use WithPagination;

    public $user;
    public $page = 4;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function markAsRead($notifId)
    {
        $notification = $this->user->notifications()->find($notifId);
        if ($notification) {
            $notification->markAsRead();
        }
    }

    public function notifLink($notifId)
    {
        $notification = $this->user->notifications()->find($notifId);
        if ($notification) {
            $notification->markAsRead();

            return redirect($notification->data['link']);
        }
    }

    public function deleteNotification($notifId)
    {
        $notification = $this->user->notifications()->find($notifId);
        if ($notification) {
            $notification->delete(); // Delete the notification
            $this->resetPage();
        }
    }

    public function markAllAsRead()
    {
        $this->user->unreadNotifications->markAsRead();
        flash()->success('All notifications marked as read');
    }

    public function removeAll()
    {
        $this->user->notifications()->delete();
        flash()->success('All notifications removed');
    }

    public function loadMore()
    {
        // Fetch the next page of notifications

        $this->page++;
    }

    public function render()
    {
        $notifications = $this->user->notifications()->latest()->paginate($this->page);

        return view('livewire.admin.partials.notification', [
            'notifications' => $notifications
        ]);
    }
}
