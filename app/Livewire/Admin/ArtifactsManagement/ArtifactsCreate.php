<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use Livewire\Component;
use Livewire\WithFileUploads;
use Psy\CodeCleaner\ReturnTypePass;

class ArtifactsCreate extends Component
{
    use WithFileUploads;

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
    public $collections;


    public function mount()
    {
        // Cultural heritage categories
        $this->categories = [
            'Significant Natural Resources' => 'Significant Natural Resources',
            'Tangible-Immovable Cultural Heritage' => 'Tangible-Immovable Cultural Heritage',
            'Tangible Movable Culture' => 'Tangible Movable Culture',
            'Intangible Culture Heritage' => 'Intangible Culture Heritage',
            'Significant Personalities' => 'Significant Personalities',
            'Cultural Institutions' => 'Cultural Institutions',
        ];

        $this->types = [];
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

    public function save()
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

        $lastArtifact = Artifact::latest('id')->first();
        $incrementingNumber = $lastArtifact ? ($lastArtifact->id + 1) : 1;
        $artifactNo = 'MDU' . str_pad($incrementingNumber, 6, '0', STR_PAD_LEFT);

        $imagePaths = [];
        foreach ($this->collections as $image) {
            $originalName = $image->getClientOriginalName();
            $path = $image->storeAs('artifacts-images', time() . '-' . $originalName, 'public');

            $imagePaths[] = $path;
        }

        Artifact::create([
            'artifact_no' => $artifactNo,
            'category' => $this->selectedCategory,
            'type' => $this->selectedType,
            'name' => $this->name,
            'date_photograph' => $this->date_photograph,
            'owned_by' => $this->owned_by,
            'donated_by' => $this->donated_by,
            'description' => $this->description,
            'story' => $this->story,
            'collections' => $imagePaths,
            'status' => 'Approved',
        ]);

        flash()->success('Artifacts Added!');

        return redirect('/artifacts-managements');
    }


    public function render()
    {
        return view('livewire.admin.artifacts-management.artifacts-create');
    }
}
