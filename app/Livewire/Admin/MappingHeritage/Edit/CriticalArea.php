<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\CulturalHeritage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CriticalArea extends Component
{
    use WithFileUploads;

    public $heritage;
    public $name;
    public $fields = [];
    public $hazard;
    public $location;
    public $address;
    public $summary;
    public $description;
    public $stories;
    public $significance;
    public $conservation;
    public $references;
    public $mappers;
    public $date_profiled;
    public $attachment_image;

    public $categories;
    public $types;
    public $selectedCategory;
    public $selectedType;

    public function mount($id)
    {
        $heritage = CulturalHeritage::find($id);

        $this->heritage = $heritage;
        $this->name = $heritage->name;
        $this->fields = $heritage->photo_details ?? [['photos' => [], 'photo_credit' => '', 'photo_date' => '']];
        $this->hazard = $heritage->existing_hazard_type;
        $this->location = $heritage->location;
        $this->address = $heritage->address;
        $this->summary = $heritage->summary;
        $this->references = $heritage->references;
        $this->mappers = $heritage->name_of_mapper;
        $this->attachment_image = $heritage->attachment;
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

        // Reset selected subcategory
        $this->selectedType = null;
    }

    public function addField()
    {
        $this->fields[] = ['photos' => [], 'photo_credit' => '', 'photo_date' => ''];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields); // Re-index array
    }

    public function change2()
    {
        $this->attachment_image = null;
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
            'name' => 'required|string',
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos' => 'nullable|max:10240',
            'hazard' => 'required|string',
            'location' => 'required|string',
            'address' => 'nullable|string',
            'summary' => 'required|string',
            'references' => 'required|string',
            'mappers' => 'required|string',
            'date_profiled' => 'required|date',
        ]);

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

        if ($this->attachment_image) {
            $original_name = $this->attachment_image->getClientOriginalName();
            $attachment_img_path = $this->attachment_image->storeAs('attachment-images', time() . '-' . $original_name, 'public');
        } else {
            $attachment_img_path = $this->heritage->attachment;
        }

        $this->heritage->update([
            'name' => $this->name,
            'photo_details' => $this->fields,
            'location' => $this->location,
            'address' => $this->address,
            'existing_hazard_type' => $this->hazard,
            'summary' => $this->summary,
            'references' => $this->references,
            'name_of_mapper' => $this->mappers,
            'date_profiled' => $this->date_profiled,
            'attachment' => $attachment_img_path,
        ]);

        flash()->success('Critical Area Updated!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.critical-area');
    }
}
