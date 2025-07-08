<x-slot:heading>Visitor Monitoring</x-slot:heading>
<x-slot:secHeading>Visitor Feedback</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex items-center justify-between px-2 py-4">

        <x-form.search wire:model.live="search"/>

        <div class="flex items-center gap-1">
            <div x-data="{ showOptions: false }" class="relative">
                <button class="bg-clr-crimson p-1 hover:bg-clr-crimson1 rounded-sm" @click="showOptions = !showOptions">
                    <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                            d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
                    </svg>
                </button>

                <div x-show="showOptions" @click.away="showOptions = false"
                    class="absolute right-0 mt-2 w-40 bg-white border shadow-lg rounded z-10">
                    <ul class="py-2">
                        <li>
                            <a href="#" @click="showOptions = false" wire:click="resetFilters"
                                class="block px-4 py-2 hover:bg-gray-100">
                                All
                            </a>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="client_type">
                                <option value="">Client Type</option>
                                <option value="Government (Employee or Agency)">Government (Employee or Agency)</option>
                                <option value="Citizen">Citizen</option>
                                <option value="Business">Business</option>
                            </x-form.select-input>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="month">
                                <option value="">Select Month</option>
                                @foreach (range(1, 12) as $m)
                                    <option value="{{ sprintf('%02d', $m) }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                        <li>
                            <x-form.select-input label="" wire:model.change="year">
                                <option value="">Select Year</option>
                                @foreach (range(now()->year, now()->year - 10) as $y)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endforeach
                            </x-form.select-input>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    {{-- * ================================================== TABLE ======================================== --}}
    <x-form.table.table>
        <x-slot:head>
            <x-form.table.th>Control No.</x-form.table.th>
            <x-form.table.th>Visitor Name</x-form.table.th>
            <x-form.table.th>Email</x-form.table.th>
            <x-form.table.th>Client Type</x-form.table.th>
            <x-form.table.th>Sex</x-form.table.th>
            <x-form.table.th>Date</x-form.table.th>
            <x-form.table.th>Time</x-form.table.th>
            <x-form.table.th>Action</x-form.table.th>
        </x-slot:head>

        {{-- @dump($feedbacks) --}}
        @foreach ($feedbacks as $feedback)
            <x-form.table.tr>
                <x-form.table.td>{{ $feedback->control_no }}</x-form.table.td>
                <x-form.table.td>{{ $feedback->name }}</x-form.table.td>
                <x-form.table.td>{{ $feedback->email }}</x-form.table.td>
                <x-form.table.td>{{ $feedback->client }}</x-form.table.td>
                <x-form.table.td>{{ $feedback->sex }}</x-form.table.td>
                <x-form.table.td>{{ $feedback->created_at->format('Y-m-d') }}</x-form.table.td>
                <x-form.table.td>{{ $feedback->created_at->format('H:i') }}</x-form.table.td>
                <x-form.table.td>
                    <div class="flex items-center gap-3">
                        <x-form.view-btn href="/visitor-feedback-view/{{ $feedback->id }}" />
                    </div>
                </x-form.table.td>
            </x-form.table.tr>
        @endforeach
    </x-form.table.table>
    @if (!empty($feedbacks))
        <x-form.table.pagination wire:model.change="page">
        {{ $feedbacks->links() }}
        </x-form.table.pagination>
    @endif


    <!-- Modal -->
    <x-modal.view id="viewFeedbackModal" header="Feedback Details">
        <div class="w-full h-full flex items-center justify-center">
            <div class="text-lg font-sans">
                <p><span class="text-gray-500">Control No.: </span> <span id="feedback-control-no"></span></p>
                <p><span class="text-gray-500">Name: </span> <span id="feedback-name"></span></p>
                <p><span class="text-gray-500">Email: </span> <span id="feedback-email"></span></p>
                <p><span class="text-gray-500">Client: </span> <span id="feedback-client"></span></p>
                <p><span class="text-gray-500">Sex: </span> <span id="feedback-sex"></span></p>
                <p><span class="text-gray-500">Date: </span> <span id="feedback-date"></span></p>
                <p><span class="text-gray-500">Time: </span> <span id="feedback-time"></span></p>
            </div>
        </div>
    </x-modal.view>

    @push('scripts')
        <script>
            $(document).ready(function() {
                $(".view-btn").click(function() {
                    var $row = $(this).closest("tr");
                    var controlNo = $row.find("td:eq(0)").text().trim();
                    var name = $row.find("td:eq(1)").text().trim();
                    var email = $row.find("td:eq(2)").text().trim();
                    var client = $row.find("td:eq(3)").text().trim();
                    var sex = $row.find("td:eq(4)").text().trim();
                    var date = $row.find("td:eq(5)").text().trim();
                    var time = $row.find("td:eq(6)").text().trim();

                    $("#feedback-control-no").text(controlNo);
                    $("#feedback-name").text(name);
                    $("#feedback-email").text(email);
                    $("#feedback-client").text(client);
                    $("#feedback-sex").text(sex);
                    $("#feedback-date").text(date);
                    $("#feedback-time").text(time);

                    window.dispatchEvent(new CustomEvent("open-view"));
                });

            });
        </script>
    @endpush

</x-admin.body>
