<?php

namespace App\Livewire\Admin\ReportGeneration;

use App\Models\Feedback;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.app')]
#[Title('Statistics CC')]
class StatisticsCc extends Component
{

    public $cc1_data = [];
    public $cc2_data = [];
    public $cc3_data = [];
    public $cc1_filter = 'month';
    public $cc2_filter = 'month';
    public $cc3_filter = 'month';

    public $year;
    public $month;
    public $day;
    public $days = [];

    public function mount()
    {
        $this->updateDays();
        $this->updateAllData();
    }

    public function updateDays()
    {
        if ($this->year && $this->month) {
            $this->days = range(1, cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year));
        } else {
            $this->days = [];
        }
    }

    public function updatedYear()
    {
        $this->updateDays();
        $this->updateAllData();
    }

    public function updatedMonth()
    {
        $this->updateDays();
        $this->updateAllData();
    }

    public function updatedDay()
    {
        $this->updateAllData();
    }

    private function applyDateFilter($query)
    {
        if ($this->year) {
            $query->whereYear('created_at', $this->year);
        }
        if ($this->month) {
            $query->whereMonth('created_at', $this->month);
        }
        if ($this->day) {
            $query->whereDay('created_at', $this->day);
        }

        return $query;
    }

    public function updateAllData()
    {
        $this->updateCC1();
        $this->updateCC2();
        $this->updateCC3();
    }

    public function updateCC1()
    {
        $this->cc1_data = [
            'opt1' => $this->applyDateFilter(Feedback::where('q1', 'I know about CC, and I saw it in the office I visited'))->count(),
            'opt2' => $this->applyDateFilter(Feedback::where('q1', 'I know about CC, but I didn’t see it in the office I visited'))->count(),
            'opt3' => $this->applyDateFilter(Feedback::where('q1', 'I learned about CC when I saw it in the office I visited'))->count(),
            'opt4' => $this->applyDateFilter(Feedback::where('q1', 'I don’t know what CC is, and I didn’t see anything in the office I visited (Check ‘NA’)'))->count(),
        ];

        $this->dispatch('updateCC1', $this->cc1_data);
    }

    public function updateCC2()
    {
        $this->cc2_data = [
            'opt1' => $this->applyDateFilter(Feedback::where('q2', 'Easy to see'))->count(),
            'opt2' => $this->applyDateFilter(Feedback::where('q2', 'Somewhat easy to see'))->count(),
            'opt3' => $this->applyDateFilter(Feedback::where('q2', 'Difficult to see'))->count(),
            'opt4' => $this->applyDateFilter(Feedback::where('q2', 'Cannot be seen'))->count(),
            'opt5' => $this->applyDateFilter(Feedback::where('q2', 'N/A'))->count(),
        ];

        $this->dispatch('updateCC2', $this->cc2_data);
    }

    public function updateCC3()
    {
        $this->cc3_data = [
            'opt1' => $this->applyDateFilter(Feedback::where('q3', 'Very helpful'))->count(),
            'opt2' => $this->applyDateFilter(Feedback::where('q3', 'Somewhat helpful'))->count(),
            'opt3' => $this->applyDateFilter(Feedback::where('q3', 'Not helpful'))->count(),
            'opt4' => $this->applyDateFilter(Feedback::where('q3', 'N/A'))->count(),
        ];

        $this->dispatch('updateCC3', $this->cc3_data);
    }

    public function filter()
    {
        $this->year = now()->year;
        $this->month = now()->month;
        $this->day = null;

        $this->updateDays();
        $this->updateAllData();
    }

    public function render()
    {
        return view('livewire.admin.report-generation.statistics-cc');
    }
}
