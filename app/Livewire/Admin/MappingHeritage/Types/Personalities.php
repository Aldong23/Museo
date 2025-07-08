<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalHeritage;
use App\Models\SignificantPersonalities;
use App\Models\TangibleImmovableCulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Personalities extends Component
{
    use WithFileUploads;

    public $fields = [];
    public $lists = [];

    public $name;
    public $photo_credit;
    public $photo_date;

    public $date_of_birth;
    public $date_of_death;
    public $age;
    public $type;
    public $birthplace;
    public $present_address;
    public $biography;
    public $significance;
    public $references;
    public $mapper;
    public $date_profiled;
    public $attachment;

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


    public function removeList($index)
    {
        unset($this->lists[$index]);
        $this->lists = array_values($this->lists); // Re-index array
    }

    public function save()
    {

        $this->validate([
            'name' => 'required',
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos' => 'required|max:10240',

            //
            'date_of_birth' => 'required|date',
            'date_of_death' => 'required|date|after_or_equal:date_of_birth',
            'age' => 'required|integer|min:0',
            'type' => 'required|string|max:500',
            'birthplace' => 'required|string|max:255',
            'present_address' => 'required|string|max:255',
            'biography' => 'required|string',
            'significance' => 'required',
            'references' => 'required',
            'mapper' => 'required',
            'date_profiled' => 'required|date',


        ]);

        // Save featured collections
        foreach ($this->fields as $index => $field) {
            if (!empty($field['photos'])) {
                $photoPaths = [];

                foreach ($field['photos'] as $photo) {
                    if ($photo instanceof \Illuminate\Http\UploadedFile) {
                        $originalName = $photo->getClientOriginalName();
                        $uniqueName = time() . '-' . uniqid() . '-' . $originalName;
                        $path = $photo->storeAs('featured-collections', $uniqueName, 'public');

                        $photoPaths[] = $path;
                    }
                }

                $this->fields[$index]['photos'] = $photoPaths;
            }
        }


        SignificantPersonalities::create([
            'cultural_heritage_category' => 'Significant Personalities',
            'cultural_heritage_type' => 'NA',
            'name' => $this->name,
            'photo_details' => $this->fields,
            'date_of_birth' => $this->date_of_birth,
            'date_of_death' => $this->date_of_death,
            'age' => $this->age,
            'prominence' => $this->type,
            'birthplace' => $this->birthplace,
            'present_address' => $this->present_address,
            'biography' => $this->biography,
            'significance' => $this->significance,
            'references' => $this->references,
            'mapper' => $this->mapper,
            'date_profiled' => $this->date_profiled,
            'attachment' => $this->attachment
        ]);

        flash()->success('Created!');
        return redirect('/mapping-heritage');
    }


    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.personalities');
    }
}
