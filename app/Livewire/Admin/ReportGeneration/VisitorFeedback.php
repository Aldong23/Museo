<?php

namespace App\Livewire\Admin\ReportGeneration;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\Feedback;

#[Layout('components.layouts.app')]
#[Title('Visitor Feedback')]
class VisitorFeedback extends Component
{

    public $search;
    public $page = 20;

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
        $feedbacks = Feedback::query()
            ->when($this->search, function ($query) {
                $query->where('control_no', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->month, fn($q) => $q->whereMonth('created_at', $this->month))
            ->when($this->day, fn($q) => $q->whereDay('created_at', $this->day))
            ->latest('created_at')
            ->paginate($this->page);

        return view('livewire.admin.report-generation.visitor-feedback', [
            'feedbacks' => $feedbacks
        ]);
    }

}
