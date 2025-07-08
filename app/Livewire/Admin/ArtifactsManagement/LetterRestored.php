<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use Livewire\Component;
use App\Models\Letter;
use App\Models\ArtifactsRestoration;
use App\Models\Artifact;
use App\Models\User;

class LetterRestored extends Component
{
    public $content;

    public function mount($id)
    {
        $artifactRestoration = ArtifactsRestoration::findOrFail($id);
        $artifact = Artifact::find($artifactRestoration->artifact_id);
        $adminUser = User::where('is_admin', 1)->first();
        $authUser = auth()->user();

        $letterName = $artifactRestoration->status === 'In-Progress' ? 'In-Progress Letter' : 'Restored Letter';
        $letter = Letter::where('name', $letterName)->first();

        if (!$letter) {
            $this->content = 'No letter template found for this status.';
            return;
        }

        $content = $letter->content;

        $content = str_replace('"conservator"', trim("{$artifactRestoration->fname} {$artifactRestoration->mname} {$artifactRestoration->lname}"), $content);
        $content = str_replace('"artifact"', $artifact?->name ?? ' ', $content);

        // Remarks
        $remarksBefore = $artifactRestoration->remarks_before 
            ? "<span class='underline'>{$artifactRestoration->remarks_before}</span>" 
            : ' ';
        $remarksAfter = $artifactRestoration->remarks_after 
            ? "<span class='underline'>{$artifactRestoration->remarks_after}</span>" 
            : ' ';
        
        $content = str_replace('"before_remarks"', $remarksBefore, $content);
        $content = str_replace('"after_remarks"', $remarksAfter, $content);

        // Released and Approved By
        $releasedBy = $authUser 
            ? "<span class='border-b-2 border-black inline-block'>{$authUser->fname} {$authUser->mname} {$authUser->lname}</span>" 
            : ' ';
        $approvedBy = $adminUser 
            ? "<span class='border-b-2 border-black inline-block'>{$adminUser->fname} {$adminUser->mname} {$adminUser->lname}</span>" 
            : ' ';
        
        $content = str_replace('"released"', $releasedBy, $content);
        $content = str_replace('"approved"', $approvedBy, $content);

       // Conservation Status Items
        $statusBefore = $artifactRestoration->conservation_status_before ?? [];
        $statusBeforeList = count($statusBefore) > 0 
            ? '<ul class="list-disc" style="padding-left: 60px; list-style-type: disc;">' . implode('', array_map(fn($statusBefore) => "<li>{$statusBefore}</li>", $statusBefore)) . '</ul>' 
            : ' ';
        
        $content = str_replace('"before_status"', $statusBeforeList, $content);

        $statusAfter = $artifactRestoration->conservation_status_after ?? [];
        $statusAfterList = count($statusAfter) > 0 
            ? '<ul class="list-disc" style="padding-left: 60px; list-style-type: disc;">' . implode('', array_map(fn($statusAfter) => "<li>{$statusAfter}</li>", $statusAfter)) . '</ul>' 
            : ' ';
        
        $content = str_replace('"after_status"', $statusAfterList, $content);

        // Images (Before & After)
        $imagesBefore = $artifactRestoration->artifacts_before ?? [];
        $imageTagsBefore = count($imagesBefore) > 0 
            ? implode('', array_map(fn($img) => "<div class='w-1/2'><img src='/storage/{$img}' class='w-full h-auto rounded shadow mt-2' /></div>", $imagesBefore))
            : ' ';

        $imagesAfter = $artifactRestoration->artifacts_after ?? [];
        $imageTagsAfter = count($imagesAfter) > 0 
            ? implode('', array_map(fn($img) => "<div class='w-1/2'><img src='/storage/{$img}' class='w-full h-auto rounded shadow mt-2' /></div>", $imagesAfter))
            : ' ';

        $content = str_replace('"before_images"', $imageTagsBefore, $content);
        $content = str_replace('"after_images"', $imageTagsAfter, $content);

        // Date Formatting
        if ($artifactRestoration->date_released) {
            $dateRestored = \Carbon\Carbon::parse($artifactRestoration->date_released);
            $content = str_replace('"day"', $dateRestored->format('jS'), $content);
            $content = str_replace('"date"', $dateRestored->format('F Y'), $content);
        }
        
        $this->content = $content;
    }

    public function render()
    {
        return view('livewire.admin.artifacts-management.letter-restored');
    }
}
