<?php

namespace App\Livewire\Admin\VisitorMonitoring;

use Livewire\Component;
use App\Models\Visitor;
use Livewire\WithPagination;
use App\Models\VisitorRecord;

class VisitorProfileView extends Component
{
    use WithPagination;

    public $visitor;
    public $visitCount;
    public $page = 20;

    public function mount($id)
    {
        $this->visitor = Visitor::find($id);
        $this->visitCount = VisitorRecord::where('visitor_id', $this->visitor->id)
            ->whereNotNull('approved_by')
            ->count();

    }

    public function render()
    {
        $visitorRecords = VisitorRecord::where('visitor_id', $this->visitor->id)
            ->whereNotNull('approved_by')
            ->latest('created_at')
            ->with('approvedByUser')
            ->paginate($this->page);
    
        return view('livewire.admin.visitor-monitoring.visitor-profile-view', [
            'visitorRecords' => $visitorRecords
        ]);
    }
    
}
