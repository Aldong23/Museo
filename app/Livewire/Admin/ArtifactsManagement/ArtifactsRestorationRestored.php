<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use App\Models\Artifact;
use App\Models\ArtifactsRestoration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Illuminate\Http\UploadedFile;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

#[Layout('components.layouts.app')]
#[Title('Restored')]
class ArtifactsRestorationRestored extends Component
{

    use WithFileUploads;

    public $restoration_id;

    public $artifact_name;
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
    public $artifacts_before_images; // images
    public $remarks_before;
    public $status;

    public $date_restored;
    public $conservation_status_after;
    public $artifacts_after; // images
    public $remarks_after;

    public $artifacts_after_old = [];
    public $removedArtifactsAfter = [];

    public function mount($id)
    {
        $art = ArtifactsRestoration::find($id);
        $this->restoration_id = $id;

        $this->artifact_name = $art->artifact->name;
        $this->selectedCategory = $art->artifact->category;
        $this->selectedType = $art->artifact->type;
        $this->updateSubcategories();

        $this->valid_id = $art->valid_id;
        $this->last_name = $art->lname;
        $this->first_name = $art->fname;
        $this->middle_name = $art->mname;
        $this->suffix = $art->suffix;
        $this->contact_no = $art->contact_no;
        $this->email = $art->email;
        $this->date_released = $art->date_released ? Carbon::parse($art->date_released)->format('Y-m-d') : now()->format('Y-m-d');
        $this->conservation_status_before = $art->conservation_status_before;
        $this->artifacts_before_images = $art->artifacts_before;
        $this->remarks_before = $art->remarks_before;

        $this->date_restored = $art->date_restored ? Carbon::parse($art->date_restored)->format('Y-m-d') : now()->format('Y-m-d');
        $this->conservation_status_after = $art->conservation_status_after;
        $this->artifacts_after = $art->artifacts_after;
        $this->remarks_after = $art->remarks_after;

        // Second part
        $this->status = $art->status;

        $this->artifacts_after_old = $art->artifacts_after ?? [];

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
            'remarks_before' => 'nullable',
            'date_restored' => 'required',
            'conservation_status_after' => 'required',
            'artifacts_after' => 'required',
            'remarks_after' => 'nullable',
        ]);

        // Find the existing restoration record
        $ArtRestoration = ArtifactsRestoration::find($this->restoration_id);

        // Get the current images in the database
        $imagePaths_after = $ArtRestoration->artifacts_after ?? [];

        // Remove images that were deleted by the user
        if (!empty($this->removedArtifactsAfter)) {
            foreach ($this->removedArtifactsAfter as $removedImage) {
                // Delete from storage
                Storage::delete($removedImage);
                // Remove from database array
                $imagePaths_after = array_diff($imagePaths_after, [$removedImage]);
            }
        }

        // Add new images
        if (!empty($this->artifacts_after)) {
            foreach ($this->artifacts_after as $image) {
                if ($image instanceof UploadedFile) {
                    $originalName = $image->getClientOriginalName();
                    $path = $image->storeAs('artifacts-images', time() . '-' . $originalName, 'public');
                    $imagePaths_after[] = $path;
                }
            }
        }

        $user = Auth::user()->id;

        $ArtRestoration->update([
            'valid_id' => $this->valid_id,
            'lname' => $this->last_name,
            'fname' => $this->first_name,
            'mname' => $this->middle_name,
            'suffix' => $this->suffix,
            'contact_no' => $this->contact_no,
            'email' => $this->email,
            'date_released' => $this->date_released,
            'conservation_status_before' => $this->conservation_status_before,
            'remarks_before' => $this->remarks_before,
            'status' => $this->status,
            'user_id' => Auth::id(),
            'date_restored' => $this->date_restored,
            'conservation_status_after' => $this->conservation_status_after,
            'artifacts_after' => array_values($imagePaths_after), // Re-index the array before saving
            'remarks_after' => $this->remarks_after,
            'received_by' => $user,
        ]);

        // Update the associated artifact record
        $artifact = Artifact::find($ArtRestoration->artifact->artifact_id);
        if ($artifact) {
            $artifact->name = $this->artifact_name;
            $artifact->category = $this->selectedCategory;
            $artifact->type = $this->selectedType;
            $artifact->save();
        }

        flash()->success('Restoration record updated successfully!');
        return redirect('/artifacts-restoration');
    }


    public function removeArtifactAfter($key)
    {
        if (isset($this->artifacts_after[$key])) {
            $artifact = $this->artifacts_after[$key];
    
            if (!($artifact instanceof \Illuminate\Http\UploadedFile)) {
                $this->removedArtifactsAfter[] = $artifact;
            }
    
            unset($this->artifacts_after[$key]);
            $this->artifacts_after = array_values($this->artifacts_after);
    
            $this->dispatch('artifactsAfterUpdated');
        }
    }
    

    public function updatedArtifactsAfter()
    {
        $existingImages = $this->artifacts_after_old ?? []; 
        $newImages = $this->artifacts_after; 
    
        $filteredExistingImages = array_filter($existingImages, function ($image) {
            return !in_array($image, $this->removedArtifactsAfter);
        });
    
        $this->artifacts_after = array_merge($filteredExistingImages, $newImages);
    
        $this->dispatch('artifactsAfterUpdated');
    }
    
    

    public function render()
    {

        return view('livewire.admin.artifacts-management.artifacts-restoration-restored');
    }
}
