<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BodiesOfWater extends Component
{
    use WithFileUploads;

    public $name;

    public $fields = [];
    public $lists = [];

    public $sub_category;
    public $latitude;
    public $longitude;
    public $location;
    public $address;
    public $area;
    public $ownership;
    public $description;
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
            'sub_category' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'location' => 'required',
            'area' => 'required',
            'ownership' => 'required',
            'description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'conservation' => 'required',
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

        CulturalHeritage::create([
            'cultural_heritage_category' => 'Significant Natural Resources',
            'cultural_heritage_type' => 'Bodies of Water',
            'name' => $this->name,
            'photo_details' => $this->fields,

            'sub_category' => $this->sub_category,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'location' => $this->location,
            'address' => $this->address,
            'area' => $this->area,
            'ownership' => $this->ownership,
            'description' => $this->description,
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
        return view('livewire.admin.mapping-heritage.types.bodies-of-water');
    }
}
