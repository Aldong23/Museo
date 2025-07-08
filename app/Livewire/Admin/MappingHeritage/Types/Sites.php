<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalHeritage;
use App\Models\TangibleImmovableCulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Sites extends Component
{
    use WithFileUploads;

    public $fields = [];
    public $lists = [];

    public $name_of_built_structure;
    public $photo;
    public $year_produced;
    public $dimension;

    public $name;

    public $collections;
    public $photo_credit;
    public $photo_date;

    public $type;
    public $ownership;
    public $location;
    public $address;
    public $latitude;
    public $longitude;
    public $year_constructed;
    public $area;
    public $structure;
    public $estimated_age;
    public $ownership_jurisdiction;
    public $declaration_legislation;
    public $description;
    public $stories;
    public $significance;
    public $condition_of_structure;
    public $remarks_1;
    public $integrity_of_structure;
    public $remarks_2;
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

    public function addList()
    {
        $this->lists[] =
            [
                'name_of_built_structure' => '',
                'photo' => '',
                'year_produced' => '',
                'dimension' => '',
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
            'name' => 'required',
            'collections.*' => 'image|max:10240',  // Max 10MB
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos.*' => 'required|max:10240',
            'lists.*.name_of_built_structure' => 'required',
            'lists.*.photo' => 'required|image|max:10240',
            'lists.*.year_produced' => 'required',

            //
            'type' => 'required',
            'ownership' => 'required',
            'location' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'year_constructed' => ['required', 'regex:/^\d{4}\s\/\s\d{4}$/'],
            'area' => 'required',
            'structure' => 'required',
            'estimated_age' => 'required',
            'ownership_jurisdiction' => 'required',
            'declaration_legislation' => 'required',
            'description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            //
            'condition_of_structure' => 'required',
            'remarks_1' => 'required',
            'integrity_of_structure' => 'required',
            'remarks_2' => 'required',
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

        TangibleImmovableCulturalHeritage::create([
            'cultural_heritage_category' => 'Tangible-Immovable Cultural Heritage',
            'cultural_heritage_type' => 'Sites',
            'name' => $this->name,
            'photo_details' => $this->fields,

            //
            'type' => $this->type,
            'ownership' => $this->ownership,
            'location' => $this->location,
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'year_constructed' => $this->year_constructed,
            'area' => $this->area,
            'structure' => $this->structure,
            'estimated_age' => $this->estimated_age,
            'ownership_jurisdiction' =>  $this->ownership_jurisdiction,
            'declaration_legislation' => $this->declaration_legislation,
            'description' => $this->description,
            'stories' => $this->stories,
            'significance' => $this->significance,
            //
            'condition_of_structure' => $this->condition_of_structure,
            'remarks_1' =>  $this->remarks_1,
            'integrity_of_structure' => $this->integrity_of_structure,
            'remarks_2' => $this->remarks_2,
            //
            'list_of_cultural_props' => $this->lists,
            'references' => $this->references,
            'name_of_mapper' => $this->mappers,
            'date_profiled' => $this->date_profiled,
        ]);

        flash()->success('Created!');
        return redirect('/mapping-heritage');
    }


    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.sites');
    }
}
