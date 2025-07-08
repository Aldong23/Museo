<?php

namespace App\Livewire\Admin\Contributor;

use App\Models\Artifact;
use App\Models\Contributor;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

#[Layout('components.layouts.visitor-layout')]
#[Title('Contributor Form')]
class ContributorView extends Component
{
    use WithFileUploads;
    // array
    public $provinces;
    public $cities;
    public $barangays;

    public $last_name;
    public $first_name;
    public $middle_name;
    public $suffix;
    public $sex;
    public $contact_no;
    public $email;
    public $province;
    public $municipality;
    public $barangay;
    public $address;
    // for artifacts
    public $categories = [];
    public $subcategories = [];
    public $selectedCategory = null;
    public $selectedSubcategory = null;

    public $artifact_name;
    public $date_photograph;
    public $owned_by;
    public $donated_by;
    public $description;
    public $story;
    public $collections;

    public $remarks;
    public $date_profiled;
    public $status;
    public $artifact_id;

    public function mount($id)
    {
        $contributor = Contributor::find($id);
        $artifact = Artifact::find($contributor->artifact_id);
        $this->artifact_id = $contributor->artifact_id;

        $this->first_name = $contributor->fname;
        $this->last_name = $contributor->lname;
        $this->middle_name = $contributor->mname;
        $this->suffix = $contributor->suffix;
        $this->sex = $contributor->sex;
        $this->contact_no = $contributor->contact_no;
        $this->email = $contributor->email;
        $this->province = $contributor->province;
        $this->municipality = $contributor->municipality;
        $this->barangay = $contributor->barangay;
        $this->address = $contributor->address;

        $this->provinces = Province::orderBy('name', 'asc')->get();
        $prov = Province::where('name', $this->province)->first();
        $this->cities = City::where('province_id', $prov->province_id)
            ->orderBy('name', 'asc')
            ->get();
        $city = City::where('name', $this->municipality)->first();

        $this->barangays = Barangay::where('city_id', $city->city_id)
            ->orderBy('name', 'asc')
            ->get();

        $this->categories = [
            'Significant Natural Resources' => 'Significant Natural Resources',
            'Tangible-Immovable Cultural Heritage' => 'Tangible-Immovable Cultural Heritage',
            'Tangible Movable Culture' => 'Tangible Movable Culture',
            'Intangible Culture Heritage' => 'Intangible Culture Heritage',
            'Significant Personalities' => 'Significant Personalities',
            'Cultural Institutions' => 'Cultural Institutions',
        ];

        $this->selectedCategory = $artifact->category;
        $this->updateSubcategories();

        $this->selectedSubcategory = $artifact->type;

        $this->artifact_name  = $artifact->name;
        $this->date_photograph  = $artifact->date_photograph ? Carbon::parse($artifact->date_photograph)->format('Y-m-d') : now()->format('Y-m-d');
        $this->owned_by  = $artifact->owned_by;
        $this->donated_by  = $artifact->donated_by;
        $this->description  = $artifact->description;
        $this->story  = $artifact->story;
        $this->collections  = $artifact->collections;
    }

    public function updateSubcategories()
    {
        // types of cultural heritage
        $this->subcategories = match ($this->selectedCategory) {
            'Significant Natural Resources' => [
                'Bodies of Water',
                'Plants (Flora)',
                'Animals (Fauna)',
                'Protected Area',
                'Critical Area',
            ],
            'Tangible-Immovable Cultural Heritage' => [
                'Government/Private',
                'School',
                'Hospital',
                'Church',
                'Monuments',
                'Sites',
                'Houses',
                'Houses with Period',
            ],
            'Tangible Movable Culture' => [
                'Ethnographic Object',
                'Archival Holdings',
            ],
            'Intangible Culture Heritage' => [
                'Social Practices',
                'Knowledge and Practices',
                'Traditional Craftsmanship',
            ],
            'Cultural Institutions' => [
                'Associations',
                'Library',
                'Political Clan',
                'School Institutions',
            ],
            default => [],
        };
    }



    public function save()
    {
        $this->validate([
            'remarks' => 'required',
            'date_profiled' => 'required',
            'status' => 'required',
        ]);

        $artifact = Artifact::find($this->artifact_id);

        if ($artifact) {
            // Generate artifact_no based on the artifact's ID
            $artifactNo = 'MDU' . str_pad($artifact->id, 6, '0', STR_PAD_LEFT);

            $artifact->update([
                'artifact_no' => $artifactNo,
                'remarks' => $this->remarks,
                'date_profiled' => $this->date_profiled,
                'status' => $this->status,
            ]);

            flash()->success('Updated');
            return redirect('/contributor');
        }

        flash()->error('Artifact not found');
    }



    public function render()
    {
        return view('livewire.admin.contributor.contributor-view');
    }
}
