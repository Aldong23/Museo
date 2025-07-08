<?php

namespace App\Livewire\Admin\MappingHeritage\Types;

use App\Models\IntangibleCulturalHeritage;
use App\Models\TangibleImmovableCulturalHeritage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SocialPractices extends Component
{
    use WithFileUploads;

    public $fields = [];
    public $lists = [];

    public $lists_1 = [];
    public $lists_2 = [];

    public $name_1;
    public $photo_1;
    public $year_produced_1;
    public $use_1;

    public $name_2;
    public $photo_2;
    public $use_2;

    public $name;

    public $collections;
    public $photo_credit;
    public $photo_date;

    public $type;
    public $geographical_location;
    public $related_domains;
    public $summary_of_elements;
    public $stories;
    public $significance;
    public $assessment_of_practice;
    public $measures_and_description_dropdown;
    public $measures_and_description_text;
    public $supporting_documentation;
    public $key_informat;
    public $mappers;
    public $date_profiled;
    public $attachment_text;
    public $attachment_image;

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

    public function change1()
    {
        $this->collections = null;
    }
    public function change2()
    {
        $this->attachment_image = null;
    }

    // ============================= FOR LIST 1
    public function addList1()
    {
        $this->lists_1[] =
            [
                'name_1' => '',
                'photo_1' => '',
                'year_produced_1' => '',
                'use_1' => '',
            ];
    }

    public function removeList1($index)
    {
        unset($this->lists_1[$index]);
        $this->lists_1 = array_values($this->lists_1); // Re-index array
    }

    // ============================= FOR LIST 2
    public function addList2()
    {
        $this->lists_2[] =
            [
                'name_2' => '',
                'photo_2' => '',
                'use_2' => '',
            ];
    }

    public function removeList2($index)
    {
        unset($this->lists_2[$index]);
        $this->lists_2 = array_values($this->lists_2); // Re-index array
    }

    public function save()
    {

        $this->validate([
            'name' => 'required',
            'collections.*' => 'image|max:10240',  // Max 10MB
            'fields.*.photo_credit' => 'required',
            'fields.*.photo_date' => 'required|date',
            'fields.*.photos.*' => 'required|max:10240',
            'lists_1.*.name_1' => 'required',
            'lists_1.*.photo_1' => 'required|image|max:10240',
            'lists_1.*.year_produced_1' => 'required',
            'lists_1.*.use_1' => 'required',
            'lists_2.*.name_2' => 'required',
            'lists_2.*.photo_2' => 'required|image|max:10240',
            'lists_2.*.use_2' => 'required',
            //
            'type' => 'required',
            'geographical_location' => 'required',
            'related_domains' => 'required',
            'summary_of_elements' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'assessment_of_practice' => 'required',
            'measures_and_description_dropdown' => 'required',
            'measures_and_description_text' => 'required',
            'supporting_documentation' => 'required',
            'key_informat' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required|date',
            'attachment_text' => 'nullable',
            'attachment_image' => 'nullable|image|max:10240',


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

        foreach ($this->lists_1 as $index => $list) {

            if (!empty($list['photo_1']) && is_object($list['photo_1'])) {
                $originalName = $list['photo_1']->getClientOriginalName();
                $path = $list['photo_1']->storeAs('cultural-lists', time() . '-' . $originalName, 'public');

                $this->lists_1[$index]['photo_1'] = $path;
            }
        }

        foreach ($this->lists_2 as $index => $list) {

            if (!empty($list['photo_2']) && is_object($list['photo_2'])) {
                $originalName = $list['photo_2']->getClientOriginalName();
                $path = $list['photo_2']->storeAs('cultural-lists', time() . '-' . $originalName, 'public');

                $this->lists_2[$index]['photo_2'] = $path;
            }
        }

        if ($this->attachment_image) {

            $original_name = $this->attachment_image->getClientOriginalName();
            $attachment_img_path = $this->attachment_image->storeAs('attachment-images', time() . '-' . $original_name, 'public');
        }

        IntangibleCulturalHeritage::create([
            'cultural_heritage_category' => 'Intangible Cultural Heritage',
            'cultural_heritage_type' => 'Social Practices',
            'name' => $this->name,
            'photo_details' => $this->fields,

            //
            'type' => $this->type,
            'geographical_location' => $this->geographical_location,
            'related_domains' => $this->related_domains,
            'summary_of_elements' => $this->summary_of_elements,
            'list_of_tangible_movable_heritage' => $this->lists_1,
            'list_of_flora_fauna' => $this->lists_2,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'assessment_of_practice' => $this->assessment_of_practice,
            'measures_and_description_dropdown' => $this->measures_and_description_dropdown,
            'measures_and_description_text' => $this->measures_and_description_text,
            'supporting_documentation' => $this->supporting_documentation,
            'key_informat' => $this->key_informat,
            'mappers' => $this->mappers,
            'date_profiled' => $this->date_profiled,
            'attachment_text' => $this->attachment_text,
            'attachment_image' => $attachment_img_path,
        ]);

        flash()->success('Created!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.types.social-practices');
    }
}
