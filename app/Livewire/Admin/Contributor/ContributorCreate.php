<?php

namespace App\Livewire\Admin\Contributor;

use App\Models\Artifact;
use App\Models\Contributor;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

#[Layout('components.layouts.visitor-layout')]
#[Title('Contributor Form')]
class ContributorCreate extends Component
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

    public function mount()
    {

        $this->provinces = Province::orderBy('name', 'asc')->get();
        $this->cities = [];
        $this->barangays = [];

        $this->categories = [
            'Significant Natural Resources' => 'Significant Natural Resources',
            'Tangible-Immovable Cultural Heritage' => 'Tangible-Immovable Cultural Heritage',
            'Tangible Movable Culture' => 'Tangible Movable Culture',
            'Intangible Culture Heritage' => 'Intangible Culture Heritage',
            'Significant Personalities' => 'Significant Personalities',
            'Cultural Institutions' => 'Cultural Institutions',
        ];

        $this->subcategories = [];
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
                'Ethnographic Materials',
                'Archival Holdings',
                'Fine Arts',
                'Antiques Objects',
                'Numismatic',
                'Trophy',
                'Events',
                'Certificates',
                'Books',
                'Statue',
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

        // Reset selected subcategory
        $this->selectedSubcategory = null;
    }

    public function change1()
    {
        $this->collections = null;
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
            'last_name' => 'required',
            'first_name' => 'required',
            'sex' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'province' => 'required',
            'municipality' => 'required',
            'barangay' => 'required',
            'address' => 'required',
            'artifact_name' => 'required',
            'date_photograph' => 'required',
            'owned_by' => 'required',
            'donated_by' => 'required',
            'description' => 'required',
            'collections' => 'required',
        ]);


        $imagePaths = [];
        foreach ($this->collections as $image) {
            $originalName = $image->getClientOriginalName();
            $path = $image->storeAs('artifacts-images', time() . '-' . $originalName, 'public');

            $imagePaths[] = $path;
        }

        $artifact = Artifact::create([
            'category' => $this->selectedCategory,
            'type' => $this->selectedSubcategory,
            'name' => $this->artifact_name,
            'date_photograph' => $this->date_photograph,
            'owned_by' => $this->owned_by,
            'donated_by' => $this->donated_by,
            'description' => $this->description,
            'story' => $this->story,
            'collections' => $imagePaths,
            'status' => 'Pending'
        ]);

        Contributor::create([
            'artifact_id' => $artifact->id,
            'fname' => $this->first_name,
            'mname' => $this->middle_name,
            'lname' => $this->last_name,
            'suffix' => $this->suffix,
            'sex' => $this->sex,
            'contact_no' => $this->contact_no,
            'email' => $this->email,
            'province' => $this->province,
            'municipality' => $this->municipality,
            'barangay' => $this->barangay,
            'address' => $this->address,
        ]);


        flash()->success('Created');
        return redirect('/contributor-create');
    }

    public function render()
    {
        return view('livewire.admin.contributor.contributor-create');
    }
}
