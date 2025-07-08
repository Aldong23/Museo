<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\TangibleImmovableCulturalHeritage;
use App\Models\TangibleMovableCulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EthnographicObject extends Component
{
    use WithFileUploads;



    public $name;
    // for collections
    public $fields = [];
    public $lists = [];


    public $type;
    public $date_produced;
    public $name_of_owner;
    public $estimated_age;
    public $acquisition;
    public $arrangement;
    public $office_of_origin;
    public $contact_person;
    //
    public $description; //array
    public $stories;
    public $significance;
    public $physical_condition; // array
    public $remarks_2;
    public $narration;
    public $references;
    public $mappers;
    public $date_profiled;

    public function mount()
    {
        $this->fields = [
            ['photo_credit' => '', 'photo_date' => '', 'photos' => []] // Initial field
        ];
    }

    public function addField()
    {
        $this->fields[] = ['photo_credit' => '', 'photo_date' => '', 'photos' => []];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields); // Re-index array
    }

    public function save()
    {

        $this->validate([
            'name' => 'required',
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos.*' => 'required|max:10240',

            //
            'type' => 'required',
            'date_produced' => 'required|date',
            'name_of_owner' => 'required',
            'acquisition' => 'required',
            'estimated_age' => 'required',

            'description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            //
            'physical_condition' => 'required',
            'remarks_2' => 'required',
            'narration' => 'nullable',

            'references' => 'required',
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

        foreach ($this->lists as $index => $list) {

            if (!empty($list['photo']) && is_object($list['photo'])) {
                $originalName = $list['photo']->getClientOriginalName();
                $path = $list['photo']->storeAs('cultural-lists', time() . '-' . $originalName, 'public');

                $this->lists[$index]['photo'] = $path;
            }
        }

        TangibleMovableCulturalHeritage::create([
            'cultural_heritage_category' => 'Tangible-Immovable Cultural Heritage',
            'cultural_heritage_type' => 'Ethnographic Object',
            'name' => $this->name,
            'photo_details' => $this->fields,
            //
            'type' => $this->type,
            'date_produced' => $this->date_produced,
            'estimated_age' => $this->estimated_age,
            'name_of_owner' => $this->name_of_owner,
            'type_of_acquisition' => $this->acquisition,
            'description' => $this->description,
            'stories' => $this->stories,
            'significance' => $this->significance,
            //
            'physical_condition' => $this->physical_condition,
            'remarks_2' => $this->remarks_2,
            'narration' => $this->narration,
            //
            'references' => $this->references,
            'mappers' => $this->mappers,
            'date_profiled' => $this->date_profiled,
        ]);

        flash()->success('Created!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.ethnographic-object');
    }
}
