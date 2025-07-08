<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use App\Models\ArtifactExhibit;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

#[Layout('components.layouts.app')]
#[Title('Exhibit Monitoring Form')]
class ArtifactsExhibitMonitoringCreate extends Component
{
    // array
    public $provinces;
    public $cities;
    public $barangays;

    public $program_name;
    public $subject_activity;
    public $province;
    public $municipality;
    public $barangay;
    public $address;
    public $start_date;
    public $end_date;
    public $description;
    public $artifacts_id;
    public $remarks;

    public function mount()
    {

        $this->provinces = Province::orderBy('name', 'asc')->get();
        $this->cities = [];
        $this->barangays = [];
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

    public function save()
    {

        $this->validate([
            'program_name' => 'required',
            'subject_activity' => 'required',
            'province' => 'required',
            'municipality' => 'required',
            'barangay' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'artifacts_id' => 'required',
        ]);


        ArtifactExhibit::create([
            'user_id' => Auth::user()->id,
            'program_name' => $this->program_name,
            'subject_activity' => $this->subject_activity,
            'province' => $this->province,
            'municipality' => $this->municipality,
            'barangay' => $this->barangay,
            'address' => $this->address,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'description' => $this->description,
            'artifacts_id' => $this->artifacts_id,
            'remarks' => $this->remarks,
            'status' => 'Pending',
        ]);

        flash()->success('Exhibit Event Form Created');
        return redirect('/artifacts-exhibit-monitoring');
    }

    public function render()
    {

        $artifacts = Artifact::all();

        return view('livewire.admin.artifacts-management.artifacts-exhibit-monitoring-create', [
            'artifacts' => $artifacts
        ]);
    }
}
