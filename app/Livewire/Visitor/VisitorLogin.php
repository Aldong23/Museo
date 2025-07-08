<?php

namespace App\Livewire\Visitor;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use App\Models\VisitorRecord;
use Illuminate\Support\Facades\Session;

#[Layout('components.layouts.auth-layout')]
#[Title('Visitor Login')]
class VisitorLogin extends Component
{
    public $controll_number;

    public function validateControllNumber()
    {
        $this->validate([
            'controll_number' => 'required|string|exists:visitor_records,control_no',
        ]);

        $visitorRecord = VisitorRecord::where('control_no', $this->controll_number)
            ->with('visitor')
            ->first();

        if (!$visitorRecord || !$visitorRecord->visitor) {
            $this->addError('controll_number', 'Invalid control number.');
            return;
        }

        $visitor = $visitorRecord->visitor;

        if ($visitorRecord->approved_by === null) {
            $this->addError('controll_number', 'Your visit has not been approved.');
            return;
        }

        if ($visitor->expires_at === null || now()->greaterThanOrEqualTo($visitor->expires_at)) {
            $this->addError('controll_number', 'Your visit has expired.');
            return;
        }

        session(['visitor_record_id' => $visitorRecord->id]);

        return redirect()->route('visitor.login', ['control_no' => $this->controll_number]);
    }

    public function render()
    {
        return view('livewire.visitor.visitor-login');
    }
}
