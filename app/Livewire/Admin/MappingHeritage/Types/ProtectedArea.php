<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProtectedArea extends Component
{
    use WithFileUploads;

    public $name;
    public $fields = [];
    public $lists = [];
    public $category;
    public $classification;
    public $location;
    public $address;
    public $area;
    public $legislation;
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
        // Validate the input data
        $this->validate([
            'name' => 'required|string|max:255',
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos.*' => 'required|max:10240',
            'category' => 'required|string|max:255',
            'classification' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'area' => 'required',
            'legislation' => 'nullable|string|max:255',
            'description' => 'required|string',
            'stories' => 'nullable|string',
            'significance' => 'nullable|string',
            'conservation' => 'nullable|string',
            'references' => 'nullable|string',
            'mappers' => 'nullable|string',
            'date_profiled' => 'required|date',
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

        // Create the record in the database
        CulturalHeritage::create([
            'cultural_heritage_category' => 'Significant Natural Resources',
            'cultural_heritage_type' => 'Protected Area',
            'name' => $this->name,
            'photo_details' => $this->fields,
            'category' => $this->category,
            'classification' => $this->classification,
            'location' => $this->location,
            'address' => $this->address,
            'area' => $this->area,
            'legislation' => $this->legislation,
            'description' => $this->description,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'conservation' => $this->conservation,
            'references' => $this->references,
            'name_of_mapper' => $this->mappers,
            'date_profiled' => $this->date_profiled,
        ]);

        // Success message and redirect
        flash()->success('Protected Area Created!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.protected-area');
    }
}
