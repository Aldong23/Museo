<?php

namespace App\Livewire\Admin\VisitorMonitoring;

use Livewire\Component;
use App\Models\VisitorRecord;
use App\Models\User;

class VisitorView extends Component
{
    public $visitor_record;

    public function mount($id)
    {
        $this->visitor_record = VisitorRecord::with('visitor')->find($id);

    }

    public function render()
    {
        return view('livewire.admin.visitor-monitoring.visitor-view');
    }
}
