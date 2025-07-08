<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use App\Models\ArtifactExhibit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

#[Layout('components.layouts.app')]
#[Title('Exhibit Approval')]
class ArtifactsExhibitApproval extends Component
{

    public $exhibit_id;
    public $artifacts;

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


    public function mount($id)
    {
        $this->exhibit_id = $id;
        $exhibit = ArtifactExhibit::find($id);

        $this->provinces = Province::all();
        $prov = Province::where('name', $exhibit->province)->first();
        $this->cities = City::where('province_id', $prov->province_id)->get();
        $city = City::where('name', $exhibit->municipality)->first();
        $this->barangays = Barangay::where('city_id', $city->city_id)->get();


        $this->program_name = $exhibit->program_name;
        $this->subject_activity = $exhibit->subject_activity;
        $this->province =  $exhibit->province;
        $this->municipality =  $exhibit->municipality;
        $this->barangay = $exhibit->barangay;
        $this->address = $exhibit->address;
        $this->start_date = $exhibit->start_date  ? Carbon::parse($exhibit->start_date)->format('Y-m-d') : now()->format('Y-m-d');
        $this->end_date = $exhibit->end_date ? Carbon::parse($exhibit->end_date)->format('Y-m-d') : now()->format('Y-m-d');
        $this->description = $exhibit->description;
        $this->remarks = $exhibit->remarks;

        foreach ($exhibit->artifacts_id as $art_id) {
            $art = Artifact::withoutTrashed()->find($art_id);
            if ($art) {
                $this->artifacts[] = $art;
            }
        }
    }

    public function updateProvince()
    {

        $prov = Province::where('name', $this->province)->first();
        $this->cities = City::where('province_id', $prov->province_id)->get();
    }

    public function updateCity()
    {

        $city = City::where('name', $this->municipality)->first();

        $this->barangays = Barangay::where('city_id', $city->city_id)->get();
    }

    public function approve()
    {
        $exhibit = ArtifactExhibit::find($this->exhibit_id);

        $exhibit->update([
            'remarks' => $this->remarks,
            'status' => 'Approved',
        ]);

        flash()->success('Exhibit Event Approved');
        return redirect('/artifacts-exhibit-monitoring');
    }

    public function disapprove()
    {
        $exhibit = ArtifactExhibit::find($this->exhibit_id);

        $exhibit->update([
            'remarks' => $this->remarks,
            'status' => 'Declined',
        ]);

        flash()->success('Exhibit Event Declined');
        return redirect('/artifacts-exhibit-monitoring');
    }

    public function render()
    {

        // $artifacts = Artifact::all();

        return view('livewire.admin.artifacts-management.artifacts-exhibit-approval', [
            // 'artifacts' => $artifacts
        ]);
    }
}
