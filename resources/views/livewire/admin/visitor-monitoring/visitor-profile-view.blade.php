<x-slot:heading>Visitor Monitoring</x-slot:heading>
<x-slot:secHeading>View Visitor Profile</x-slot:secHeading>
<x-admin.body>

    <h1>Visitor information</h1>
    <div class="flex mt-3">
        <x-form.input label="First Name" value="{{ $visitor->fname }}" disabled />
        <x-form.input label="Middle Name" value="{{ $visitor->mname ?? 'N/A' }}" disabled />
        <x-form.input label="Last Name" value="{{ $visitor->lname }}" disabled />
        <x-form.input label="Suffix" value="{{ $visitor->suffix ?? 'N/A' }}" disabled />
    </div>
    <div class="flex mt-2">
        <x-form.input label="Sex" value="{{ $visitor->sex }}" disabled />
        <x-form.input label="Birthday" value="{{ $visitor->birthday }}" disabled />
        <x-form.input label="Age" value="{{ $visitor->age }}" disabled />
        <x-form.input label="Religion" value="{{ $visitor->religion ?? 'N/A' }}" disabled />
    </div>

    <br>
    <h1>Address</h1>
    <div class="flex mt-3">
        <x-form.input label="Province" value="{{ $visitor->province }}" disabled />
        <x-form.input label="City" value="{{ $visitor->city }}" disabled />
        <x-form.input label="Barangay" value="{{ $visitor->barangay }}" disabled />
        <x-form.input label="Street" value="{{ $visitor->street ?? 'N/A' }}" disabled />
    </div>

    <div class="flex mt-2">
        <x-form.input label="House/Block/Lot No" value="{{ $visitor->house_no ?? 'N/A' }}" disabled />
        <x-form.input label="Email Address" value="{{ $visitor->email }}" disabled />
        <x-form.input label="Contact no" value="{{ $visitor->contact_no }}" disabled />
    </div>

    <div class="w-96 mt-5">
        <x-form.input label="Visit Count" value="{{ $visitCount }}" disabled/>
    </div>

    <br>
    <h1>Visitor History</h1>

    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>Controll No.</x-form.table.th>
            <x-form.table.th>Client Type</x-form.table.th>
            <x-form.table.th>Date</x-form.table.th>
            <x-form.table.th>Approved by</x-form.table.th>
            <x-form.table.th>Purpose</x-form.table.th>
        </x-slot:head>

        @foreach ($visitorRecords as $visitor_record)
            <x-form.table.tr>
                <x-form.table.td> {{ $visitor_record->control_no }} </x-form.table.td>
                <x-form.table.td>{{ $visitor_record->client_type ?? 'N/A' }}</x-form.table.td>
                <x-form.table.td>{{ $visitor_record->created_at->format('F j, Y') }}</x-form.table.td>
                <x-form.table.td> 
                    {{ $visitor_record->approvedByUser->fname . ' ' . $visitor_record->approvedByUser->mname . ' ' . $visitor_record->approvedByUser->lname . ' ' . $visitor_record->approvedByUser->suffix  }}
                    <br>
                    <span class="text-gray-500 text-sm">{{ $visitor_record->approvedByUser->position }}</span></x-form.table.td>
                <x-form.table.td>{{ $visitor_record->purpose ?? 'N/A' }}</x-form.table.td>
            </x-form.table.tr>
        @endforeach
    </x-form.table.table>

    @if (!empty($visitorRecords))
        <x-form.table.pagination wire:model.change="page">
            {{ $visitorRecords->links() }}
        </x-form.table.pagination>
    @endif



</x-admin.body>