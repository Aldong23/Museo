<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\VisitorRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function index()
    {
        $currentDate = now()->format('Y-m-d');

        $visitorRecordId = session('visitor_record_id');
        $visitorRecord = VisitorRecord::with('visitor')
            ->where('id', $visitorRecordId)
            ->latest()
            ->first();

        return view('livewire.visitor.feedback', [
            'currentDate' => $currentDate,
            'visitorRecord' => $visitorRecord
        ]);
    }

    public function indexEn()
    {
        $currentDate = now()->format('Y-m-d');

        $visitorRecordId = session('visitor_record_id');
        $visitorRecord = VisitorRecord::with('visitor')
            ->where('id', $visitorRecordId)
            ->latest()
            ->first();

        return view('livewire.visitor.feedback-en', [
            'currentDate' => $currentDate,
            'visitorRecord' => $visitorRecord
        ]);
    }


    public function create(Request $request)
    {
        $visitorRecordId = session('visitor_record_id');

        $existingFeedback = Feedback::where('visitor_record_id', $visitorRecordId)->first();

        if ($existingFeedback) {
            return response()->json(['success' => false, 'message' => 'You have already submitted feedback.']);
        }

        $visitorRecord = VisitorRecord::with('visitor')->find($visitorRecordId);

        if (!$visitorRecord || !$visitorRecord->visitor) {
            return response()->json(['success' => false, 'message' => 'Invalid visitor record.']);
        }

        $fields = $request->validate([
            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
            'satisfaction_0' => 'required',
            'satisfaction_1' => 'required',
            'satisfaction_2' => 'required',
            'satisfaction_3' => 'required',
            'satisfaction_4' => 'required',
            'satisfaction_5' => 'required',
            'satisfaction_6' => 'required',
            'satisfaction_7' => 'required',
            'satisfaction_8' => 'required',
            'optional' => 'nullable',
        ]);

        $fields['visitor_record_id'] = $visitorRecordId;
        $fields['name'] = $visitorRecord->visitor->fname . ' ' . $visitorRecord->visitor->mname . ' ' . $visitorRecord->visitor->lname . ' ' . $visitorRecord->visitor->suffix;
        $fields['current_date'] = now()->toDateString();
        $fields['email'] = $request->email;
        $fields['age'] = $request->age;
        $fields['religion'] = $request->religion;
        $fields['sex'] = $request->sex;
        $fields['lang'] = $request->lang;
        $fields['client'] = $request->client;
        $fields['purpose'] = $request->purpose;

        $newFeedback = Feedback::create($fields);
        $controlNo = 'MDU' . str_pad($newFeedback->id, 6, '0', STR_PAD_LEFT);

        $newFeedback->update(['control_no' => $controlNo]);

        return response()->json(['success' => true, 'message' => ' ']);
    }
}
