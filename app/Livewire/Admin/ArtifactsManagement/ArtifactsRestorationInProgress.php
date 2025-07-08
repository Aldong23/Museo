<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use App\Models\ArtifactsRestoration;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;

#[Layout('components.layouts.app')]
#[Title('In Progress')]
class ArtifactsRestorationInProgress extends Component
{
    use WithFileUploads;

    public $artifact_names;

    public $artifact_id;
    public $categories = [];
    public $types = [];
    public $selectedCategory = null;
    public $selectedType = null;

    public $valid_id;
    public $last_name;
    public $first_name;
    public $middle_name;
    public $suffix;
    public $contact_no;
    public $email;
    public $date_released;
    public $conservation_status_before;
    public $artifacts_before; // images
    public $remarks_before;

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
    }


    public function updateSubcategories()
    {
        $this->types = match ($this->selectedCategory) {
            'Significant Natural Resources' => ['Bodies of Water', 'Plants (Flora)', 'Animals (Fauna)', 'Protected Area', 'Critical Area'],
            'Tangible-Immovable Cultural Heritage' => ['Government/Private', 'School', 'Hospital', 'Church', 'Monuments', 'Sites', 'Houses'],
            'Tangible Movable Culture' => ['Ethnographic Object','Ethnographic Materials','Archival Holdings','Fine Arts','Antiques Objects','Numismatic','Trophy','Events','Certificates','Books','Statue',],
            'Intangible Culture Heritage' => ['Social Practices', 'Knowledge and Practices', 'Traditional Craftsmanship'],
            'Cultural Institutions' => ['Associations', 'Library', 'Political Clan', 'School Institutions'],
            default => [],
        };
    }

    #[On('updateArt')]
    public function updateArtifact()
    {
        if ($this->artifact_id) {
            $artifact = Artifact::find($this->artifact_id);

            if ($artifact) {

                $this->selectedCategory = $artifact->category;
                $this->selectedType = $artifact->type;

                $this->updateSubcategories();
            }
        }
    }

    public function change1()
    {
        $this->artifacts_before = null;
    }

    public function save()
    {

        $this->validate([
            'valid_id' => 'required',
            'last_name' => 'required',
            'first_name' => 'required',
            'contact_no' => 'required',
            'email' => 'required',
            'date_released' => 'required',
            'conservation_status_before' => 'required',
            'artifacts_before' => 'required',
            'remarks_before' => 'nullable',
        ]);

        $imagePaths = [];
        foreach ($this->artifacts_before as $image) {
            $originalName = $image->getClientOriginalName();
            $path = $image->storeAs('artifacts-images', time() . '-' . $originalName, 'public');

            $imagePaths[] = $path;
        }

        $user = Auth::user()->id;

        $inProgress = ArtifactsRestoration::create([
            'artifact_id' => $this->artifact_id,
            'valid_id' => $this->valid_id,
            'lname' => $this->last_name,
            'fname' => $this->first_name,
            'mname' => $this->middle_name,
            'suffix' => $this->suffix,
            'contact_no' => $this->contact_no,
            'email' => $this->email,
            'date_released' => $this->date_released,
            'conservation_status_before' => $this->conservation_status_before,
            'artifacts_before' => $imagePaths,
            'remarks_before' => $this->remarks_before,
            'status' => 'In-Progress',
            'released_by' => $user, // released by
        ]);

        $artifact = Artifact::find($this->artifact_id);

        if ($inProgress) {

            $artifact->category = $this->selectedCategory;
            $artifact->type = $this->selectedType;
            $artifact->save();

            flash()->success('Adding of Restoration Success!');
            return redirect('/artifacts-restoration');
        }
    }



    public function render()
    {

        $this->artifact_names = Artifact::all();

        return view('livewire.admin.artifacts-management.artifacts-restoration-in-progress');
    }
}
