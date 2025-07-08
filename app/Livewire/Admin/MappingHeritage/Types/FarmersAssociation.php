<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalInstitutions;
use App\Models\TangibleImmovableCulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class FarmersAssociation extends Component
{

    use WithFileUploads;

    public $fields;
    public $lists = [];

    public $barangay;
    public $coop;
    public $contact_no;
    public $remarks;
    // under president
    public $fname;
    public $mname;
    public $lname;

    public $name;

    public $collections;
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

    public function mount($name, $city, $province, $location, $type, $fields)
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
                'no' => count($this->lists) + 1,
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
        $this->lists = array_values($this->lists);

        // Recalculate 'no' field values
        foreach ($this->lists as $i => $list) {
            $this->lists[$i]['no'] = $i + 1;
        }
    }

    public function save()
    {


        $this->validate([
            'lists.*.barangay' => 'required|string',
            'lists.*.coop' => 'required|string',
            'lists.*.president.fname' => 'required|string',
            'lists.*.president.mname' => 'nullable|string',
            'lists.*.president.lname' => 'required|string',
            'lists.*.contact_no' => 'required|numeric',
            'lists.*.remarks' => 'nullable|string',

            'remarks_image' => 'required',
            'remarks_text' => 'required',
            'narrative_description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            //
            'supporting_documentation' => 'required',
            'key_informats' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required',


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


        $original_name = $this->remarks_image->getClientOriginalName();
        $remarks_image = $this->remarks_image->storeAs('cultural-lists', time() . '-' . $original_name, 'public');

        CulturalInstitutions::create([
            'cultural_heritage_category' => 'Cultural Institutions',
            'cultural_heritage_type' => 'Associations',
            'name' => $this->name,
            'photo_details' => $this->fields,

            //
            'city' => $this->city,
            'province' => $this->province,
            'location' => $this->location,
            'type_of_cultural_institutions' => $this->type,
            'remarks_image' => $remarks_image,
            'remarks_text' => $this->remarks_text,
            'narrative_description' => $this->narrative_description,
            'stories' => $this->stories,
            'significance' => $this->significance,

            //
            'supporting_documentation' => $this->supporting_documentation,
            'key_informats' => $this->key_informats,
            'mappers' => $this->mappers,
            'date_profiled' => $this->date_profiled,
            'farmers_association' => $this->lists,
        ]);

        flash()->success('Created!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.farmers-association');
    }
}
