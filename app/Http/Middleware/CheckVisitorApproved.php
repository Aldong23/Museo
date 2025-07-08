<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckVisitorApproved
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Assuming you're using the 'Visitor' model for authentication
        $visitor = session('visitor'); // Or you can fetch based on a custom visitor auth system

        // Check if the visitor is authenticated, approved, and not expired
        if ($visitor && $visitor->approved && ($visitor->expires_at && Carbon::parse($visitor->expires_at)->isFuture())) {
            return $next($request);
        }

        // Reject the request if the visitor is not approved or has expired
        return redirect()->route('visitor.not_approved'); // Redirect to an 'not approved' page or show a message
    }
}
