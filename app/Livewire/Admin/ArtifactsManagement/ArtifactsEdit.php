<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class ArtifactsEdit extends Component
{
    use WithFileUploads;

    public $artifact;
    public $categories = [];
    public $types = [];
    public $selectedCategory = null;
    public $selectedType = null;

    public $name;
    public $date_photograph;
    public $owned_by;
    public $donated_by;
    public $description;
    public $story;
    public $existingImages;
    public $collections;


    public function mount($id)
    {
        $this->artifact = Artifact::find($id);
        $art = Artifact::find($id);

        $this->name = $art->name;
        $this->date_photograph =  $art->date_photograph ? Carbon::parse($art->date_photograph)->format('Y-m-d') : now()->format('Y-m-d');
        $this->owned_by = $art->owned_by;
        $this->donated_by = $art->donated_by;
        $this->description = $art->description;
        $this->story = $art->story;
        $this->existingImages = $art->collections;


        $this->categories = [
            'Significant Natural Resources' => 'Significant Natural Resources',
            'Tangible-Immovable Cultural Heritage' => 'Tangible-Immovable Cultural Heritage',
            'Tangible Movable Culture' => 'Tangible Movable Culture',
            'Intangible Culture Heritage' => 'Intangible Culture Heritage',
            'Significant Personalities' => 'Significant Personalities',
            'Cultural Institutions' => 'Cultural Institutions',
        ];

        $this->types = [];

        $this->selectedCategory = $art->category;

        if ($this->selectedCategory) {

            $this->updateSubcategories();
        }
        $this->selectedType = $art->type;
    }

    public function removeExistingImage($index)
    {
        unset($this->existingImages[$index]);
        $this->existingImages = array_values($this->existingImages);
    }


    public function updateSubcategories()
    {
        // types of cultural heritage
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
            ],
            'Tangible Movable Culture' => [
                'Ethnographic Object',
                'Ethnographic Materials',
                'Archival Holdings',
                'Fine Arts',
                'Antiques Objects',
                'Numismatic',
                'Trophy',
                'Events',
                'Certificates',
                'Books',
                'Statue',
            ],
            'Intangible Culture Heritage' => [
                'Social Practices',
                'Knowledge and Practices',
                'Traditional Craftsmanship',
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


    public function change1()
    {
        $this->collections = null;
    }

    public function update()
    {
        if($this->selectedCategory === 'Significant Personalities'){
            
            $this->validate([
                'selectedCategory' => 'required',
                'name' => 'required',
                'description' => 'required',
                'collections' => 'required',
            ]);
            
        }else{
            
            $this->validate([
                'selectedCategory' => 'required',
                'selectedType' => 'required',
                'name' => 'required',
                'description' => 'required',
                'collections' => 'required',
            ]);
        }

        $imagePaths = $this->existingImages;
        if ($this->collections) {

            foreach ($this->collections as $image) {
                $originalName = $image->getClientOriginalName();
                $path = $image->storeAs('artifacts-images', time() . '-' . $originalName, 'public');

                $imagePaths[] = $path;
            }
        }

        $this->artifact->update([
            'category' => $this->selectedCategory,
            'type' => $this->selectedType,
            'name' => $this->name,
            'date_photograph' => $this->date_photograph,
            'owned_by' => $this->owned_by,
            'donated_by' => $this->donated_by,
            'description' => $this->description,
            'story' => $this->story,
            'collections' => $imagePaths,
        ]);


        flash()->success('Artifacts Updated!');

        return redirect('/artifacts-managements');
    }


    public function render()
    {
        return view('livewire.admin.artifacts-management.artifacts-edit');
    }
}
