<?php

namespace App\Livewire\Admin\ReportGeneration;

use App\Models\Visitor;
use App\Models\VisitorRecord;
use Livewire\Component;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Statistics Overall View')]
class StatisticsOverallView extends Component
{

    public $sexFilter = 'month';
    public $clientFilter = 'month';
    public $ageFilter = 'month';
    public $visitorData = [];
    public $clientData = [];
    public $visitorAgeData = [];

    // Date filter properties
    public $year;
    public $month;
    public $day;
    public $days = [];


    public function mount()
    {
        $this->updateDays();
        $this->updateAllData();
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
    
    public function updateDays()
    {
        if ($this->month && $this->year) {
            $this->days = range(1, cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year));
        } else {
            $this->days = [];
        }
    }
    
    public function updateAllData()
    {
        $this->updateVisitorData();
        $this->updateClientData();
        $this->updateVisitorAgeData();
    }
    
    private function getFilteredQuery($model)
    {
        $query = $model::query();
    
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
    
    public function updateVisitorData()
    {
        $query = $this->getFilteredQuery(Visitor::class);
    
        $this->visitorData = [
            'male' => (clone $query)->where('sex', 'male')->count(),
            'female' => (clone $query)->where('sex', 'female')->count(),
        ];
    
        $this->dispatch('updateVisitorChart', $this->visitorData);
    }
    
    public function updateClientData()
    {
        $query = $this->getFilteredQuery(VisitorRecord::class);
    
        $this->clientData = [
            'citizen' => (clone $query)->where('client_type', 'citizen')->count(),
            'business' => (clone $query)->where('client_type', 'business')->count(),
            'employee' => (clone $query)->where('client_type', 'employee')->count(),
        ];
    
        $this->dispatch('updateClientChart', $this->clientData);
    }
    
    public function updateVisitorAgeData()
    {
        $query = $this->getFilteredQuery(Visitor::class);
    
        $this->visitorAgeData = [
            '0-17'   => (clone $query)->whereBetween('age', [0, 17])->count(),
            '18-24'  => (clone $query)->whereBetween('age', [18, 24])->count(),
            '25-34'  => (clone $query)->whereBetween('age', [25, 34])->count(),
            '35-44'  => (clone $query)->whereBetween('age', [35, 44])->count(),
            '45-54'  => (clone $query)->whereBetween('age', [45, 54])->count(),
            '55+'    => (clone $query)->where('age', '>=', 55)->count(),
        ];
    
        $this->dispatch('updateVisitorAgeChart', $this->visitorAgeData);
    }

    public function filter()
    {
        $this->year = now()->year;
        $this->month = now()->month;
        $this->day = null; // Ensure the day is reset

        $this->updateDays();
        $this->updateVisitorData();
        $this->updateClientData();
        $this->updateVisitorAgeData();
    }

    public function render()
    {

        return view('livewire.admin.report-generation.statistics-overall-view');
    }
}
