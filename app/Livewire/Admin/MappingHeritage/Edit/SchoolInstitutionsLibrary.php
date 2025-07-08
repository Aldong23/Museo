<?php

namespace App\Livewire\Admin\MappingHeritage\Edit;

use App\Models\CulturalInstitutions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class SchoolInstitutionsLibrary extends Component
{
    use WithFileUploads;

    public $heritage;
    public $fields = [];
    public $name;
    public $city;
    public $province;
    public $location;
    public $type;
    public $remarks_image;
    public $remarks_text;
    public $narrative_description;
    public $stories;
    public $significance;
    public $supporting_documentation;
    public $key_informats;
    public $mappers;
    public $date_profiled;
    public $organizational_chart;

    public $selectedCategory;
    public $selectedType;

    public function mount($id)
    {
        $this->heritage = CulturalInstitutions::findOrFail($id);

        $this->name = $this->heritage->name;
        $this->fields = $this->heritage->photo_details ?? [['photo_credit' => '', 'photo_date' => '', 'photos' => []]];
        $this->city = $this->heritage->city;
        $this->province = $this->heritage->province;
        $this->location = $this->heritage->location;
        $this->type = $this->heritage->type_of_cultural_institutions;
        $this->remarks_image = $this->heritage->remarks_image;
        $this->remarks_text = $this->heritage->remarks_text;
        $this->organizational_chart = $this->heritage->organizational_chart;
        $this->narrative_description = $this->heritage->narrative_description;
        $this->stories = $this->heritage->stories;
        $this->significance = $this->heritage->significance;
        $this->supporting_documentation = $this->heritage->supporting_documentation;
        $this->key_informats = $this->heritage->key_informats;
        $this->mappers = $this->heritage->mappers;
        $this->date_profiled = $this->heritage->date_profiled ? Carbon::parse($this->heritage->date_profiled)->format('Y-m-d') : now()->format('Y-m-d');

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

    public function change2()
    {
        $this->remarks_image = null;
    }

    public function removeOrgChart($key)
    {
        unset($this->organizational_chart[$key]);
        $this->organizational_chart = array_values($this->organizational_chart);
    }


    public function removePhoto($index, $photoIndex)
    {
        if (isset($this->fields[$index]['photos'][$photoIndex])) {
            $photoPath = $this->fields[$index]['photos'][$photoIndex];

            if (!($photoPath instanceof \Illuminate\Http\UploadedFile) && Storage::exists("app/public/{$photoPath}")) {
                Storage::delete("app/public/{$photoPath}");
            }
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
            'fields.*.photos' => 'nullable|max:10240',
            'city' => 'required',
            'province' => 'required',
            'location' => 'required',
            'remarks_image' => 'nullable|max:10240',
            'remarks_text' => 'required',
            'narrative_description' => 'required',
            'stories' => 'required',
            'significance' => 'required',
            'supporting_documentation' => 'required',
            'key_informats' => 'required',
            'mappers' => 'required',
            'date_profiled' => 'required|date',
        ]);

        // Handle new photo uploads
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



        if ($this->organizational_chart instanceof \Illuminate\Http\UploadedFile) {

            $organizationalPaths = [];

            foreach ($this->organizational_chart as $image) {
                $originalName = $image->getClientOriginalName();
                $path = $image->storeAs('organizational-charts', time() . '-' . $originalName, 'public');
                $organizationalPaths[] = $path;
            }
        }

        // Handle remarks image upload
        if ($this->remarks_image instanceof \Illuminate\Http\UploadedFile) {

            $originalName = $this->remarks_image->getClientOriginalName();
            $remarksImagePath = $this->remarks_image->storeAs('cultural-lists', time() . '-' . $originalName, 'public');
        }

        $this->heritage->update([
            'name' => $this->name,
            'photo_details' => $this->fields,
            'city' => $this->city,
            'province' => $this->province,
            'location' => $this->location,
            'type_of_cultural_institutions' => $this->type,
            'remarks_image' => $remarksImagePath ?? $this->heritage->remarks_image,
            'remarks_text' => $this->remarks_text,
            'organizational_chart' => $organizationalPaths ?? $this->organizational_chart,
            'narrative_description' => $this->narrative_description,
            'stories' => $this->stories,
            'significance' => $this->significance,
            'supporting_documentation' => $this->supporting_documentation,
            'key_informats' => $this->key_informats,
            'mappers' => $this->mappers,
            'date_profiled' => $this->date_profiled,
        ]);

        flash()->success('Updated successfully!');
        return redirect('/mapping-heritage');
    }

    public function render()
    {
        return view('livewire.admin.mapping-heritage.edit.school-institutions-library');
    }
}
