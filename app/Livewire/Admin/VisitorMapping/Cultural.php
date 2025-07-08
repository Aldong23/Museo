<?php

namespace App\Livewire\Admin\VisitorMapping;

use App\Models\CulturalInstitutions;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Cultural Institutions')]
#[Layout('components.layouts.visitor-layout')]
class Cultural extends Component
{
    use WithPagination;

    public $search;
    public $pages = 10;

    public function render()
    {

        $institutions = CulturalInstitutions::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy('cultural_heritage_type')
            ->paginate($this->pages);

        return view('livewire.admin.visitor-mapping.cultural', [
            'institutions' => $institutions->groupBy('cultural_heritage_type'),
            'pagination' => $institutions,
        ]);
    }
}
