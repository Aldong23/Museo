<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalInstitutions;
use App\Models\TangibleImmovableCulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Associations extends Component
{

    use WithFileUploads;

    public $fields = [];
    public $lists = [];

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

    public function save()
    {
        $this->validate([
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

            'assessment' => 'required'

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
            // 'farmers_association' => $this->lists,

            'assessment' => $this->assessment
        ]);

        flash()->success('Created!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.associations');
    }
}
