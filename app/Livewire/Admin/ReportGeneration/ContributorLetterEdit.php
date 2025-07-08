<?php

namespace App\Livewire\Admin\ReportGeneration;

use Livewire\Component;
use App\Models\Letter;

class ContributorLetterEdit extends Component
{
    public $name = 'Contributor Letter';
    public $content = '';

    public function mount()
    {
        $letter = Letter::where('name', 'Contributor Letter')->first();
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
        return view('livewire.admin.report-generation.contributor-letter-edit');
    }
}
