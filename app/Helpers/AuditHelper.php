<?php

namespace App\Helpers;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;

class AuditHelper
{
    public static function log(string $event, string $content)
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'event' => $event,
            'content' => $content,
        ]);
    }
}