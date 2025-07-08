<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Plants extends Component
{
    use WithFileUploads;

    public $name;
    // featured collections
    public $fields = [];
    public $lists = [];

    public $other_common_name;
    public $scientific_name;
    public $classification_to_growth;
    public $classification_to_origin;
    public $habitat;
    // location
    public $location;
    public $address;
    //
    public $visibility;
    public $seasonability;
    public $description;
    public $scope_of_use;
    public $remarks;
    public $stories;
    public $significance;
    public $conservation;
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
            'location' => 'required',
            'description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'conservation' => 'required',
            'references' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required',

            // added
            'other_common_name' => 'required',
            'scientific_name' => 'required',
            'classification_to_growth' => 'required',
            'classification_to_origin' => 'required',
            'habitat' => 'required',
            'visibility' => 'required',
            'seasonability' => 'required',
            'scope_of_use' => 'required',
            'remarks' => 'required',

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

        CulturalHeritage::create([
            'cultural_heritage_category' => 'Significant Natural Resources',
            'cultural_heritage_type' => 'Plants (Flora)',
            'name' => $this->name,
            'photo_details' => $this->fields,
            'other_common_name' => $this->other_common_name,
            'scientific_name' => $this->scientific_name,
            'classification_growth_habit' => $this->classification_to_growth,
            'classification_origin' => $this->classification_to_origin,
            'habitat' => $this->habitat,
            'location' => $this->location,
            'address' => $this->address,
            'indicate_visibility' => $this->visibility,
            'indicate_seasonability' => $this->seasonability,
            'description' => $this->description,
            'common_uses' => $this->scope_of_use,
            'remarks' => $this->remarks,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'conservation' => $this->conservation,
            'references' => $this->references,
            'name_of_mapper' => $this->mappers,
            'date_profiled' => $this->date_profiled,
        ]);

        flash()->success('Created!');
        return redirect('/mapping-heritage');
    }


    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.plants');
    }
}
