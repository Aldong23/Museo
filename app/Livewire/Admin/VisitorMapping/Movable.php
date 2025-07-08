<?php

namespace App\Livewire\Admin\VisitorMapping;

use App\Models\TangibleMovableCulturalHeritage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Tanggible Movable Cultural Heritage')]
#[Layout('components.layouts.visitor-layout')]
class Movable extends Component
{
    use WithPagination;

    public $search;
    public $pages = 10;

    public function render()
    {
        $categories = TangibleMovableCulturalHeritage::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy('cultural_heritage_type')
            ->paginate($this->pages);

        return view('livewire.admin.visitor-mapping.movable', [
            'categories' => $categories->groupBy('cultural_heritage_type'),
            'pagination' => $categories,
        ]);
    }
}
