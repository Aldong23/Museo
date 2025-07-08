<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use App\Models\ArtifactsRestoration as ModelsArtifactsRestoration;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
#[Title('Artifacts Restoration')]
class ArtifactsRestoration extends Component
{
    use WithPagination;

    public $search = '';
    public $status_filter;
    public $page = 20;

    public $restored_count;
    public $in_progress_count;
    public $print;

    public function print($id)
    {
        $this->print = ModelsArtifactsRestoration::where('id', $id)
            ->whereHas('artifact', function ($q) {
                $q->withoutTrashed();
            })
            ->first();
        
        if (!$this->print) {
            session()->flash('error', 'This artifact restoration record is not available.');
            return;
        }

        $this->dispatch('print-page');
    }


    public function filter($status)
    {
        $this->status_filter = $status;
        $this->resetPage();
    }

    public function render()
    {
        $this->restored_count = ModelsArtifactsRestoration::where('status', 'Restored')
            ->whereHas('artifact', function ($q) {
                $q->withoutTrashed();
            })
            ->count();
    
        $this->in_progress_count = ModelsArtifactsRestoration::where('status', 'In-Progress')
            ->whereHas('artifact', function ($q) {
                $q->withoutTrashed();
            })
            ->count();
    
        $artifacts = ModelsArtifactsRestoration::query()
            ->whereHas('artifact', function ($q) {
                $q->withoutTrashed();
            })
            ->when($this->search, function ($q) {
                $q->whereHas('artifact', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('category', 'like', '%' . $this->search . '%')
                        ->orWhere('type', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->status_filter, function ($q) {
                $q->where('status', $this->status_filter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->page);
    
        return view('livewire.admin.artifacts-management.artifacts-restoration', [
            'artifacts' => $artifacts
        ]);
    }
    

}
