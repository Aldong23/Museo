<?php

namespace App\Livewire\Admin\ArtifactsManagement;
use App\Models\ArtifactsRestoration;

use Livewire\Component;

class ArtifactsRestorationView extends Component
{
    public $restoration;

    public function mount($id)
    {
        $this->restoration = ArtifactsRestoration::with('artifact')->find($id);
       
    }

    public function render()
    {
        return view('livewire.admin.artifacts-management.artifacts-restoration-view', [
            'restoration' => $this->restoration,
        ]);
    }
}
