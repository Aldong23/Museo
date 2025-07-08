<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\ArtifactExhibit;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Exhibit Monitoring')]
class ArtifactsExhibitMonitoring extends Component
{

    use WithPagination;

    public $page = 20;
    public $search;
    public $status_filter = null;

    public function filter($status)
    {
        $this->status_filter = $status;
        $this->resetPage(); // Reset pagination when filtering
    }

    public function render()
    {
        $exhibits = ArtifactExhibit::query()
            ->when($this->search, function ($query) {
                $query->where('program_name', 'like', '%' . $this->search . '%');
            })
            ->when($this->status_filter, function ($query) {
                $query->where('status', $this->status_filter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->page);

        return view('livewire.admin.artifacts-management.artifacts-exhibit-monitoring', [
            'exhibits' => $exhibits
        ]);
    }
}
