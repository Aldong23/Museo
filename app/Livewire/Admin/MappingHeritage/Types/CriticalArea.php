<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\CulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class CriticalArea extends Component
{
    use WithFileUploads;

    public $name;

    public $fields = [];
    public $lists = [];

    public $hazard;
    public $location;
    public $address;
    public $summary;
    public $description;
    public $stories;
    public $significance;
    public $conservation;
    public $references;
    public $mappers;
    public $date_profiled;
    public $attachment_image;

    public function mount()
    {
        $this->fields = [
            ['photos' => [], 'photo_credit' => '', 'photo_date' => ''] // Initial field
        ];
    }

    public function addField()
    {
        $this->fields[] = ['photos' => [], 'photo_credit' => '', 'photo_date' => ''];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields); // Re-index array
    }

    public function change2()
    {
        $this->attachment_image = null;
    }

    public function save()
    {
        // Validate the input data
        $this->validate([
            'name' => 'required|string',
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos' => 'required|max:10240',
            'hazard' => 'required|string',
            'location' => 'required|string',
            'address' => 'nullable|string',
            'summary' => 'required|string',
            'references' => 'required|string',
            'mappers' => 'required|string',
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

        foreach ($this->lists as $index => $list) {

            if (!empty($list['photo']) && is_object($list['photo'])) {
                $originalName = $list['photo']->getClientOriginalName();
                $path = $list['photo']->storeAs('cultural-lists', time() . '-' . $originalName, 'public');

                $this->lists[$index]['photo'] = $path;
            }
        }

        if ($this->attachment_image) {
            $original_name = $this->attachment_image->getClientOriginalName();
            $attachment_img_path = $this->attachment_image->storeAs('attachment-images', time() . '-' . $original_name, 'public');
        } else {
            $attachment_img_path = null;
        }

        // Create the record in the database
        CulturalHeritage::create([
            'cultural_heritage_category' => 'Significant Natural Resources',
            'cultural_heritage_type' => 'Critical Area',
            'name' => $this->name,
            'photo_details' => $this->fields,
            'location' => $this->location,
            'address' => $this->address,
            'existing_hazard_type' => $this->hazard,
            'summary' => $this->summary,
            'references' => $this->references,
            'name_of_mapper' => $this->mappers,
            'date_profiled' => $this->date_profiled,
            'attachment' => $attachment_img_path,
        ]);

        // Success message and redirect
        flash()->success('Crirtical Area Created!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.critical-area');
    }
}
