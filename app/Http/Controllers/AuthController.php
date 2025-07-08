<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use App\Models\VisitorRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\AuditHelper;

class AuthController extends Controller
{
    // public function login(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'email' => ['required', 'email'],
    //         'password' => ['required'],
    //     ]);

    //     $remember = $request->has('remember');

    //     if(Auth::attempt($validatedData, $remember)) {
    //         return redirect()->route('dashboard');
    //     } else {
    //         return back()->withInput()->withErrors([
    //             'failed' => 'The provided credentials do not match our records.'
    //         ]);
    //     }
    // }

    public function logout(Request $request)
    {
        AuditHelper::log('Logged out', 'Successfully Logged out');
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Auth::logout();

        return redirect()->route('login');
    }

    public function loginVisitor($control_no)
    {
        $visitorRecord = VisitorRecord::where('control_no', $control_no)
            ->with('visitor')
            ->first();

        if (!$visitorRecord || !$visitorRecord->visitor) {
            return redirect()->route('not.approved');
        }

        $visitor = $visitorRecord->visitor;

        if ($visitorRecord->approved_by !== null && $visitor->expires_at !== null && now()->lessThan($visitor->expires_at)) {

            return redirect()->route('home');
        } else {
            return redirect()->route('not.approved');
        }
    }

}
