<x-slot:heading>Visitor Monitoring</x-slot:heading>
<x-slot:secHeading>View Visitor Profile</x-slot:secHeading>
<x-admin.body>
    <div class="flex">
        <div>
            <x-form.input label="Visitor ID no." value="{{ $visitor_record->control_no }}" disabled />
        </div>

        <div>
            <x-form.input label="Client type" value="{{ $visitor_record->client_type }}" disabled />
        </div>
    </div>

    <br>

    <h1>Visitor information</h1>
    <div class="flex mt-3">
        <x-form.input label="First Name" value="{{ $visitor_record->visitor->fname }}" disabled />
        <x-form.input label="Middle Name" value="{{ $visitor_record->visitor->mname ?? 'N/A' }}" disabled />
        <x-form.input label="Last Name" value="{{ $visitor_record->visitor->lname }}" disabled />
        <x-form.input label="Suffix" value="{{ $visitor_record->visitor->suffix ?? 'N/A' }}" disabled />
    </div>
    <div class="flex mt-2">
        <x-form.input label="Sex" value="{{ $visitor_record->visitor->sex }}" disabled />
        <x-form.input label="Birthday" value="{{ $visitor_record->visitor->birthday }}" disabled />
        <x-form.input label="Age" value="{{ $visitor_record->visitor->age }}" disabled />
        <x-form.input label="Religion" value="{{ $visitor_record->visitor->religion ?? 'N/A' }}" disabled />
    </div>

    <br>
    <h1>Address</h1>
    <div class="flex mt-3">
        <x-form.input label="Province" value="{{ $visitor_record->visitor->province }}" disabled />
        <x-form.input label="City" value="{{ $visitor_record->visitor->city }}" disabled />
        <x-form.input label="Barangay" value="{{ $visitor_record->visitor->barangay }}" disabled />
        <x-form.input label="Street" value="{{ $visitor_record->visitor->street ?? 'N/A' }}" disabled />
    </div>

    <div class="flex mt-2">
        <x-form.input label="House/Block/Lot No" value="{{ $visitor_record->visitor->house_no ?? 'N/A' }}" disabled />
        <x-form.input label="Email Address" value="{{ $visitor_record->visitor->email }}" disabled />
        <x-form.input label="Contact no" value="{{ $visitor_record->visitor->contact_no }}" disabled />
        <x-form.input label="Purpose" value="{{ $visitor_record->purpose ?? 'N/A' }}" disabled />
    </div>

    <div class="w-96 mt-5">
        <x-form.input label="Status" value="{{ $visitor_record->approved_by ? 'Approved' : 'Pending' }}" disabled/>
    </div>


</x-admin.body>