<?php

namespace App\Livewire\Admin\MappingHeritage;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.app')]
#[Title('Mapping Heritage')]
class MappingHeritageCreate extends Component
{

    public $categories = [];
    public $subcategories = [];
    public $selectedCategory = null;
    public $selectedSubcategory = null;

    public function mount()
    {
        // Cultural heritage categories
        $this->categories = [
            'Significant Natural Resources' => 'Significant Natural Resources',
            'Tangible-Immovable Cultural Heritage' => 'Tangible-Immovable Cultural Heritage',
            'Tangible Movable Culture' => 'Tangible Movable Culture',
            'Intangible Culture Heritage' => 'Intangible Culture Heritage',
            'Significant Personalities' => 'Significant Personalities',
            'Cultural Institutions' => 'Cultural Institutions',
        ];

        $this->subcategories = [];
    }

    public function updateSubcategories()
    {
        // types of cultural heritage
        $this->subcategories = match ($this->selectedCategory) {
            'Significant Natural Resources' => [
                'Bodies of Water',
                'Plants (Flora)',
                'Animals (Fauna)',
                'Protected Area',
                'Critical Area',
            ],
            'Tangible-Immovable Cultural Heritage' => [
                'Government/Private',
                'School',
                'Hospital',
                'Church',
                'Monuments',
                'Sites',
                'Houses',
                'Houses with Period',
            ],
            'Tangible Movable Culture' => [
                'Ethnographic Object',
                'Archival Holdings',
            ],
            'Intangible Culture Heritage' => [
                'Social Practices',
                'Knowledge and Practices',
                'Traditional Craftsmanship',
                'Oral Tradition',
            ],
            'Cultural Institutions' => [
                'Associations',
                'Library',
                'Political Clan',
                'School Institutions',
            ],
            default => [],
        };

        // Reset selected subcategory
        $this->selectedSubcategory = null;
    }

    public function updateType()
    {
        if ($this->selectedSubcategory === 'School Institutions') {

            $type = [
                'Select type',
                'Both Non-Formal & Formal Education',
                'Kalipunan ng Liping Pilipina Natl. Inc. Urdaneta City (KALIPI)'
            ];
        } elseif ($this->selectedSubcategory === 'Library') {

            $type = [
                'Select type',
                'Formal Education',
            ];
        } elseif ($this->selectedSubcategory === 'Associations') {

            $type = [
                'Select type',
                'Farmer’s Association',
                'LGBTQI+',
                'Rural Improvements Club of Urdaneta City',
                '(RCU) Rotary Club of Urdaneta',
                'Federation of Senior Citizen',
                'Federation',
                'Urdaneta Masonic Lodge, #302 Free & Accepted Mission',
                'Library'
            ];
        } elseif ($this->selectedSubcategory === 'Political Clan') {

            $type = [
                'Select type',
                'Political Clan'
            ];
        } else {

            $type = [];
        }

        $this->dispatch('typesUpdate', type: $type);
    }


    public function render()
    {
        return view('livewire.admin.mapping-heritage.mapping-heritage-create');
    }
}
