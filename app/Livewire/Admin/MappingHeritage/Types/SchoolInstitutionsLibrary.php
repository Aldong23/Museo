<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalInstitutions;
use App\Models\TangibleImmovableCulturalHeritage;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class SchoolInstitutionsLibrary extends Component
{

    use WithFileUploads;
    public $types = [];
    public $fields = [];
    public $lists = [];

    public $name;

    public $organizational;
    public $photo_credit;
    public $photo_date;

    public $city;
    public $province;
    public $location;
    public $type;
    public $remarks_image;
    public $remarks_text;
    public $narrative_description;
    public $stories;
    public $significance;
    public $supporting_documentation;
    public $key_informats;
    public $mappers;
    public $date_profiled;
    public $assessment;

    public function mount($name, $city, $province, $location, $type, array $fields)
    {

        $this->name = $name;
        $this->city = $city;
        $this->province = $province;
        $this->location = $location;
        $this->type = $type;
        $this->fields = $fields;
    }

    public function addList()
    {
        $this->lists[] =
            [
                'barangay' => '',
                'coop' => '',
                'president' => ['fname' => '', 'mname' => '', 'lname' => ''],
                'contact_no' => '',
                'remarks' => '',
            ];
    }

    public function removeList($index)
    {
        unset($this->lists[$index]);
        $this->lists = array_values($this->lists); // Re-index array
    }

    public function save()
    {
        $this->validate([
            'organizational.*' => 'image|max:10240',  // Max 10MB for organizational chart images

            'lists.*.barangay' => 'required|string',
            'lists.*.coop' => 'required|string',
            'lists.*.president.fname' => 'required|string',
            'lists.*.president.mname' => 'nullable|string',
            'lists.*.president.lname' => 'required|string',
            'lists.*.contact_no' => 'required|numeric',
            'lists.*.remarks' => 'nullable|string',
            'remarks_image' => 'required|image|max:10240',
            'remarks_text' => 'required',
            'narrative_description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'supporting_documentation' => 'required',
            'key_informats' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required',
            'assessment' => 'required',
        ]);

        // Save featured collections
        foreach ($this->fields as $index => $field) {
            if (!empty($field['photos'])) {
                $photoPaths = [];

                foreach ($field['photos'] as $photo) {
                    if ($photo instanceof \Illuminate\Http\UploadedFile) {
                        $originalName = $photo->getClientOriginalName();
                        $uniqueName = time() . '-' . uniqid() . '-' . $originalName;
                        $path = $photo->storeAs('featured-collections', $uniqueName, 'public');

                        $photoPaths[] = $path;
                    }
                }


                $this->fields[$index]['photos'] = $photoPaths;
            }
        }

        // Save organizational chart images
        $organizationalPaths = [];
        if ($this->organizational) {
            foreach ($this->organizational as $image) {
                $originalName = $image->getClientOriginalName();
                $path = $image->storeAs('organizational-charts', time() . '-' . $originalName, 'public');
                $organizationalPaths[] = $path;
            }
        }

        // Save remarks image
        $originalName = $this->remarks_image->getClientOriginalName();
        $remarksImagePath = $this->remarks_image->storeAs('cultural-lists', time() . '-' . $originalName, 'public');

        // Create a new Cultural Institution record
        CulturalInstitutions::create([
            'cultural_heritage_category' => 'Cultural Institutions',
            'cultural_heritage_type' => 'Library',
            'name' => $this->name,
            'organizational_chart' => $organizationalPaths,
            'photo_details' => $this->fields,
            'city' => $this->city,
            'province' => $this->province,
            'location' => $this->location,
            'type_of_cultural_institutions' => $this->type,
            'remarks_image' => $remarksImagePath,
            'remarks_text' => $this->remarks_text,
            'narrative_description' => $this->narrative_description,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'supporting_documentation' => $this->supporting_documentation,
            'key_informats' => $this->key_informats,
            'mappers' => $this->mappers,
            'date_profiled' => $this->date_profiled,
            'assessment' => $this->assessment
        ]);

        flash()->success('Created!');
        return redirect('/mapping-heritage');
    }


    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.school-institutions-library');
    }
}
