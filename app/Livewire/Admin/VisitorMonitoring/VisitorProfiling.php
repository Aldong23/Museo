<?php

namespace App\Livewire\Admin\VisitorMonitoring;

use Livewire\Component;
use App\Models\User;
use App\Models\Visitor;
use Carbon\Carbon;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;
use Livewire\WithPagination;

class VisitorProfiling extends Component
{
    use WithPagination;

    public $page = 20;
    public $search = '';
    public $provinces = [];
    public $cities = [];
    public $barangays = [];

    public $province;
    public $municipality;
    public $barangay;
    public $month;
    public $year;

    public $visitorInfo;
    
    public function mount()
    {
        $this->provinces = Province::orderBy('name', 'asc')->get();
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

    public function filter($value = null)
    {
        $this->reset(['province', 'municipality', 'barangay', 'month', 'year', 'search', 'cities', 'barangays']);
    }

    public function openArchive($id)
    {
        $this->visitorInfo = Visitor::find($id);

        $this->dispatch('open-archive');
    }

    public function archiveVisitor($id)
    {
        $visitor = Visitor::find($id);
        if ($visitor) {
            $visitor->delete();
            flash()->success('Visitor deleted successfully.');
        }

        $this->dispatch('close-archive');
    }

    // In Livewire Component
    public function render()
    {
        $visitors = Visitor::query()
            ->withCount([
                'visitorRecords as approved_visits_count' => function ($query) {
                    $query->whereNotNull('approved_by'); 
                }
            ])
            ->when($this->province, fn($q) => $q->where('province', $this->province))
            ->when($this->municipality, fn($q) => $q->where('city', $this->municipality))
            ->when($this->barangay, fn($q) => $q->where('barangay', $this->barangay))
            ->when($this->month, fn($q) => $q->whereMonth('created_at', $this->month))
            ->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('fname', 'like', "%{$this->search}%")
                        ->orWhere('mname', 'like', "%{$this->search}%")
                        ->orWhere('lname', 'like', "%{$this->search}%");
                });
            })
            ->paginate($this->page);

        return view('livewire.admin.visitor-monitoring.visitor-profiling', compact('visitors'));

    }
}
