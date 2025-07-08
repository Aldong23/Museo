<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>View Artifacts Restoration</x-slot:secHeading>
<x-admin.body>
{{-- SINGLE SELECT NAME --}}
    <div class="w-full">
        <x-form.input label="Artifact Name" value="{{ $restoration->artifact->name }}" disabled/>
    </div>

    {{-- CATEGORY AND TYPES --}}
    <div class="w-full md:flex items-center gap-2">
        <div class="w-full">
            <x-form.input label="Artifacts Category" value="{{ $restoration->artifact->category }}" disabled/>
        </div>

        <div class="w-full">
            <x-form.input label="Types of Artifacts" value="{{ $restoration->artifact->type }}" disabled/>
        </div>
    </div>

    {{-- ========================================= CONSERVATOR INFORMATION --}}
    <br>
    <h1 class="font-bold">Conservator Information</h1>

    <x-form.input label="Valid ID" value="{{ $restoration->valid_id }}" disabled/>

    {{-- FULL NAME --}}
    <div class="w-full md:flex items-center pt-2">
        <div class="w-full">
            <x-form.input label="Last Name" value="{{ $restoration->lname }}" disabled/>
        </div>

        <div class="w-full">
            <x-form.input label="First Name" value="{{ $restoration->fname }}" disabled/>
        </div>

        <div class="w-full">
            <x-form.input label="Middle Name" value="{{ $restoration->mname ?? 'N/A' }}" disabled/>
        </div>

        <div class="w-full">
            <x-form.input label="Suffix" value="{{ $restoration->suffix ?? 'N/A' }}" disabled/>
        </div>
    </div>
    {{-- EMAIL / CONTACT NO --}}
    <div class="w-full md:flex items-center pt-2">
        <div class="w-full">
            <x-form.input label="Contact No" value="{{ $restoration->contact_no }}" disabled/>
        </div>

        <div class="w-full">
            <x-form.input label="Email Address" value="{{ $restoration->email }}" disabled/>
        </div>
    </div>

    {{-- ========================================= ARTIFACT INFORMATION --}}
    <br>
    <h1 class="font-bold">Artifact Information</h1>

    <div class="w-full flex items-start gap-2">

        <div class="w-full lg:w-96 mt-5">
            <x-form.input label="Date Released" value="{{ $restoration->date_released->format('m/d/Y') }}" disabled/>
        </div>
        {{-- MULTIPLE SELECT  --}}
        <div class="ms-3 w-full">
            <p class="text-xs">Conservation Status</p>
            <div class="mt-3 flex space-x-2 border border-gray-400 px-3 py-2 rounded">
                @foreach ($restoration->conservation_status_before as $conservation_status_before)
                    <span class="border border-gray-400 bg-gray-200 rounded px-3 py-1">
                        {{ $conservation_status_before }}
                    </span>
                @endforeach
            </div>
        </div>


    </div>

    {{-- ===================================================== ARTIFACTS BEFORE  --}}
    <h1 class="mb-2 mt-4 ms-2">Artifacts Before</h1>

    @if ($restoration->artifacts_before)
        <div class="w-fit flex flex-col items-end gap-1 relative">
            <!-- Image Wrapper -->
            <div class="overflow-hidden rounded-lg border border-gray-400 w-[400px]">
                <div id="carousel-1" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($restoration->artifacts_before as $artifacts_before)
                        <img class="h-64 object-cover flex-shrink-0 w-full" 
                            src="{{ asset('storage/' . str_replace('\/', '/', $artifacts_before)) }}" 
                            alt="Artifact Before">
                    @endforeach
                </div>
            </div>

            <!-- Controls -->
            <button id="prevBtn-1" 
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                ←
            </button>

            <button id="nextBtn-1" 
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                →
            </button>
        </div>
    @endif


    <div class="w-full flex flex-col gap-1 p-2 mb-3">
        <label class="text-txt-secondary">Remarks</label>
        <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $restoration->remarks_before }}</div>
    </div>
    {{-- ===================================================== STATUS  --}}
    <div class="w-96">
        <x-form.input label="Status" value="{{ $restoration->status }}" disabled/>
    </div>

    @if($restoration->status == "Restored")
        {{-- ===================================================== ARTIFACTS AFTER RESTORED  --}}
        <h1 class="mb-2 mt-4 ms-2">Artifacts After Restored</h1>

        <div class="w-full flex items-start gap-2">

            <div class="w-full lg:w-96 mt-5">
                <x-form.input label="Date Restored" value="{{ $restoration->date_restored->format('m/d/Y') }}" disabled/>
            </div>
            {{-- MULTIPLE SELECT  --}}
            <div class="ms-3 w-full">
                <p class="text-xs">Conservation Status</p>
                <div class="mt-3 flex space-x-2 border border-gray-400 px-3 py-2 rounded">
                    @foreach ($restoration->conservation_status_after as $conservation_status_after)
                        <span class="border border-gray-400 bg-gray-200 rounded px-3 py-1">
                            {{ $conservation_status_after }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>

        <br>
        @if ($restoration->artifacts_after)
            <div class="w-fit flex flex-col items-end gap-1 relative">
                <!-- Image Wrapper -->
                <div class="overflow-hidden rounded-lg border border-gray-400 w-[400px]">
                    <div id="carousel-2" class="flex transition-transform duration-500 ease-in-out">
                        @foreach ($restoration->artifacts_after as $artifacts_after)
                            <img class="h-64 object-cover flex-shrink-0 w-full" 
                                src="{{ asset('storage/' . str_replace('\/', '/', $artifacts_after)) }}" 
                                alt="Artifact After">
                        @endforeach
                    </div>
                </div>

                <!-- Controls -->
                <button id="prevBtn-2" 
                        class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                    ←
                </button>

                <button id="nextBtn-2" 
                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                    →
                </button>
            </div>
        @endif


        <br>

        <div class="w-full flex flex-col gap-1 p-2">
            <label class="text-txt-secondary">Remarks</label>
            <div class="border border-brdr-primary text-txt-primary rounded-lg p-2.5 whitespace-pre-wrap">{{ $restoration->remarks_after }}</div>
        </div>
    @endif

</x-admin.body>

@script()
<script>
    $(document).ready(function() {
        const carousel1 = document.getElementById("carousel-1");
        if (carousel1) {
            const images1 = carousel1.children;
            const totalImages1 = images1.length;
            let index1 = 0;

            function updateCarousel1() {
                carousel1.style.transform = `translateX(-${index1 * 100}%)`;
            }

            document.getElementById("prevBtn-1")?.addEventListener("click", function () {
                index1 = (index1 > 0) ? index1 - 1 : totalImages1 - 1;
                updateCarousel1();
            });

            document.getElementById("nextBtn-1")?.addEventListener("click", function () {
                index1 = (index1 < totalImages1 - 1) ? index1 + 1 : 0;
                updateCarousel1();
            });
        } 

        const carousel2 = document.getElementById("carousel-2");
        if (carousel2) {
            const images2 = carousel2.children;
            const totalImages2 = images2.length;
            let index2 = 0;

            function updateCarousel2() {
                carousel2.style.transform = `translateX(-${index2 * 100}%)`;
            }

            document.getElementById("prevBtn-2")?.addEventListener("click", function () {
                index2 = (index2 > 0) ? index2 - 1 : totalImages2 - 1;
                updateCarousel2();
            });

            document.getElementById("nextBtn-2")?.addEventListener("click", function () {
                index2 = (index2 < totalImages2 - 1) ? index2 + 1 : 0;
                updateCarousel2();
            });
        }

    });
    
</script>
@endscript
