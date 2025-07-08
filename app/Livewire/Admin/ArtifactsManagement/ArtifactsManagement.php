<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Artifacts Management')]
class ArtifactsManagement extends Component
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

    // Date filter properties
    public $year;
    public $month;
    public $day;
    public $days = [];

    public function mount()
    {

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

        $this->selectedType = null;
    }

    public function openArchive($id)
    {
        $this->artifactsInfo = Artifact::find($id);

        $this->dispatch('open-archive');
    }

    public function archiveArtifact($id)
    {
        $artifact = Artifact::find($id);
        if ($artifact) {
            $artifact->delete();
            flash()->success('Artifact deleted successfully.');
        }

        $this->dispatch('close-archive');
    }


    // Update days based on selected month and year
    public function updateDays()
    {
        if ($this->month && $this->year) {
            $this->days = range(1, cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year));
        } else {
            $this->days = [];
        }
    }

    public function updatedMonth()
    {
        $this->updateDays();
    }

    public function updatedYear()
    {
        $this->updateDays();
    }

    public function render()
    {
        $this->artifacts_count = Artifact::count();
        $artifacts = Artifact::where('status', 'Approved')
            ->when($this->selectedCategory, fn($q) => $q->where('category', $this->selectedCategory))
            ->when($this->selectedType, fn($q) => $q->where('type', $this->selectedType))
            ->when($this->search, fn($q) =>
                $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('category', 'like', '%' . $this->search . '%')
                ->orWhere('type', 'like', '%' . $this->search . '%')
            )
            ->when($this->year, fn($q) => $q->whereYear('created_at', $this->year))
            ->when($this->month, fn($q) => $q->whereMonth('created_at', $this->month))
            ->when($this->day, fn($q) => $q->whereDay('created_at', $this->day))
            ->orderBy('views', 'desc')
            ->paginate($this->page);

        return view('livewire.admin.artifacts-management.artifacts-management', [
            'artifacts' => $artifacts
        ]);
    }
}
