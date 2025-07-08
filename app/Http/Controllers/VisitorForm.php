<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use App\Models\VisitorRecord;
use App\Notifications\AdminNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Yajra\Address\Entities\Barangay;
use Yajra\Address\Entities\City;
use Yajra\Address\Entities\Province;

class VisitorForm extends Controller
{
    public function index()
    {
        $provinces = Province::orderBy('name', 'asc')->get();

        return view('livewire.visitor.visitor-form', compact('provinces'));
    }

    public function getCities(Request $request)
    {
        $provinceId = $request->province_id;

        $cities = City::where('province_id', $provinceId)->orderBy('name', 'asc')->get();


        return response()->json($cities);
    }

    public function getBarangays(Request $request)
    {
        $cityId = $request->city_id;

        $barangays = Barangay::where('city_id', $cityId)->orderBy('name', 'asc')->get();

        return response()->json($barangays);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_type' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'sex' => 'required|string',
            'birthday' => 'required|date',
            'age' => 'required|integer',
            'religion' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'street' => 'nullable|string',
            'house_no' => 'required|string',
            'email' => 'required|email|unique:visitors',
            'contact_no' => 'required|string',
            'purpose' => 'required|string',
        ]);


        try {
            $visitor = Visitor::create([
                'fname' => $request->first_name,
                'mname' => $request->middle_name,
                'lname' => $request->last_name,
                'suffix' => $request->suffix,
                'sex' => $request->sex,
                'birthday' => $request->birthday,
                'age' => $request->age,
                'email' => $request->email,
                'religion' => $request->religion,
                'province' => $request->province,
                'city' => $request->city,
                'barangay' => $request->barangay,
                'street' => $request->street,
                'house_no' => $request->house_no,
                'contact_no' => $request->contact_no,
                
            ]);
    
            $visitorRecord = VisitorRecord::create([
                'visitor_id' => $visitor->id,
                'client_type' => $request->client_type,
                'purpose' => $request->purpose
            ]);
            
            $controlNo = 'MDU' . str_pad($visitorRecord->id, 6, '0', STR_PAD_LEFT);
            $visitorRecord->update(['control_no' => $controlNo]);
        
            session(['visitor_record_id' => $visitorRecord->id]);
            flash()->success('Created');
        
            $admin = User::all();
            $title = 'New Visitor';
            $content = $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name;
            $link = '/visitor-registration';

            Notification::send($admin, new AdminNotification($title, $content, $link));
        
            return redirect()->route('visitor.qrcode');
        
        } catch (\Exception $e) {
            flash()->warning('Registration unsuccessful: ' . $e->getMessage());

            return back();
        }

    }


    public function edit($id)
    {

        $visitor = Visitor::find($id);

        $provinces = Province::orderBy('name', 'asc')->get();


        return view('livewire.visitor.returning-visitor-form', [
            'provinces' => $provinces,
            'visitor' => $visitor
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'client_type' => 'required|string',
            'first_name' => 'required|string',
            'middle_name' => 'nullable|string',
            'last_name' => 'required|string',
            'suffix' => 'nullable|string',
            'sex' => 'required|string',
            'birthday' => 'required|date',
            'age' => 'required|integer',
            'religion' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'barangay' => 'required|string',
            'street' => 'nullable|string',
            'house_no' => 'required|string',
            'email' => 'required|email|unique:visitors,email,' . $id,
            'contact_no' => 'required|string',
            'purpose' => 'required|string',
        ]);

        try {
            $visitor = Visitor::findOrFail($id);

            $visitor->update([
                'fname' => $request->first_name,
                'mname' => $request->middle_name,
                'lname' => $request->last_name,
                'suffix' => $request->suffix,
                'sex' => $request->sex,
                'birthday' => $request->birthday,
                'age' => $request->age,
                'religion' => $request->religion,
                'province' => $request->province,
                'city' => $request->city,
                'barangay' => $request->barangay,
                'street' => $request->street,
                'house_no' => $request->house_no,
                'email' => $request->email,
                'contact_no' => $request->contact_no,
            ]);

            $visitorRecord = VisitorRecord::create([
                'visitor_id' => $visitor->id,
                'client_type' => $request->client_type,
                'purpose' => $request->purpose
            ]);

            $controlNo = 'MDU' . str_pad($visitorRecord->id, 6, '0', STR_PAD_LEFT);
            $visitorRecord->update(['control_no' => $controlNo]);

            session(['visitor_record_id' => $visitorRecord->id]);
            flash()->success('Visitor updated, and new visit record created.');

            return redirect()->route('visitor.qrcode');

        } catch (\Exception $e) {
            flash()->warning('Update failed: ' . $e->getMessage());
            return back();
        }
    }

}
