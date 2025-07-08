<?php

namespace App\Livewire\Admin\MappingHeritage;

use App\Models\CulturalHeritage;
use App\Models\CulturalInstitutions;
use App\Models\IntangibleCulturalHeritage;
use App\Models\SignificantPersonalities;
use App\Models\TangibleImmovableCulturalHeritage;
use App\Models\TangibleMovableCulturalHeritage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Mapping Heritage')]
class MappingHeritage extends Component
{
    public $search;
    public $pages = 20;
    public $category;

    public function mount()
    {

        $this->category = 'snr';
    }

    public function allButton()
    {

        $this->category = 'all';
    }

    public function snrButton()
    {

        $this->category = 'snr';
    }

    public function tiButton()
    {

        $this->category = 'ti';
    }

    public function tmButton()
    {

        $this->category = 'tm';
    }

    public function iButton()
    {

        $this->category = 'i';
    }

    public function spButton()
    {

        $this->category = 'sp';
    }

    public function ciButton()
    {

        $this->category = 'ci';
    }

    public function render()
    {
        // Paginated Data for Listing
        $heritages = CulturalHeritage::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->paginate($this->pages);

        $tangible_immovable = TangibleImmovableCulturalHeritage::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->paginate($this->pages);

        $significant_personalities = SignificantPersonalities::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->paginate($this->pages);

        $tangible_movable = TangibleMovableCulturalHeritage::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->paginate($this->pages);

        $intangible = IntangibleCulturalHeritage::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->paginate($this->pages);

        $cultural_institutions = CulturalInstitutions::query()
            ->when($this->search, fn ($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->paginate($this->pages);

        // Fetch All Data for Mapping
        $pin_heritages = CulturalHeritage::all();
        $pin_tangible_immovable = TangibleImmovableCulturalHeritage::all();
        $pin_significant_personalities = SignificantPersonalities::all();
        $pin_tangible_movable = TangibleMovableCulturalHeritage::all();
        $pin_intangible = IntangibleCulturalHeritage::all();
        $pin_cultural_institutions = CulturalInstitutions::all();

        return view('livewire.admin.mapping-heritage.mapping-heritage', [
            // Paginated Data
            'heritages' => $heritages,
            'tangible_immovable' => $tangible_immovable,
            'significant_personalities' => $significant_personalities,
            'tangible_movable' => $tangible_movable,
            'intangible' => $intangible,
            'cultural_institutions' => $cultural_institutions,

            // Full Data for Map Pins
            'pin_heritages' => $pin_heritages,
            'pin_tangible_immovable' => $pin_tangible_immovable,
            'pin_significant_personalities' => $pin_significant_personalities,
            'pin_tangible_movable' => $pin_tangible_movable,
            'pin_intangible' => $pin_intangible,
            'pin_cultural_institutions' => $pin_cultural_institutions
        ]);
    }

}
