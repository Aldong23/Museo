<?php

namespace App\Livewire\Admin\MappingHeritage;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class CulturalInstitutions extends Component
{
    use WithFileUploads;

    public array $fields = [];
    public $types = [];
    public $name;

    public $city;
    public $province;
    public $location;
    public $type;
    public $typeValue;

    public function mount()
    {
        $this->fields = [
            ['photo_credit' => '', 'photo_date' => '', 'photos' => []] // Initial field
        ];
    }

    public function addField()
    {
        $this->fields[] = ['photo_credit' => '', 'photo_date' => '', 'photos' => []];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields); // Re-index array
    }

    #[On('updateType')]
    public function updateArtifact()
    {
        $this->typeValue = $this->type;
    }

    #[On('typesUpdate')]
    public function updateTypes($type)
    {
        $this->types = $type;

        $this->dispatch('type-update');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.cultural-institutions');
    }
}
