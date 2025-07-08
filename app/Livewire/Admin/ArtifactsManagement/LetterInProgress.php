<?php

namespace App\Livewire\Admin\ArtifactsManagement;

use Livewire\Component;
use App\Models\Letter;
use App\Models\ArtifactsRestoration;
use App\Models\Artifact;
use App\Models\User;

class LetterInProgress extends Component
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

        $remarks = $artifactRestoration->remarks_before 
            ? "<span class='underline'>{$artifactRestoration->remarks_before}</span>" 
            : ' ';
        $content = str_replace('"remarks"', $remarks, $content);

        $releasedBy = $authUser 
            ? "<span class='border-b-2 border-black inline-block'>{$authUser->fname} {$authUser->mname} {$authUser->lname}</span>" 
            : ' ';
        $content = str_replace('"released"', $releasedBy, $content);
        
        $approvedBy = $adminUser 
            ? "<span class='border-b-2 border-black inline-block'>{$adminUser->fname} {$adminUser->mname} {$adminUser->lname}</span>" 
            : ' ';
        $content = str_replace('"approved"', $approvedBy, $content);

        $status = $artifactRestoration->conservation_status_before ?? [];
        $statusList = count($status) > 0 
            ? '<ul class="list-disc" style="padding-left: 60px; list-style-type: disc;">' . implode('', array_map(fn($status) => "<li>{$status}</li>", $status)) . '</ul>' 
            : ' ';
        
        $content = str_replace('"status"', $statusList, $content);
        

        $images = $artifactRestoration->artifacts_before ?? [];
        $imageTags = count($images) > 0 
            ? implode('', array_map(fn($img) => "<div class='w-1/2'><img src='/storage/{$img}' class='w-full h-auto rounded shadow mt-2' /></div>", $images))
            : ' ';

        $content = str_replace('"images"', $imageTags, $content);


        if ($artifactRestoration->date_released) {
            $dateRestored = \Carbon\Carbon::parse($artifactRestoration->date_released);
            $content = str_replace('"day"', $dateRestored->format('jS'), $content);
            $content = str_replace('"date"', $dateRestored->format('F Y'), $content);
        }
        
        $this->content = $content;
    }


    public function render()
    {
        return view('livewire.admin.artifacts-management.letter-in-progress', [
            'content' => $this->content,
        ]);
    }
}
