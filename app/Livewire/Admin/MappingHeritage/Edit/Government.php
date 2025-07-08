<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\TangibleImmovableCulturalHeritage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Government extends Component
{
    use WithFileUploads;

    public $heritage;
    public $fields = [];
    public $lists = [];

    public $name;
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

    public $selectedCategory;
    public $selectedType;

    public function mount($id)
    {
        $this->heritage = TangibleImmovableCulturalHeritage::findOrFail($id);

        // Populate form fields with existing data
        $this->name = $this->heritage->name;
        $this->fields = $this->heritage->photo_details ?? [];
        $this->lists = $this->heritage->list_of_cultural_props ?? [];

        $this->type = $this->heritage->type;
        $this->ownership = $this->heritage->ownership;
        $this->location = $this->heritage->location;
        $this->address = $this->heritage->address;
        $this->latitude = $this->heritage->latitude;
        $this->longitude = $this->heritage->longitude;
        $this->year_constructed = $this->heritage->year_constructed;
        $this->area = $this->heritage->area;
        $this->structure = $this->heritage->structure;
        $this->estimated_age = $this->heritage->estimated_age;
        $this->ownership_jurisdiction = $this->heritage->ownership_jurisdiction;
        $this->declaration_legislation = $this->heritage->declaration_legislation;
        $this->description = $this->heritage->description;
        $this->stories = $this->heritage->stories;
        $this->significance = $this->heritage->significance;
        $this->condition_of_structure = $this->heritage->condition_of_structure;
        $this->remarks_1 = $this->heritage->remarks_1;
        $this->integrity_of_structure = $this->heritage->integrity_of_structure;
        $this->remarks_2 = $this->heritage->remarks_2;
        $this->references = $this->heritage->references;
        $this->mappers = $this->heritage->name_of_mapper;
        $this->date_profiled = $this->heritage->date_profiled ? Carbon::parse($this->heritage->date_profiled)->format('Y-m-d') : now()->format('Y-m-d');

        $this->selectedCategory = $this->heritage->cultural_heritage_category;
        $this->selectedType = $this->heritage->cultural_heritage_type;
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
        $this->lists[] = [
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

    public function removePhoto($index, $photoIndex)
    {
        if (isset($this->fields[$index]['photos'][$photoIndex])) {
            $photoPath = $this->fields[$index]['photos'][$photoIndex];

            // Ensure it's not a newly uploaded file before attempting deletion
            if (!($photoPath instanceof \Illuminate\Http\UploadedFile) && Storage::exists("app/public/{$photoPath}")) {
                Storage::delete("app/public/{$photoPath}");
            }

            // Remove from the array
            unset($this->fields[$index]['photos'][$photoIndex]);
            $this->fields[$index]['photos'] = array_values($this->fields[$index]['photos']); // Reset keys
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos.*' => 'required|max:10240',
            'lists.*.name_of_built_structure' => 'required',
            'lists.*.photo' => 'required|max:10240',
            'lists.*.year_produced' => 'required',

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
            'condition_of_structure' => 'required',
            'remarks_1' => 'required',
            'integrity_of_structure' => 'required',
            'remarks_2' => 'required',
            'references' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required',
        ]);

        // Handle photo uploads
        foreach ($this->fields as $index => $field) {
            $photoPaths = [];

            foreach ($field['photos'] as $photo) {
                if ($photo instanceof \Illuminate\Http\UploadedFile) {
                    $originalName = $photo->getClientOriginalName();
                    $uniqueName = time() . '-' . uniqid() . '-' . $originalName;
                    $path = $photo->storeAs('featured-collections', $uniqueName, 'public');
                    $photoPaths[] = $path;
                } else {

                    $photoPaths[] = $photo;
                }
            }


            $this->fields[$index]['photos'] = array_values(array_unique($photoPaths));
        }

        foreach ($this->lists as $index => $list) {
            if (!empty($list['photo']) && is_object($list['photo'])) {
                $originalName = $list['photo']->getClientOriginalName();
                $path = $list['photo']->storeAs('cultural-lists', time() . '-' . $originalName, 'public');

                $this->lists[$index]['photo'] = $path;
            }
        }

        // Update the existing record
        $this->heritage->update([
            'name' => $this->name,
            'photo_details' => $this->fields,
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
            'ownership_jurisdiction' => $this->ownership_jurisdiction,
            'declaration_legislation' => $this->declaration_legislation,
            'description' => $this->description,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'condition_of_structure' => $this->condition_of_structure,
            'remarks_1' => $this->remarks_1,
            'integrity_of_structure' => $this->integrity_of_structure,
            'remarks_2' => $this->remarks_2,
            'list_of_cultural_props' => $this->lists,
            'references' => $this->references,
            'name_of_mapper' => $this->mappers,
            'date_profiled' => $this->date_profiled,
        ]);

        flash()->success('Updated successfully!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.government');
    }
}
