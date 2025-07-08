<?php

namespace App\Livewire\Admin\VisitorMonitoring;

use App\Models\Feedback;
use Livewire\Component;
use Livewire\WithPagination;

class VisitorFeedback extends Component
{
    use WithPagination;

    public $page = 20;
    public $search = '';
    public $month = '';
    public $year = '';
    public $client_type = '';

    public function resetFilters()
    {
        $this->reset(['month', 'year', 'client_type']);
    }
    public function render()
    {
        $feedbacks = Feedback::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('control_no', 'like', '%' . $this->search . '%')
                    ->orWhere('client', 'like', '%' . $this->search . '%');
            })
            ->when($this->client_type, fn($query) => $query->where('client', $this->client_type))
            ->when($this->month, fn($query) => $query->whereMonth('created_at', $this->month))
            ->when($this->year, fn($query) => $query->whereYear('created_at', $this->year))
            ->paginate($this->page);

        return view('livewire.admin.visitor-monitoring.visitor-feedback', compact('feedbacks'));
    }
}
