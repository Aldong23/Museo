<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use App\Models\ArtifactRestoration;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

class ArtifactsArchived extends Component
{
    use WithPagination;


    public $page = 20;
    public $search;
    public $artifacts_count;
    public $categories = [];
    public $types = [];
    public $selectedCategory = null;
    public $selectedType = null;
    public $artifactsInfo;

    public function mount()
    {
        
        $user = auth()->user();

        if ($user->is_admin_staff) {
            redirect()->to('/artifacts-exhibit-monitoring');
        }


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
                'Paintings',
                'Poster',
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

    public function openArchive($id)
    {
        $this->artifactsInfo = Artifact::onlyTrashed()->find($id);

        $this->dispatch('open-archive');
    }

    public function restoreArtifact($id)
    {
        $artifact = Artifact::onlyTrashed()->find($id);
        if ($artifact) {
            $artifact->restore();

            flash()->success('Artifact restored successfully.');
        } else {
            flash()->error('Artifact not found.');
        }

        $this->dispatch('close-archive');
    }

    public function render()
    {
        $this->artifacts_count = Artifact::onlyTrashed()->count();

        $artifacts = Artifact::onlyTrashed()
            ->where('status', 'Approved')
            ->when($this->selectedCategory, function ($q) {
                $q->where('category', $this->selectedCategory);
            })
            ->when($this->selectedType, function ($q) {
                $q->where('type', $this->selectedType);
            })
            ->when($this->search, function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('category', 'like', '%' . $this->search . '%')
                    ->orWhere('type', 'like', '%' . $this->search . '%');
            })->paginate($this->page);

        return view('livewire.admin.artifacts-management.artifacts-archived', [
            'artifacts' => $artifacts
        ]);
    }
}
