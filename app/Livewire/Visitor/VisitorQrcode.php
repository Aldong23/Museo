<?php

namespace App\Livewire\Visitor;

use App\Models\Visitor;
use App\Models\VisitorRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Spatie\Browsershot\Browsershot;

#[Layout('components.layouts.visitor-layout')]
#[Title('Visitor id')]
class VisitorQrcode extends Component
{
    public $qr;
    public $downloadUrl;
    public $control_no;

    public function mount()
    {
        $visitorRecordId = session('visitor_record_id');

        $visitorRecord = VisitorRecord::with('visitor')->find($visitorRecordId);
    
        $this->qr = route('visitor.login', ['control_no' => $visitorRecord->control_no]);
        $this->control_no = $visitorRecord->control_no;
        // dd($visitorRecord->toArray());
    }

    public function takeScreenshot()
    {
        // // Set the path to save the screenshot temporarily
        // $screenshotPath = storage_path('app/public/screenshot.png');

        // // Generate the fully qualified URL for the visitor QR code
        // $url = url(route('visitor.qrcode', ['control_no' => $this->control_no]));

        // // Generate the screenshot and save it to the specified path
        // Browsershot::url($url) // Use the fully qualified URL
        //     ->setOption('args', ['--no-sandbox', '--disable-setuid-sandbox']) // Puppeteer options
        //     ->timeout(60000) // Increase timeout to 60 seconds if the page takes longer to load
        //     ->waitUntilNetworkIdle() // Ensure the page finishes loading (optional)
        //     ->save($screenshotPath);

        // // Store the screenshot URL for download
        // $this->downloadUrl = Storage::url('screenshot.png');

        // $r3 = view('livewire.visitor.visitor-qrcode', [
        //     'control_no' => $this->control_no,
        //     'qr' => $this->qr,
        // ])->render();

        // $path = storage_path('app/public/QR.pdf');

        // Browsershot::html($r3)
        //     ->margins(10, 0, 10, 0)
        //     ->showBackground()
        //     ->savePdf($path);

        // Browsershot::url('http://127.0.0.1:8000/visitor-qrcode/MDU000001')
        //     ->setScreenshotType('jpeg', 100)
        //     ->save($path);

        $r3 = view('livewire.visitor.visitor-qrcode', [
            'qr' => $this->qr,
            'control_no' => $this->control_no,
        ])->render();

        $path = storage_path('visitor-qr-code');

        Browsershot::url(route('visitor.qrcode')) // Ensure this is the correct route
            ->setDelay(3000) // Wait 3 seconds for Livewire to initialize
            ->setTimeout(60) // Increase timeout
            ->margins(10, 0, 10, 0)
            ->showBackground()
            ->savePdf($path);


        return response()->download($path);
    }

    public function render()
    {

        return view('livewire.visitor.visitor-qrcode');
    }
}
