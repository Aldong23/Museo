<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\TangibleMovableCulturalHeritage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArchivalHoldings extends Component
{
    use WithFileUploads;

    public $heritage;
    public $heritageId;

    public $name;
    public $fields = [];
    public $type;
    public $date_of_record;
    public $length;
    public $width;
    public $arrangement;
    public $office_of_origin;
    public $contact_person;
    public $description_of_material;
    public $remarks_1;
    public $stories;
    public $significance;
    public $physical_condition;
    public $remarks_2;
    public $narration;
    public $references;
    public $mappers;
    public $date_profiled;

    public $selectedCategory;
    public $selectedType;


    public function mount($id)
    {
        $this->heritageId = $id;
        $this->heritage = TangibleMovableCulturalHeritage::findOrFail($id);

        $this->name = $this->heritage->name;
        $this->fields = $this->heritage->photo_details ?? [['photo_credit' => '', 'photo_date' => '', 'photos' => []]];
        $this->type = $this->heritage->type;
        $this->date_of_record = $this->heritage->date_of_record ? Carbon::parse($this->heritage->date_of_record)->format('Y-m-d') : now()->format('Y-m-d');
        $this->length = $this->heritage->length;
        $this->width = $this->heritage->width;
        $this->arrangement = $this->heritage->arrangement;
        $this->office_of_origin = $this->heritage->office_of_origin;
        $this->contact_person = $this->heritage->contact_person;
        $this->description_of_material = $this->heritage->description_of_material;
        $this->remarks_1 = $this->heritage->remarks_1;
        $this->stories = $this->heritage->stories;
        $this->significance = $this->heritage->significance;
        $this->physical_condition = $this->heritage->physical_condition;
        $this->remarks_2 = $this->heritage->remarks_2;
        $this->narration = $this->heritage->narration;
        $this->references = $this->heritage->references;
        $this->mappers = $this->heritage->mappers;
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
        $this->fields = array_values($this->fields);
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
            'fields.*.photos.*' => 'nullable|max:10240',
            'type' => 'required',
            'date_of_record' => 'required',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'arrangement' => 'required',
            'office_of_origin' => 'required',
            'contact_person' => 'required',
            'description_of_material' => 'required',
            'remarks_1' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'physical_condition' => 'required',
            'remarks_2' => 'required',
            'references' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required',
        ]);

        // Handle photo uploads while retaining existing images
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

        // Update the existing record
        $this->heritage->update([
            'name' => $this->name,
            'photo_details' => $this->fields,
            'type' => $this->type,
            'date_of_record' => $this->date_of_record,
            'length' => $this->length,
            'width' => $this->width,
            'arrangement' => $this->arrangement,
            'office_of_origin' => $this->office_of_origin,
            'contact_person' => $this->contact_person,
            'description_of_material' => $this->description_of_material,
            'remarks_1' => $this->remarks_1,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'physical_condition' => $this->physical_condition,
            'remarks_2' => $this->remarks_2,
            'narration' => $this->narration,
            'references' => $this->references,
            'mappers' => $this->mappers,
            'date_profiled' => $this->date_profiled,
        ]);

        flash()->success('Updated successfully!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.archival-holdings');
    }
}
