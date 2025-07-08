<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\VisitorRecord;
use Illuminate\Support\Facades\Auth;

class CheckVisitorExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            return $next($request);
        }

        $visitorRecordId = session('visitor_record_id');

        if (!$visitorRecordId) {
            return redirect()->route('email.validation');
        }

        $visitorRecord = VisitorRecord::with('visitor')->find($visitorRecordId);

        if (!$visitorRecord || !$visitorRecord->visitor) {
            return redirect()->route('not.approved');
        }

        $visitor = $visitorRecord->visitor;

        if ($visitorRecord->approved_by == null) {
            return redirect()->route('not.approved');
        }

        if ($visitor->expires_at === null || now()->greaterThanOrEqualTo($visitor->expires_at)) {
            return redirect()->route('not.approved');
        }

        return $next($request);
    }
}
