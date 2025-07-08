<?php

namespace App\Livewire\Admin\ReportGeneration;

use Livewire\Component;
use Carbon\Carbon;
use App\Models\Contributor;
use App\Models\Artifact;
use App\Models\Letter;
use App\Models\User;

class ContributorLetter extends Component
{
    public $content;

    public function mount($id)
    {
        $contributor = Contributor::findOrFail($id);
        $artifact = Artifact::find($contributor->artifact_id);
        
        $letter = Letter::where('name', 'Contributor Letter')->first();
        $adminUser = User::where('is_admin', 1)->first();
        $authUser = auth()->user();

        if (!$letter) {
            $this->content = 'No letter template found.';
            return;
        }

        $content = $letter->content;

        $contributorName = trim("{$contributor->fname} {$contributor->mname} {$contributor->lname}");
        $artifactName = $artifact?->name ?? ' ';
        $updatedDay = Carbon::parse($contributor->updated_at)->format('jS');
        $updatedDate = Carbon::parse($contributor->updated_at)->format('F Y');

        $content = str_replace('"contributor"', $contributorName, $content);
        $content = str_replace('"artifact"', $artifactName, $content);
        $content = str_replace('"day"', $updatedDay, $content);
        $content = str_replace('"date"', $updatedDate, $content);

        $preparedBy = $authUser 
            ? "
                <br>
                <div class='mt-8'>
                    <p class='font-semibold'>Prepared by:</p>
                    <br>
                    <div>
                        <span class='block w-48 border-b border-black'></span>
                        <p class='mt-1 font-bold'>{$authUser->fname} {$authUser->mname} {$authUser->lname}</p>
                        <p>{$authUser->position}</p>
                    </div>
                </div>" 
            : '';

        $approvedBy = $adminUser
            ? "<div class='mt-8'>
                <p class='font-semibold'>Approved by:</p>
                <br>
                <div>
                    <span class='block w-48 border-b border-black'></span>
                    <p class='mt-1 font-bold'>{$adminUser->fname} {$adminUser->mname} {$adminUser->lname}</p>
                    <p>{$adminUser->position}</p>
                </div>
              </div>" 
            : '';

        $content .= $preparedBy . $approvedBy;

        $this->content = $content;
    }

    public function render()
    {
        return view('livewire.admin.report-generation.contributor-letter');
    }
}
