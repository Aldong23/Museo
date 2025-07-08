<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\CulturalHeritage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Plants extends Component
{
    use WithFileUploads;

    public $heritageId;
    public $name;
    public $fields = [];
    public $lists = [];
    public $other_common_name;
    public $scientific_name;
    public $classification_to_growth;
    public $classification_to_origin;
    public $habitat;
    public $location;
    public $address;
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
    public $categories;
    public $types;
    public $selectedCategory;
    public $selectedType;

    public function mount($id)
    {
        $this->heritageId = $id;
        $heritage = CulturalHeritage::findOrFail($id);

        $this->name = $heritage->name;
        $this->fields = $heritage->photo_details ?? [['photo_credit' => '', 'photo_date' => '', 'photos' => []]];
        $this->other_common_name = $heritage->other_common_name;
        $this->scientific_name = $heritage->scientific_name;
        $this->classification_to_growth = $heritage->classification_growth_habit;
        $this->classification_to_origin = $heritage->classification_origin;
        $this->habitat = $heritage->habitat;
        $this->location = $heritage->location;
        $this->address = $heritage->address;
        $this->visibility = $heritage->indicate_visibility;
        $this->seasonability = $heritage->indicate_seasonability;
        $this->description = $heritage->description;
        $this->scope_of_use = $heritage->common_uses;
        $this->remarks = $heritage->remarks;
        $this->stories = $heritage->stories;
        $this->significance = $heritage->significance;
        $this->conservation = $heritage->conservation;
        $this->references = $heritage->references;
        $this->mappers = $heritage->name_of_mapper;
        $this->date_profiled = $heritage->date_profiled ? Carbon::parse($heritage->date_profiled)->format('Y-m-d') : now()->format('Y-m-d');

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
            'location' => 'required',
            'description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'conservation' => 'required',
            'references' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required',
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

        $heritage = CulturalHeritage::findOrFail($this->heritageId);

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

        flash()->success('Updated!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.plants');
    }
}
