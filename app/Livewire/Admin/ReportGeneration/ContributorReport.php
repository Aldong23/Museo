<?php

namespace App\Livewire\Admin\ReportGeneration;

use App\Models\Contributor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

#[Layout('components.layouts.app')]
#[Title('Contributor Report')]
class ContributorReport extends Component
{

    use WithPagination;

    public $search;
    public $page;
    public $provinces = [];
    public $cities = [];
    public $barangays = [];

    public $province;
    public $municipality;
    public $barangay;
    
    // Date filter properties
    public $year;
    public $month;
    public $day;
    public $days = [];

    public function mount()
    {
        $this->provinces = Province::orderBy('name', 'asc')->get();
    }

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

    public function updateProvince()
    {
        if (!$this->province) {
            $this->reset(['cities', 'municipality', 'barangays', 'barangay']);
            return;
        }
    
        $prov = Province::where('name', $this->province)->first();
    
        if ($prov) {
            $this->cities = City::where('province_id', $prov->province_id)
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $this->reset(['cities', 'municipality', 'barangays', 'barangay']);
        }
    }
    
    public function updateCity()
    {
        if (!$this->municipality) {
            $this->reset(['barangays', 'barangay']);
            return;
        }
    
        $city = City::where('name', $this->municipality)->first();
    
        if ($city) {
            $this->barangays = Barangay::where('city_id', $city->city_id)
                ->orderBy('name', 'asc')
                ->get();
        } else {
            $this->reset(['barangays', 'barangay']);
        }
    }
    
    public function filter()
    {
        $this->reset(['province', 'municipality', 'barangay', 'month', 'year', 'status', 'search', 'cities', 'barangays']);
    }

    public function render()
    {
        $contributors = Contributor::whereHas('artifact', function ($q) {
                return $q->where('status', 'Approved')->whereNull('deleted_at');
            })
            ->when($this->province || $this->municipality || $this->barangay, function ($q) {
                $q->when($this->province, fn($q) => $q->where('province', $this->province))
                ->when($this->municipality, fn($q) => $q->where('municipality', $this->municipality))
                ->when($this->barangay, fn($q) => $q->where('barangay', $this->barangay));
            })
            ->when($this->search, fn($q) => 
                $q->where(function ($q) {
                    $q->where('fname', 'like', "%{$this->search}%")
                    ->orWhere('lname', 'like', "%{$this->search}%");
                })
            )
            ->when($this->year || $this->month || $this->day, function ($q) {
                $q->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
                ->when($this->month, fn($q) => $q->whereMonth('created_at', $this->month))
                ->when($this->day, fn($q) => $q->whereDay('created_at', $this->day));
            })
            ->paginate($this->page);
    
        return view('livewire.admin.report-generation.contributor-report', [
            'contributors' => $contributors
        ]);
    
    }
    
}
