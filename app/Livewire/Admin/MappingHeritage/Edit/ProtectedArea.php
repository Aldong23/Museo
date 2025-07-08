<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\CulturalHeritage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ProtectedArea extends Component
{
    use WithFileUploads;

    public $heritageId;
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
        $this->category = $heritage->category;
        $this->classification = $heritage->classification;
        $this->location = $heritage->location;
        $this->address = $heritage->address;
        $this->area = $heritage->area;
        $this->legislation = $heritage->legislation;
        $this->description = $heritage->description;
        $this->stories = $heritage->stories;
        $this->significance = $heritage->significance;
        $this->conservation = $heritage->conservation;
        $this->references = $heritage->references;
        $this->mappers = $heritage->name_of_mapper;
        $this->date_profiled = $heritage->date_profiled  ? Carbon::parse($heritage->date_profiled)->format('Y-m-d') : now()->format('Y-m-d');

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
        $this->fields = array_values($this->fields); // Re-index array
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

        $heritage = CulturalHeritage::findOrFail($this->heritageId);


        // Save featured collections
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
        flash()->success('Protected Area Updated!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.protected-area');
    }
}
