<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\IntangibleCulturalHeritage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TraditionalCraftsmanship extends Component
{
    use WithFileUploads;

    public $heritage;
    public $fields = [];
    public $lists_1 = [];
    public $lists_2 = [];

    public $name;
    public $type;
    public $geographical_location;
    public $related_domains;
    public $summary_of_elements;
    public $stories;
    public $significance;
    public $assessment_of_practice;
    public $supporting_documentation;
    public $key_informat;
    public $mappers;
    public $date_profiled;
    public $attachment_text;
    public $attachment_image;

    public $selectedCategory;
    public $selectedType;

    public function mount($id)
    {
        $this->heritage = IntangibleCulturalHeritage::findOrFail($id);

        $this->name = $this->heritage->name;
        $this->fields = $this->heritage->photo_details ?? [['photo_credit' => '', 'photo_date' => '', 'photos' => []]];
        $this->lists_1 = $this->heritage->list_of_tangible_movable_heritage ?? [];
        $this->lists_2 = $this->heritage->list_of_flora_fauna ?? [];

        $this->type = $this->heritage->type;
        $this->geographical_location = $this->heritage->geographical_location;
        $this->related_domains = $this->heritage->related_domains;
        $this->summary_of_elements = $this->heritage->summary_of_elements;
        $this->stories = $this->heritage->stories;
        $this->significance = $this->heritage->significance;
        $this->assessment_of_practice = $this->heritage->assessment_of_practice;
        $this->supporting_documentation = $this->heritage->supporting_documentation;
        $this->key_informat = $this->heritage->key_informat;
        $this->mappers = $this->heritage->mappers;
        $this->date_profiled = $this->heritage->date_profiled ? Carbon::parse($this->heritage->date_profiled)->format('Y-m-d') : now()->format('Y-m-d');
        $this->attachment_text = $this->heritage->attachment_text;
        $this->attachment_image = $this->heritage->attachment_image;

        $this->selectedCategory = $this->heritage->cultural_heritage_category;
        $this->selectedType = $this->heritage->cultural_heritage_type;
    }

    public function addField()
    {
        $this->fields[] = ['photo_credit' => '', 'photo_date' => '', 'photos' => []];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields);
    }

    public function addList1()
    {
        $this->lists_1[] = ['name_1' => '', 'photo_1' => '', 'year_produced_1' => '', 'use_1' => ''];
    }

    public function removeList1($index)
    {
        unset($this->lists_1[$index]);
        $this->lists_1 = array_values($this->lists_1);
    }

    public function change2()
    {
        $this->attachment_image = null;
    }

    public function removePhoto($index, $photoIndex)
    {
        if (isset($this->fields[$index]['photos'][$photoIndex])) {
            $photoPath = $this->fields[$index]['photos'][$photoIndex];

            // Ensure it's not a newly uploaded file before attempting deletion
            if (!($photoPath instanceof \Illuminate\Http\UploadedFile) && Storage::exists("app/public/{$photoPath}")) {
                Storage::delete("app/public/{$photoPath}");
            }

            // Remove from the array
            unset($this->fields[$index]['photos'][$photoIndex]);
            $this->fields[$index]['photos'] = array_values($this->fields[$index]['photos']); // Reset keys
        }
    }


    public function save()
    {
        $this->validate([
            'name' => 'required',
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos.*' => 'nullable|max:10240',
            'lists_1.*.name_1' => 'required',
            'lists_1.*.photo_1' => 'nullable|max:10240',
            'lists_1.*.year_produced_1' => 'required',
            'lists_1.*.use_1' => 'required',
            'type' => 'required',
            'geographical_location' => 'required',
            'related_domains' => 'required',
            'summary_of_elements' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'assessment_of_practice' => 'required',
            'supporting_documentation' => 'required',
            'key_informat' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required|date',
            'attachment_text' => 'nullable',
            'attachment_image' => 'nullable|image|max:10240',
        ]);

        foreach ($this->fields as $index => $field) {
            $photoPaths = [];

            foreach ($field['photos'] as $photo) {
                if ($photo instanceof \Illuminate\Http\UploadedFile) {
                    $originalName = $photo->getClientOriginalName();
                    $uniqueName = time() . '-' . uniqid() . '-' . $originalName;
                    $path = $photo->storeAs('featured-collections', $uniqueName, 'public');
                    $photoPaths[] = $path;
                } else {

                    $photoPaths[] = $photo;
                }
            }

            $this->fields[$index]['photos'] = array_values(array_unique($photoPaths));
        }

        foreach ($this->lists_1 as $index => $list) {
            if (!empty($list['photo_1']) && is_object($list['photo_1'])) {
                $path = $list['photo_1']->store('cultural-lists', 'public');
                $this->lists_1[$index]['photo_1'] = $path;
            }
        }


        if ($this->attachment_image && $this->attachment_image instanceof \Illuminate\Http\UploadedFile) {
            $this->heritage->attachment_image = $this->attachment_image->store('attachment-images', 'public');
        }

        $this->heritage->update([
            'name' => $this->name,
            'photo_details' => $this->fields,
            'type' => $this->type,
            'geographical_location' => $this->geographical_location,
            'related_domains' => $this->related_domains,
            'summary_of_elements' => $this->summary_of_elements,
            'list_of_tangible_movable_heritage' => $this->lists_1,
            'list_of_flora_fauna' => $this->lists_2,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'assessment_of_practice' => $this->assessment_of_practice,
            'supporting_documentation' => $this->supporting_documentation,
            'key_informat' => $this->key_informat,
            'mappers' => $this->mappers,
            'date_profiled' => $this->date_profiled,
            'attachment_text' => $this->attachment_text,
        ]);

        flash()->success('Updated successfully!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.traditional-craftsmanship');
    }
}
