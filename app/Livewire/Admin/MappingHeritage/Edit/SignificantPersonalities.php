<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\SignificantPersonalities as ModelsSignificantPersonalities;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SignificantPersonalities extends Component
{
    use WithFileUploads;

    public $heritage;
    public $fields = [];
    public $name;
    public $date_of_birth;
    public $date_of_death;
    public $age;
    public $type;
    public $birthplace;
    public $present_address;
    public $biography;
    public $significance;
    public $references;
    public $mapper;
    public $date_profiled;
    public $attachment;

    public $selectedCategory;

    public function mount($id)
    {
        $this->heritage = ModelsSignificantPersonalities::findOrFail($id);

        $this->name = $this->heritage->name;
        $this->fields = $this->heritage->photo_details ?? [['photo_credit' => '', 'photo_date' => '', 'photos' => []]];
        $this->date_of_birth = $this->heritage->date_of_birth ? Carbon::parse($this->heritage->date_of_birth)->format('Y-m-d') : now()->format('Y-m-d');
        $this->date_of_death = $this->heritage->date_of_death ? Carbon::parse($this->heritage->date_of_death)->format('Y-m-d') : now()->format('Y-m-d');
        $this->age = $this->heritage->age;
        $this->type = $this->heritage->prominence;
        $this->birthplace = $this->heritage->birthplace;
        $this->present_address = $this->heritage->present_address;
        $this->biography = $this->heritage->biography;
        $this->significance = $this->heritage->significance;
        $this->references = $this->heritage->references;
        $this->mapper = $this->heritage->mapper;
        $this->date_profiled = $this->heritage->date_profiled ? Carbon::parse($this->heritage->date_profiled)->format('Y-m-d') : now()->format('Y-m-d');
        $this->attachment = $this->heritage->attachment;

        $this->selectedCategory = $this->heritage->cultural_heritage_category;
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
            'date_of_birth' => 'required|date',
            'date_of_death' => 'nullable|date|after_or_equal:date_of_birth',
            'age' => 'required|integer|min:0',
            'type' => 'required|string|max:500',
            'birthplace' => 'required|string|max:255',
            'present_address' => 'required|string|max:255',
            'biography' => 'required|string',
            'significance' => 'required|string',
            'references' => 'required|string',
            'mapper' => 'required|string',
            'date_profiled' => 'required|date',
        ]);

        // Handle new photo uploads
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
            'date_of_birth' => $this->date_of_birth,
            'date_of_death' => $this->date_of_death,
            'age' => $this->age,
            'prominence' => $this->type,
            'birthplace' => $this->birthplace,
            'present_address' => $this->present_address,
            'biography' => $this->biography,
            'significance' => $this->significance,
            'references' => $this->references,
            'mapper' => $this->mapper,
            'date_profiled' => $this->date_profiled,
        ]);

        flash()->success('Updated successfully!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.significant-personalities');
    }
}
