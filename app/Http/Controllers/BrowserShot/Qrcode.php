<?php

namespace App\Http\Controllers\BrowserShot;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;

class Qrcode extends Controller
{
    public function visitorQr()
    {

        $user = Auth::user();

        $qr = route('visitor.login', ['control_no' => $user->visitor->control_no]);
        $control_no = $user->visitor->control_no;


        $view = view('browsershot.visitor-qr', [
            'qr' => $qr,
            'control_no' => $control_no,

        ])->render();

        $path = storage_path('app/public/qrcodes/MDU-VisitorQrCode.jpeg');

        Browsershot::html($view)
            ->showBackground()
            ->save($path);

        return response()->download($path);

        // return view('browsershot.visitor-qr', [
        //     'qr' => $qr,
        //     'control_no' => $control_no,
        // ]);
    }
}
