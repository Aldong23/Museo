<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\CulturalHeritage;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Animals extends Component
{
    use WithFileUploads;

    public $heritage_id;
    public $name;
    public $fields = [];

    public $other_common_name;
    public $scientific_name;
    public $classification;
    public $classification_to_origin;
    public $habitat;
    public $special_notes;
    public $visibility;
    public $most_seen;
    public $description;
    public $stories;
    public $significance;
    public $conservation;
    public $references;
    public $mappers;
    public $date_profiled;

    public $categories;
    public $types;
    public $selectedCategory;
    public $selectedType;

    public function mount($id)
    {

        $heritage = CulturalHeritage::find($id);
        $this->heritage_id = $id;
        $this->name = $heritage->name;
        $this->other_common_name = $heritage->other_common_name;
        $this->scientific_name = $heritage->scientific_name;
        $this->classification = $heritage->classification;
        $this->classification_to_origin = $heritage->classification_origin;
        $this->habitat = $heritage->habitat;
        $this->special_notes = $heritage->special_notes;
        $this->visibility = $heritage->indicate_visibility;
        $this->most_seen = $heritage->time_of_year_most_seen;
        $this->description = $heritage->description;
        $this->stories = $heritage->stories;
        $this->significance = $heritage->significance;
        $this->conservation = $heritage->conservation;
        $this->references = $heritage->references;
        $this->mappers = $heritage->name_of_mapper;
        $this->date_profiled = $heritage->date_profiled ? Carbon::parse($heritage->date_profiled)->format('Y-m-d') : now()->format('Y-m-d');

        $this->fields = $heritage->photo_details ?? [
            ['photo_credit' => '', 'photo_date' => '', 'photos' => []]
        ];

        $this->categories = [
            'Significant Natural Resources' => 'Significant Natural Resources',
            'Tangible-Immovable Cultural Heritage' => 'Tangible-Immovable Cultural Heritage',
            'Tangible Movable Culture' => 'Tangible Movable Culture',
            'Intangible Culture Heritage' => 'Intangible Culture Heritage',
            'Significant Personalities' => 'Significant Personalities',
            'Cultural Institutions' => 'Cultural Institutions',
        ];

        $this->selectedCategory = $heritage->cultural_heritage_category;

        $this->updateTypes();

        $this->selectedType = $heritage->cultural_heritage_type;
    }

    public function updateTypes()
    {

        $this->types = match ($this->selectedCategory) {
            'Significant Natural Resources' => [
                'Bodies of Water',
                'Plants (Flora)',
                'Animals (Fauna)',
                'Protected Area',
                'Critical Area',
            ],
            'Tangible-Immovable Cultural Heritage' => [
                'Government/Private',
                'School',
                'Hospital',
                'Church',
                'Monuments',
                'Sites',
                'Houses',
                'Houses with Period',
            ],
            'Tangible Movable Culture' => [
                'Ethnographic Object',
                'Archival Holdings',
            ],
            'Intangible Culture Heritage' => [
                'Social Practices',
                'Knowledge and Practices',
                'Traditional Craftsmanship',
                'Oral Tradition',
            ],
            'Cultural Institutions' => [
                'Associations',
                'Library',
                'Political Clan',
                'School Institutions',
            ],
            default => [],
        };

        // Reset selected subcategory
        $this->selectedType = null;
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
            'fields.*.photos' => 'nullable|max:10240',
            'description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'conservation' => 'required',
            'references' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required',
            'other_common_name' => 'required',
            'scientific_name' => 'required',
            'classification' => 'required',
            'classification_to_origin' => 'required',
            'habitat' => 'required',
            'special_notes' => 'required',
            'visibility' => 'required',
            'most_seen' => 'required',
        ]);

        $heritage = CulturalHeritage::findOrFail($this->heritage_id);

        foreach ($this->fields as $index => $field) {
            $photoPaths = [];

            foreach ($field['photos'] as $key => $photo) {
                if ($photo instanceof \Illuminate\Http\UploadedFile) {
                    $originalName = $photo->getClientOriginalName();
                    $uniqueName = time() . '-' . uniqid() . '-' . $originalName;
                    $path = $photo->storeAs('featured-collections', $uniqueName, 'public');
                    $photoPaths[] = $path;
                } else {
                    // Keep only existing stored photos that were not removed
                    $photoPaths[] = $photo;
                }
            }

            // Update only the photos field for this entry
            $this->fields[$index]['photos'] = array_values(array_unique($photoPaths));
        }



        $heritage->update([
            'name' => $this->name,
            'photo_details' => $this->fields,
            'other_common_name' => $this->other_common_name,
            'scientific_name' => $this->scientific_name,
            'classification' => $this->classification,
            'classification_origin' => $this->classification_to_origin,
            'habitat' => $this->habitat,
            'special_notes' => $this->special_notes,
            'indicate_visibility' => $this->visibility,
            'time_of_year_most_seen' => $this->most_seen,
            'description' => $this->description,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'conservation' => $this->conservation,
            'references' => $this->references,
            'name_of_mapper' => $this->mappers,
            'date_profiled' => $this->date_profiled,
        ]);

        flash()->success('Updated Successfully!');
        return redirect('/mapping-heritage');
    }



    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.animals');
    }
}
