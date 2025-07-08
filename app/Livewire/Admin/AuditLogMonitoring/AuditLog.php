<?php

namespace App\Livewire\Admin\AuditLogMonitoring;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog as AuditLogModel;

class AuditLog extends Component
{
    use WithPagination;

    public $page = 20;
    public $search;

    // Date filter properties
    public $year;
    public $month;
    public $day;
    public $days = [];

    public function updateDays()
    {
        if ($this->month && $this->year) {
            $this->days = range(1, cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year));
        } else {
            $this->days = [];
        }
    }

    public function updatedMonth()
    {
        $this->updateDays();
    }

    public function updatedYear()
    {
        $this->updateDays();
    }

    public function filter()
    {
        $this->reset(['month', 'year', 'day', 'search']);
    }

    public function render()
    {
        $user = Auth::user();

        $auditLogs = AuditLogModel::with('user')
            ->when(!$user->is_admin, fn($q) => 
                $q->where('user_id', $user->id)
            )
            ->when($this->search, function ($q) {
                $q->where('event', 'like', "%{$this->search}%")
                  ->orWhereHas('user', function ($query) {
                      $query->where('fname', 'like', "%{$this->search}%")
                            ->orWhere('mname', 'like', "%{$this->search}%")
                            ->orWhere('lname', 'like', "%{$this->search}%");
                  });
            })
            ->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->month, fn($q) => $q->whereMonth('created_at', $this->month))
            ->when($this->day, fn($q) => $q->whereDay('created_at', $this->day))
            ->latest('created_at') 
            ->paginate($this->page);

        return view('livewire.admin.audit-log-monitoring.audit-log', compact('auditLogs'));
    }
}
