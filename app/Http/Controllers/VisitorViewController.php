<?php

namespace App\Http\Controllers;

use App\Models\Artifact;

class VisitorViewController extends Controller
{
    public function index($qr)
    {
        
        $artifact = Artifact::where('artifact_no', $qr)->first();

        $artifact->increment('views');

        return view(
            'livewire.visitor.visitor-view',compact('artifact'));
    }
}
