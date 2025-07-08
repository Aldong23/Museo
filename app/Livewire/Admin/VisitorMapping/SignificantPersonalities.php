<?php

namespace App\Livewire\Admin\VisitorMapping;

use App\Models\SignificantPersonalities as ModelsSignificantPersonalities;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;

#[Title('Significant Personalities')]
#[Layout('components.layouts.visitor-layout')]
class SignificantPersonalities extends Component
{
    use WithPagination;

    public $search;
    public $pages = 10;

    public function render()
    {

        $categories = ModelsSignificantPersonalities::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })->paginate($this->pages);


        return view('livewire.admin.visitor-mapping.significant-personalities', [
            'categories' => $categories
        ]);
    }
}
