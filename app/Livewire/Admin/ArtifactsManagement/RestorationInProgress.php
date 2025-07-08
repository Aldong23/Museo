<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use Livewire\Component;
use App\Models\Letter;

class RestorationInProgress extends Component
{

    public $name = 'In-Progress Letter';
    public $content = '';

    public function mount()
    {
        $letter = Letter::where('name', 'In-Progress Letter')->first();
        $this->content = $letter ? $letter->content : '';
    }
    
    public function update()
    {
        $this->validate([
            'content' => 'required|string',
        ]);

        $letter = Letter::updateOrCreate(
            ['name' => $this->name],
            ['content' => $this->content]
        );

        flash()->success('Letter saved successfully!');
    }

    public function render()
    {
        return view('livewire.admin.artifacts-management.restoration-in-progress');
    }
}
