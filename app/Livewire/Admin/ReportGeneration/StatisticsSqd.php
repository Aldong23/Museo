<?php

namespace App\Livewire\Admin\ReportGeneration;

use App\Models\Feedback;
use Carbon\Carbon;
use Livewire\Component;

class StatisticsSqd extends Component
{
    public $sqd_data = [];

    public $sqd_filters = 'all';
    public $questions = [
        "SQD0. I was satisfied with the service I received at the office I visited.",
        "SQD1. The time I spent processing my transaction was reasonable.",
        "SQD2. The office adheres to the required documents and procedures based on the information provided.",
        "SQD3. The steps in processing, including payment, are easy and simple.",
        "SQD4. I quickly and easily found information about my transaction from the office or its website.",
        "SQD5. I paid a reasonable amount for my transaction. (If the service was provided for free, press N/A).",
        "SQD6. I feel that the office is fair to everyone, or 'there is no favoritism,' in my transaction.",
        "SQD7. I was treated politely by the staff, and (in case I asked for help) I know they are willing to assist me.",
        "SQD8. I received what I needed from the government office, and if it was denied, it was sufficiently explained to me."
    ];

    public $year;
    public $month;
    public $day;
    public $days = [];


    public function mount()
    {
        $this->updateSqd();
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

    public function updateSqd()
    {
        $sqd_data = [];
    
        foreach (range(0, 8) as $index) {
            $sqd_data[$index] = [
                'Strongly_Agree' => $this->applyDateFilter(Feedback::where("satisfaction_$index", 5))->count(),
                'Agree' => $this->applyDateFilter(Feedback::where("satisfaction_$index", 4))->count(),
                'Neutral' => $this->applyDateFilter(Feedback::where("satisfaction_$index", 3))->count(),
                'Disagree' => $this->applyDateFilter(Feedback::where("satisfaction_$index", 2))->count(),
                'Strongly_Disagree' => $this->applyDateFilter(Feedback::where("satisfaction_$index", 1))->count(),
                'Not_Applicable' => $this->applyDateFilter(Feedback::where("satisfaction_$index", 0))->count(),
            ];
        }
    
        $this->sqd_data = $sqd_data;
    
        $this->dispatch('updateSqd', ['data' => $sqd_data, 'questions' => $this->questions]);
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
        $this->updateSqd();
    }

    public function updatedMonth()
    {
        $this->updateDays();
        $this->updateSqd();
    }

    public function updatedDay()
    {
        $this->updateSqd();
    }


    public function render()
    {
        return view('livewire.admin.report-generation.statistics-sqd', ['questions' => $this->questions]);
    }
}
