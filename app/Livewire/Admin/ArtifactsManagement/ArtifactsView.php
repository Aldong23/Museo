<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use Carbon\Carbon;
use Livewire\Component;

class ArtifactsView extends Component
{
    public $artifact;

    public function mount($id)
    {
        $this->artifact = Artifact::find($id);
       
    }

    public function render()
    {
        return view('livewire.admin.artifacts-management.artifacts-view', [
            'artifact' => $this->artifact,
        ]);
    }
}
