<?php

namespace App\Livewire\Admin\ReportGeneration;

use App\Models\User;
use App\Models\Visitor;
use App\Models\VisitorRecord;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

#[Layout('components.layouts.app')]
#[Title('Visitor Report')]
class VisitorReport extends Component
{
    use WithPagination;
    public $search;
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

    public $page = 20;

    public $adminUser;

    public function mount()
    {
        $user = auth()->user();

        if ($user->is_clerical) {
            redirect()->to('/contributor-report');
        } else if ($user->is_admin_staff) {
            redirect()->to('/contributor-report');
        }

        $this->provinces = Province::orderBy('name', 'asc')->get();
        $this->adminUser = User::where('is_admin', 1)->first();
    }

    public function updateProvince()
    {

        $prov = Province::where('name', $this->province)->first();

        $this->cities = City::where('province_id', $prov->province_id)
            ->orderBy('name', 'asc')
            ->get();
    }

    public function updateCity()
    {

        $city = City::where('name', $this->municipality)->first();

        $this->barangays = Barangay::where('city_id', $city->city_id)
            ->orderBy('name', 'asc')
            ->get();
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

    public function filter($value = null)
    {
        $this->reset(['province', 'municipality', 'barangay', 'month', 'year', 'day', 'search', 'cities', 'barangays']);
    }


    public function render()
    {
        $visitor_records = VisitorRecord::query()
            ->with(['visitor', 'approvedByUser'])
            ->whereNotNull('approved_by')
            ->whereHas('visitor', function ($query) {
                $query
                    ->when($this->province, fn($q) => $q->where('province', $this->province))
                    ->when($this->municipality, fn($q) => $q->where('city', $this->municipality))
                    ->when($this->barangay, fn($q) => $q->where('barangay', $this->barangay))
                    ->when($this->search, function ($q) {
                        $q->where(function ($query) {
                            $query->where('fname', 'like', "%{$this->search}%")
                                ->orWhere('mname', 'like', "%{$this->search}%")
                                ->orWhere('lname', 'like', "%{$this->search}%");
                        });
                    });
            })
            ->when($this->month, fn($q) => $q->whereMonth('created_at', $this->month))
            ->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->day, fn($q) => $q->whereDay('created_at', $this->day))
            ->latest('created_at')
            ->paginate($this->page);

        return view('livewire.admin.report-generation.visitor-report', [
            'visitor_records' => $visitor_records
        ]);

    }
}
