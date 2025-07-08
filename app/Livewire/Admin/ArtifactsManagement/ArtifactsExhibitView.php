<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use Livewire\Component;
use App\Models\ArtifactExhibit;
use App\Models\Artifact;
use App\Models\User;

class ArtifactsExhibitView extends Component
{
    public $exhibit;
    public $artifacts = [];
    public $adminUser;

    public function mount($id) 
    {
        $this->exhibit = ArtifactExhibit::findOrFail($id);

        $artifactIds = $this->exhibit->artifacts_id ?? [];

        $this->artifacts = Artifact::whereIn('id', $artifactIds)
                                    ->whereNull('deleted_at')
                                    ->get();

         $this->adminUser = User::where('is_admin', 1)->first();
    }

    public function render()
    {
        return view('livewire.admin.artifacts-management.artifacts-exhibit-view', [
            'exhibit' => $this->exhibit,
            'artifacts' => $this->artifacts,
        ]);
    }
}
