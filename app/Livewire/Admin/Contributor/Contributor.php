<?php

namespace App\Livewire\Admin\Contributor;

use App\Models\Contributor as ModelsContributor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Carbon\Carbon;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

#[Layout('components.layouts.app')]
#[Title('Contributor')]
class Contributor extends Component
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
    public $month;
    public $year;
    public $status;

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
    

    public function filter()
    {
        $this->reset(['province', 'municipality', 'barangay', 'status', 'search', 'cities', 'barangays']);
    }


    public function render()
    {
        $contributors = ModelsContributor::whereHas('artifact', function ($q) {
            if ($this->status) {
                $q->where('status', $this->status);
            } else {
                $q->whereIn('status', ['Pending', 'Disapproved']);
            }
        })
        ->when($this->province, function ($q) {
            $q->where('province', $this->province);
        })
        ->when($this->municipality, function ($q) {
            $q->where('municipality', $this->municipality);
        })
        ->when($this->barangay, function ($q) {
            $q->where('barangay', $this->barangay);
        })
        ->when($this->search, function ($q) {
            $q->where('fname', 'like', '%' . $this->search . '%')
                ->orWhere('lname', 'like', '%' . $this->search . '%');
        })
        ->paginate($this->page);

        return view('livewire.admin.contributor.contributor', [
            'contributors' => $contributors
        ]);
    }

}
