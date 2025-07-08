<?php

namespace App\Livewire\Admin\VisitorMapping;

use App\Models\IntangibleCulturalHeritage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Intangible Cultural Heritage')]
#[Layout('components.layouts.visitor-layout')]
class Intangible extends Component
{

    use WithPagination;

    public $search;
    public $pages = 10;


    public function render()
    {
        $categories = IntangibleCulturalHeritage::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })
            ->orderBy('cultural_heritage_type')
            ->paginate($this->pages);

        return view('livewire.admin.visitor-mapping.intangible', [
            'categories' => $categories->groupBy('cultural_heritage_type'),
            'pagination' => $categories,
        ]);
    }
}
