<?php

namespace App\Livewire\Admin\VisitorMapping;

use App\Models\CulturalHeritage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Significant Natural Resources')]
#[Layout('components.layouts.visitor-layout')]
class Snr extends Component
{
    use WithPagination;

    public $search;
    public $pages = 10;

    public function render()
    {
        $categories = CulturalHeritage::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy('cultural_heritage_type')
            ->paginate($this->pages);

        return view('livewire.admin.visitor-mapping.snr', [
            'categories' => $categories->groupBy('cultural_heritage_type'),
            'pagination' => $categories,
        ]);
    }
}
