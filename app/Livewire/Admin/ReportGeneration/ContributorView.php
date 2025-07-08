<?php

namespace App\Livewire\Admin\ReportGeneration;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Contributor;

class ContributorView extends Component
{
    public $contributors;
    public function mount($id)
    {
        $this->contributors = Contributor::whereHas('artifact')->find($id);
    }

    public function render() 
    {
    
        return view('livewire.admin.report-generation.contributor-view');
    }
    
}
