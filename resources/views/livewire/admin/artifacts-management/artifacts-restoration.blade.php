<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Restoration</x-slot:secHeading>
<x-admin.body>
    <div class="table">
        <div class="w-full flex items-center justify-between px-2 py-4">
            {{-- todo =================================================== ARTIFACTS --}}
            <div class="flex items-center gap-2">
            <button wire:click="filter('In-Progress')" 
                class="cursor-pointer w-fit px-4 py-2 flex items-center justify-between gap-5 border border-gray-300 rounded-lg shadow-lg hover:bg-gray-100">
                <x-icons.restoration-icon />
                <div class="text-center">
                    <h1 class="font-bold"> {{ $in_progress_count }} </h1>
                    <h1 class="text-xs text-secondary">In-Progress</h1>
                </div>
            </button>

            <button wire:click="filter('Restored')" 
                class="cursor-pointer w-fit px-4 py-2 flex items-center justify-between gap-5 border border-gray-300 rounded-lg shadow-lg hover:bg-gray-100">
                <x-icons.restoration-icon />
                <div class="text-center">
                    <h1 class="font-bold"> {{ $restored_count }} </h1>
                    <h1 class="text-xs text-secondary">Restored</h1>
                </div>
            </button>
            </div>


            <x-form.search wire:model.live="search" />

            <div class="flex items-center gap-2">
                <div x-data="{ showOptions: false }" class="relative">
                    @if(auth()->user()->is_admin || auth()->user()->is_clerical)
                    <button @click="showOptions = !showOptions" class="flex items-center gap-2 ps-4 rounded bg-clr-crimson hover:bg-clr-crimson1 font-semibold">
                        <p class="text-xs text-white">Letter Form</p>
                        <div class="bg-red-800 rounded p-2 h-full">
                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M2.59195 20.7356H4.43872L17.1069 8.06746L15.2601 6.22069L2.59195 18.8889V20.7356ZM0 23.3276V17.8197L17.1069 0.745187C17.3661 0.507591 17.6523 0.323994 17.9655 0.194397C18.2787 0.0647989 18.6081 0 18.9537 0C19.2993 0 19.6341 0.0647989 19.958 0.194397C20.282 0.323994 20.5628 0.518391 20.8004 0.777586L22.5824 2.59195C22.8416 2.82955 23.0306 3.11035 23.1494 3.43434C23.2682 3.75833 23.3276 4.08233 23.3276 4.40632C23.3276 4.75192 23.2682 5.08131 23.1494 5.3945C23.0306 5.7077 22.8416 5.99389 22.5824 6.25309L5.5079 23.3276H0ZM16.1673 7.16027L15.2601 6.22069L17.1069 8.06746L16.1673 7.16027Z"
                                    fill="white" />
                            </svg>
                        </div>
                    </button>
                    @endIf
                    
                    <!-- Dropdown Options -->
                    <div x-show="showOptions" @click.away="showOptions = false"
                        class="absolute right-0 mt-2 w-60 bg-white border shadow-lg rounded z-10">
                        <ul class="py-2">
                            <li class="block px-4 py-2 hover:bg-gray-100">
                                <a href="/restoration-in-progress">In-Progress</a>
                            </li>
                            <li class="block px-4 py-2 hover:bg-gray-100">
                                <a href="/restoration-restored">Restored</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @if(auth()->user()->is_admin || auth()->user()->is_clerical)
                <x-form.add-btn href="/artifacts-restoration/in-progress"/>
                @endIf
            </div>
        </div>

        {{-- * ================================================== TABLE ======================================== --}}
        <x-form.table.table>
            <x-slot:head>
                <x-form.table.th>Artifact No.</x-form.table.th>
                <x-form.table.th>Artifacts Name</x-form.table.th>
                <x-form.table.th>Date Release</x-form.table.th>
                <x-form.table.th>Date Restored</x-form.table.th>
                <x-form.table.th>Released by</x-form.table.th>
                <x-form.table.th>Received by</x-form.table.th>
                <x-form.table.th>Status</x-form.table.th>
                <x-form.table.th>Actions</x-form.table.th>
            </x-slot:head>

            @foreach ($artifacts as $art)
                <x-form.table.tr>
                    <x-form.table.td>
                        {{ $art->artifact->artifact_no }}
                    </x-form.table.td>
                    <x-form.table.td> {{ $art->artifact->name }} </x-form.table.td>
                    <x-form.table.td> {{ $art->date_released?->format('M d, Y') ?? '' }} </x-form.table.td>
                    <x-form.table.td> {{ $art->date_restored?->format('M d, Y') ?? '' }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="w-full">
                            <h1>
                                {{ $art->releasedBy->fname . ' ' . $art->releasedBy->mname . ' ' . $art->releasedBy->lname }}
                            </h1>
                            <p class="text-sm text-gray-400"> {{ $art->releasedBy->position }} </p>
                        </div>
                    </x-form.table.td>
                    <x-form.table.td>
                        @if ($art->receivedBy)
                            <div class="w-full">
                                <h1>
                                    {{ $art->receivedBy->fname . ' ' . $art->receivedBy->mname . ' ' . $art->receivedBy->lname }}
                                </h1>
                                <p class="text-sm text-gray-400"> {{ $art->receivedBy->position }} </p>
                            </div>
                        @endif
                    </x-form.table.td>
                    <x-form.table.td> {{ $art->status }} </x-form.table.td>
                    <x-form.table.td>
                        <div class="flex items-center gap-1">
                            <x-form.view-btn href="/artifacts-restoration-view/{{ $art->id }}" />
                                @if(auth()->user()->is_admin || auth()->user()->is_clerical)
                                    <x-form.edit-btn href="/artifacts-restoration/restored/{{ $art->id }}" />
                                @endIf
                                @if(auth()->user()->is_admin || auth()->user()->is_admin_staff || auth()->user()->is_clerical)
                                    @if($art->status === 'In-Progress')
                                        <x-form.print-btn href="/generate/in-progress-letter/{{ $art->id }}" />
                                    @else
                                        <x-form.print-btn  href="/generate/restored-letter/{{ $art->id }}" />
                                    @endif
                                @endIf
                        </div>
                    </x-form.table.td>
                </x-form.table.tr>
            @endforeach
        </x-form.table.table>

        @if (!empty($artifacts))
            <x-form.table.pagination wire:model.change="page">
                {{ $artifacts->links() }}
            </x-form.table.pagination>
        @endif
    </div>

    @if ($print)
        <div id="printable-content" class="">
            <header class="w-full flex items-center gap-2 justify-center">
                <div>
                    <img src="{{ asset('images/icons/city-of-urdaneta.png') }}" alt="Image 1" style="height: 60px;">
                </div>
                <div>
                    <img src="{{ asset('images/icons/urdaneta-logo.png') }}" alt="Image 2" style="height: 60px;">
                </div>

                <h1 class="text-xl font-bold">City Tourism Office </h1>
            </header>

            <hr>

            <br>
            <main>
                <section>
                    <h3 class="font-bold text-lg">Acknowledgement Recepient</h3> <br>

                    <div class="ms-6">
                        This is to acknowledge that <span id="conservatorName">
                            {{ $print->fname . ' ' . $print->mname . ' ' . $print->lname }} </span>,
                        restoring the <span id="artifactName">{{ $print->artifact->name }}</span> at City Museum,
                        Urdaneta City
                        Cultural and Sport Complex.
                    </div>
                    <br>

                    <div class="ms-6">
                        <h5>Conservation Status item: </h5>

                        <ul>
                            <li id="conservationStatus" style="width: 100%;"> {{ $print->conservation_status_before }}
                            </li>
                        </ul>
                    </div>

                    <br>
                    <div class="ms-6">
                        Released this <span id="day">19th</span> day of <span id="monthAndYear">January
                            2025</span>
                        at City Tourism Office, LGU Urdaneta.
                    </div>
                    <br>


                    <div>
                        <h5 class="ms-6">Attachment Images</h5>

                        <div>
                            <p>Before Restoring</p>
                            <div id="image-container" class="image-container"
                                style="display: flex; align-items: center; gap: 5px; flex-wrap: wrap;">

                            </div>
                        </div>
                    </div>

                    <br>
                    <div id="remarks-cont">
                        Remarks
                        <p style="font-size: 12px;" id="remarks">

                        </p>
                    </div>

                    <br>
                    <br>
                    <div style="font-size: 14px;">
                        Released by:
                        <p style="text-decoration: underline; margin: 0;">
                            {{ $print->released_by->fname . ' ' . $print->released_by->mname . ' ' . $print->released_by->lname . ' ' . $print->released_by->suffix }}
                        </p>
                        <p style="margin-top: 0;">Clerical, Inspection and Communication Section</p>
                    </div>

                    <br>

                    <div style="font-size: 14px;">
                        Approved by:
                        <p style="text-decoration: underline; margin: 0;">
                            {{ $print->received_by->fname . ' ' . $print->received_by->mname . ' ' . $print->received_by->lname . ' ' . $print->received_by->suffix }}
                        </p>
                        <p style="margin-top: 0;">City Tourism Officer</p>
                    </div>

                    <br>
                    <br>

                    <div class="w-full text-center">
                        <hr>
                        <p style="text-align: center; font-size: 9px; margin: 0;">1/F Cultural and Sports, Amadeo R.
                            Pereze
                            Jr. Avenue Brgy. Poblacion, Urdaneta City University, Pangasinan 2428
                        </p>
                        <p style="text-align: center; font-size: 9px; margin: 0;">Website: www.urdaneta-city.gov.ph
                            Email:
                            urdanetacitytourism@gmail.com Facebook: Urdaneta Tourism Contact No:
                            075-600-5231/0917-836-5748
                        </p>
                    </div>
                </section>
            </main>
        </div>
    @endif

    <!-- Modal -->
    <x-modal.view id="viewExhibitModal" header="Exhibit Details">
        <div class="w-full h-full flex flex-col items-center justify-center">
            <div class="text-lg font-sans">
                <p><span class="text-gray-500">Exhibit ID:</span> <span id="modal-exhibit-id"></span></p>
                <p><span class="text-gray-500">Program Name:</span> <span id="modal-program-name"></span></p>
                <p><span class="text-gray-500">Subject Activity:</span> <span id="modal-subject-activity"></span></p>
                <p><span class="text-gray-500">Address:</span> <span id="modal-address"></span></p>
                <p><span class="text-gray-500">Date:</span> <span id="modal-date-range"></span></p>
                <p><span class="text-gray-500">Released By:</span> <span id="modal-released-by"></span></p>
                <p><span class="text-gray-500">Released By Position:</span> <span id="modal-released-position"></span>
                </p>
                <p><span class="text-gray-500">Status:</span> <span id="modal-status"></span></p>
            </div>
        </div>
    </x-modal.view>
</x-admin.body>