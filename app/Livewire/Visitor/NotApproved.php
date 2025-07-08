<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use App\Models\VisitorRecord;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;

#[Layout('components.layouts.visitor-layout')]
#[Title('Not Approved')]
class NotApproved extends Component
{
    public $message;
    public $isExpired = false;

    public function mount()
    {
        $visitorRecordId = session('visitor_record_id');

        if (!$visitorRecordId) {
            $this->message = "No visitor record found.";
            return;
        }

        $visitorRecord = VisitorRecord::with('visitor')->find($visitorRecordId);

        if (!$visitorRecord || !$visitorRecord->visitor) {
            $this->message = "Invalid visitor record.";
            return;
        }

        $visitor = $visitorRecord->visitor;

        if ($visitorRecord->approved_by === null) {
            $this->message = "Your visit has not been approved.";
            return;
        }

        if ($visitor->expires_at === null || now()->greaterThanOrEqualTo($visitor->expires_at)) {
            $this->message = "Your visit has expired.";
            $this->isExpired = true;
            return;
        }
    }

    public function goBack()
    {
        return redirect()->route('visitor.qrcode');
    }

    public function logout()
    {
        $visitorRecordId = session('visitor_record_id');
    
        $visitorRecord = VisitorRecord::with('visitor')->find($visitorRecordId);

        if ($visitorRecord && $visitorRecord->visitor) {
            $visitorRecord->visitor->update([
                'expires_at' => null
            ]);
        }
    
        session()->flush();
        return redirect()->route('email.validation');
    }
    

    public function render()
    {
        return view('livewire.visitor.not-approved', [
            'isExpired' => $this->isExpired
        ]);
    }
}
