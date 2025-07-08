<?php

namespace App\Livewire\Admin\VisitorMonitoring;

use App\Models\User;
use App\Models\Visitor;
use App\Models\VisitorRecord;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class VisitorRegistration extends Component
{

    public $qrCode;
    public $url;
    public $search = '';

    public function mount()
    {
         $user = auth()->user();

        if ($user->is_admin_staff) {
            redirect()->to('/visitor-profiling');
        }
        // Generate QR code and store it as a data URL
        // $this->qrCode = 'data:image/png;base64,' . base64_encode(
        //     QrCode::format('png')->size(200)->generate(url('/registration-form'))
        // );

        $this->url = 'https://urdanetacitymuseum.com/email-validation';
    }

    public function approve($id)
    {
        $visitorRecord = VisitorRecord::find($id);

        if ($visitorRecord) {
            $visitorRecord->approved_by = auth()->id();
            $visitorRecord->save();

            if ($visitorRecord->visitor) {
                $visitorRecord->visitor->expires_at = now()->addDay();
                $visitorRecord->visitor->save();
            }

            flash()->success('Visitor Approved!');
        } else {
            flash()->warning('Something went wrong');
        }
    }



    public function render()
    {
        $visitorRecords = VisitorRecord::with('visitor')
            ->whereNull('approved_by')
            ->whereHas('visitor', function ($query) {
                $query->whereNull('deleted_at');
            })
            ->where('created_at', '>=', now()->subDay())
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('control_no', 'like', '%' . $this->search . '%')
                        ->orWhere('purpose', 'like', '%' . $this->search . '%')
                        ->orWhere('client_type', 'like', '%' . $this->search . '%')
                        ->orWhereHas('visitor', function ($visitorQuery) {
                            $visitorQuery->where('fname', 'like', '%' . $this->search . '%')
                                ->orWhere('mname', 'like', '%' . $this->search . '%')
                                ->orWhere('lname', 'like', '%' . $this->search . '%');
                        });
                });
            })
            ->orderBy('created_at', 'asc')
            ->get();

        return view('livewire.admin.visitor-monitoring.visitor-registration', [
            'visitorRecords' => $visitorRecords
        ]);
    }
}
