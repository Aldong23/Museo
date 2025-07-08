<?php

namespace App\Livewire\Admin\ReportGeneration;
use App\Models\Feedback;

use Livewire\Component;

class VisitorFeedbackView extends Component
{
    public $feedback;

    public function mount($id)
    {
        $this->feedback = Feedback::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.report-generation.visitor-feedback-view', [
            'feedback' => $this->feedback
        ]);
    }
}
