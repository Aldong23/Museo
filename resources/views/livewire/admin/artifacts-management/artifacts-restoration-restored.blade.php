<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Adding of Restoration</x-slot:secHeading>
<x-admin.body>
    {{-- SINGLE SELECT NAME --}}

    <x-form.input label="Artifact Name" wire:model="artifact_name" />
    @error('artifact_name')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror


    {{-- CATEGORY AND TYPES --}}
    <div class="w-full md:flex items-center gap-2">
        <div class="w-full">
            <x-form.select-input label="Artifacts Category" wire:model="selectedCategory"
                wire:change="updateSubcategories">
                <option value="">Select Category</option>
                @foreach ($categories as $key => $value)
                    <option value="{{ $key }}" {{ $selectedCategory == $key ? 'selected' : '' }}>
                        {{ $value }}
                    </option>
                @endforeach
            </x-form.select-input>
            @error('selectedCategory')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.select-input label="Types of Artifacts" wire:model="selectedType">
                <option value="">Select Type</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" {{ $selectedType == $type ? 'selected' : '' }}>
                        {{ $type }}
                    </option>
                @endforeach
            </x-form.select-input>
            @error('selectedType')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    {{-- ========================================= CONSERVATOR INFORMATION --}}
    <br>
    <h1 class="font-bold">Conservator Information</h1>

    <x-form.select-input label="Valid ID*" wire:model="valid_id">
        <option value="">Select</option>
        <option value="NCCA Employee ID" {{ $valid_id === 'NCCA Employee ID' ? 'selected' : '' }}>NCCA Employee ID
        </option>
        <option value="UMID" {{ $valid_id === 'UMID' ? 'selected' : '' }}>UMID</option>
        <option value="Passport" {{ $valid_id === 'Passport' ? 'selected' : '' }}>Passport</option>
        <option value="Driver’s License" {{ $valid_id === 'Driver’s License' ? 'selected' : '' }}>Driver’s License
        </option>
        <option value="Professional Regulation" {{ $valid_id === 'Professional Regulation' ? 'selected' : '' }}>
            Professional Regulation</option>
        <option value="Commission (PRC) ID" {{ $valid_id === 'Commission (PRC) ID' ? 'selected' : '' }}>Commission
            (PRC) ID</option>
        <option value="Philippine Postal ID" {{ $valid_id === 'Philippine Postal ID' ? 'selected' : '' }}>Philippine
            Postal ID</option>
    </x-form.select-input>
    @error('valid_id')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    {{-- FULL NAME --}}
    <div class="w-full md:flex items-center pt-2">
        <div class="w-full">
            <x-form.input label="Last Name*" wire:model="last_name" />
            @error('last_name')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="First Name*" wire:model="first_name" />
            @error('first_name')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="Middle Name" wire:model="middle_name" />
        </div>

        <div class="w-full">
            <x-form.input label="Suffix" wire:model="suffix" />
        </div>
    </div>
    {{-- EMAIL / CONTACT NO --}}
    <div class="w-full md:flex items-center pt-2">
        <div class="w-full">
            <x-form.input label="Contact No*" wire:model="contact_no" />
            @error('contact_no')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>

        <div class="w-full">
            <x-form.input label="Email Address*" wire:model="email" />
            @error('email')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    {{-- ========================================= ARTIFACT INFORMATION --}}
    <br>
    <h1 class="font-bold">Artifact Information</h1>

    <div class="w-full flex items-start gap-2">

        <div class="w-full lg:w-96 mt-5">
            <x-form.date-input label="Date Released" wire:model="date_released" />
            @error('date_released')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        {{-- MULTIPLE SELECT  --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Conservation Status" id="conservation_status_before" multiple="multiple"
                    wire:model="conservation_status_before">
                    <option value="">Select</option>
                    <option value="Yellowing">Yellowing</option>
                    <option value="Fading">Fading</option>
                    <option value="Foxing (Brown Spot)">Foxing (Brown Spot)</option>
                    <option value="Accretions">Accretions</option>
                    <option value="Holes">Holes</option>
                    <option value="Fingerprints">Fingerprints</option>
                    <option value="Tears/Break">Tears/Break</option>
                    <option value="Losses">Losses</option>
                    <option value="Creases">Creases</option>
                    <option value="Brittle">Brittle</option>
                    <option value="Abrasion">Abrasion</option>
                    <option value="Folds">Folds</option>
                    <option value="Wrinkles">Wrinkles</option>
                    <option value="Molds">Molds</option>
                    <option value="Insect Infestation">Insect Infestation</option>
                </x-form.select2>
            </div>
            @error('conservation_status_before')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    {{-- ===================================================== ARTIFACTS BEFORE  --}}
    <h1 class="mb-2 mt-4 ms-2">Artifacts Before</h1>



    <div class="w-fit flex flex-col items-end gap-1 relative">
        @if ($artifacts_before_images)
            <!-- Image Wrapper -->
            <div class="overflow-hidden rounded-lg border border-gray-400 w-[400px]"> <!-- Adjust width as needed -->
                <div id="carousel-2" class="flex transition-transform duration-500 ease-in-out">
                    @foreach ($artifacts_before_images as $images)
                        <img class="h-64 object-cover flex-shrink-0" src="{{ Storage::url($images) }}" alt="Artifact Image">
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
        @else
            <p class="text-gray-500">No artifacts available</p>
        @endif
    </div>


    <x-form.textarea label="Remarks" wire:model="remarks_before" />
    @error('remarks_before')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror


    {{-- ===================================================== STATUS  --}}
    <div class="w-96">
        <x-form.select-input label="Status*" wire:model="status">
            <option value="">Select</option>
            <option value="In-Progress" {{ $valid_id === 'In-Progress' ? 'selected' : '' }}> In-Progress </option>
            <option value="Restored" {{ $valid_id === 'Restored' ? 'selected' : '' }}> Restored </option>
        </x-form.select-input>
        @error('status')
            <x-form.error> {{ $message }} </x-form.error>
        @enderror
    </div>


    {{-- ===================================================== ARTIFACTS AFTER RESTORED  --}}
    <h1 class="mb-2 mt-4 ms-2">Artifacts After Restored</h1>

    <div class="w-full flex items-start gap-2">

        <div class="w-full lg:w-96 mt-5">
            <x-form.date-input label="Date Restored" wire:model="date_restored" />
            @error('date_restored')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
        {{-- MULTIPLE SELECT  --}}
        <div class="w-full">
            <div wire:ignore class="w-full">
                <x-form.select2 label="Conservation Status" id="conservation_status_after" multiple="multiple"
                    wire:model="conservation_status_after">
                    <option value="">Select</option>
                    <option value="Yellowing">Yellowing</option>
                    <option value="Fading">Fading</option>
                    <option value="Foxing (Brown Spot)">Foxing (Brown Spot)</option>
                    <option value="Accretions">Accretions</option>
                    <option value="Holes">Holes</option>
                    <option value="Fingerprints">Fingerprints</option>
                    <option value="Tears/Break">Tears/Break</option>
                    <option value="Losses">Losses</option>
                    <option value="Creases">Creases</option>
                    <option value="Brittle">Brittle</option>
                    <option value="Abrasion">Abrasion</option>
                    <option value="Folds">Folds</option>
                    <option value="Wrinkles">Wrinkles</option>
                    <option value="Molds">Molds</option>
                    <option value="Insect Infestation">Insect Infestation</option>
                </x-form.select2>
            </div>
            @error('conservation_status_after')
                <x-form.error> {{ $message }} </x-form.error>
            @enderror
        </div>
    </div>

    <br>
    <div class="flex gap-4">
        <!-- Left: Show Artifacts Before if Artifacts After is Empty -->
        @if (!$artifacts_after)
            <div class="w-1/2">
                <h2 class="text-lg font-bold mb-2">Artifacts Before</h2>
                <div class="relative w-full max-w-lg mx-auto">
                    @if ($artifacts_before_images)
                        <!-- Image Wrapper -->
                        <div class="overflow-hidden rounded-md">
                            <div id="carousel" class="flex transition-transform duration-500 ease-in-out">
                                @foreach ($artifacts_before_images as $image)
                                    <img class="w-full h-64 object-cover flex-shrink-0" 
                                        src="{{ Storage::url($image) }}" 
                                        alt="Artifact image">
                                @endforeach
                            </div>
                        </div>

                        <!-- Controls -->
                        <button id="prevBtn"
                            class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                            ←
                        </button>

                        <button id="nextBtn"
                            class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                            →
                        </button>
                    @else
                        <p class="text-gray-500 text-center">No artifacts available</p>
                    @endif
                </div>

            </div>
        @endif

        <!-- Right: Upload Artifacts After -->
        <div class="{{ $artifacts_after ? 'w-full' : 'w-1/2' }}">
            <h2 class="text-lg font-bold mb-2">Upload Artifacts After</h2>
            @if ($artifacts_after)
            <x-form.file-input-wrapper multiple accept="image/*" name="artifacts_after" wire:model="artifacts_after">
                @foreach ($artifacts_after ?? [] as $key => $collection)
                    <div class="relative">
                        @if ($collection instanceof \Illuminate\Http\UploadedFile)
                            <img class="rounded-md h-64 flex" src="{{ $collection->temporaryUrl() }}">
                        @else
                            <img class="rounded-md h-64 flex" src="{{ Storage::url($collection) }}">
                        @endif
                        <button class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded px-2 py-1"
                            wire:click="removeArtifactAfter({{ $key }})">
                            Remove
                        </button>
                    </div>
                @endforeach
            </x-form.file-input-wrapper>
            @else
                <x-form.file multiple accept="image/*" name="artifacts_after" wire:model="artifacts_after" />
            @endif
        </div>
    </div>




    @error('artifacts_after')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror

    <br>
    <x-form.textarea label="Remarks" wire:model="remarks_after" />

    @error('remarks_after')
        <x-form.error> {{ $message }} </x-form.error>
    @enderror



    <div x-data="{ showModal: false }">
        <!-- Save Button (Triggers Modal) -->
        <div class="flex items-center justify-end px-4 py-6">
            <div class="flex items-center gap-4">
                <x-form.cancel-link href="/artifacts-restoration">Cancel</x-form.cancel-link>
                <x-form.button @click="showModal = true"> Save </x-form.button>
            </div>
        </div>

        <!-- Modal Background (Hidden by Default) -->
        <div x-show="showModal" x-cloak class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center p-4">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-4xl relative">
                
                <!-- Modal Header -->
                <h2 class="text-lg font-semibold text-gray-800 text-center mb-4">Confirm Restoration</h2>

                <!-- Modal Content (Side-by-Side Carousels) -->
                <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                    <!-- Left Carousel (Artifacts Before) -->
                    <div class="w-full md:w-1/2 text-center relative">
                        <h3 class="text-md font-semibold mb-2">Before Restoration</h3>
                        <div class="overflow-hidden rounded-lg border border-gray-400 w-full">
                            <div class="relative w-full max-w-lg mx-auto">
                                @if ($artifacts_before_images)
                                    <!-- Image Wrapper -->
                                    <div class="overflow-hidden rounded-md border border-gray-400">
                                        <div id="carousel-before" class="flex transition-transform duration-500 ease-in-out">
                                            @foreach ($artifacts_before_images as $image)
                                                <img class="h-64 object-cover flex-shrink-0 w-full" 
                                                    src="{{ Storage::url($image) }}" alt="Artifact Before">
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Controls -->
                                    <button id="prevBtn-3"
                                        class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                                        ←
                                    </button>

                                    <button id="nextBtn-3"
                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                                        →
                                    </button>
                                @else
                                    <p class="text-gray-500 text-center">No artifacts available</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Carousel (Artifacts After) -->
                    <div class="w-full md:w-1/2 text-center relative">
                        <h3 class="text-md font-semibold mb-2">After Restoration</h3>
                        <div class="overflow-hidden rounded-lg border border-gray-400 w-full">
                            <div class="relative w-full max-w-lg mx-auto">
                                @if ($artifacts_after)
                                    <!-- Image Wrapper -->
                                    <div class="overflow-hidden rounded-md border border-gray-400">
                                        <div id="carousel-after" class="flex transition-transform duration-500 ease-in-out">
                                            
                                            {{-- Show existing images from database --}}
                                            @foreach ($artifacts_after as $image)
                                                <img class="h-64 object-cover flex-shrink-0 w-full" 
                                                    src="{{ is_string($image) ? Storage::url($image) : $image->temporaryUrl() }}" 
                                                    alt="Artifact After">
                                            @endforeach

                                        </div>
                                    </div>

                                    <!-- Controls -->
                                    <button id="prevBtn-4"
                                        class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                                        ←
                                    </button>

                                    <button id="nextBtn-4"
                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-2 rounded">
                                        →
                                    </button>
                                @else
                                    <p class="text-gray-500 text-center">No artifacts available</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="flex justify-end gap-4 mt-6">
                    <button @click="showModal = false" class="px-4 py-2 bg-gray-300 text-gray-800 rounded">Cancel</button>
                    <button wire:click="save" class="px-4 py-2 bg-green-600 text-white rounded">Confirm</button>
                </div>
            </div>
        </div>
    </div>


</x-admin.body>

@script()
    <script>
        $(document).ready(function() {

            // SINGLE SELECT ================================== TYPE
            $('#artifact_id').select2({
                //tags: true
            });

            $('#artifact_id').on('change', function() {
                let data = $(this).val();
                $wire.set('artifact_id', data, false);
                $wire.dispatch('updateArt');
            });

            // MULTIPLE SELECT ================================== CONSERVATION BEFORE
            $('#conservation_status_before').select2({
                placeholder: 'Physical Condition',
                closeOnSelect: true,
                tags: true
            });

            $('#conservation_status_before').on('change', function() {
                let data = $(this).val();
                $wire.set('conservation_status_before', data, false);
            });

            // MULTIPLE SELECT ================================== CONSERVATION AFTER
            $('#conservation_status_after').select2({
                placeholder: 'Physical Condition',
                closeOnSelect: true,
                tags: true
            });

            $('#conservation_status_after').on('change', function() {
                let data = $(this).val();
                $wire.set('conservation_status_after', data, false);
            });

            // First Carousel
            const carousel = document.getElementById("carousel");
            if (carousel) {
                const images = carousel.children;
                const totalImages = images.length;
                let index = 0;

                function updateCarousel() {
                    carousel.style.transform = `translateX(-${index * 100}%)`;
                }

                document.getElementById("prevBtn")?.addEventListener("click", function () {
                    index = (index > 0) ? index - 1 : totalImages - 1;
                    updateCarousel();
                });

                document.getElementById("nextBtn")?.addEventListener("click", function () {
                    index = (index < totalImages - 1) ? index + 1 : 0;
                    updateCarousel();
                });
            }

            // Second Carousel
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

            const carousel3 = document.getElementById("carousel-before");
            const images3 = carousel3.children;
            const totalImages3 = images3.length;
            let index3 = 0;

            function updateCarousel3() {
                carousel3.style.transform = `translateX(-${index3 * 100}%)`;
            }

            document.getElementById("prevBtn-3").addEventListener("click", function () {
                index3 = (index3 > 0) ? index3 - 1 : totalImages3 - 1;
                updateCarousel3();
            });

            document.getElementById("nextBtn-3").addEventListener("click", function () {
                index3 = (index3 < totalImages3 - 1) ? index3 + 1 : 0;
                updateCarousel3();
            });

            // Carousel 4 - After Images
            function initializeCarousel4() {
                const carousel4 = document.getElementById("carousel-after");
                if (!carousel4) {
                    console.warn("🚨 Carousel 4 not found!");
                    return;
                }

                const images4 = carousel4.children;
                const totalImages4 = images4.length;
                let index4 = 0;

                function updateCarousel4() {
                    carousel4.style.transform = `translateX(-${index4 * 100}%)`;
                }

                document.getElementById("prevBtn-4").addEventListener("click", function () {
                    index4 = (index4 > 0) ? index4 - 1 : totalImages4 - 1;
                    updateCarousel4();
                });

                document.getElementById("nextBtn-4").addEventListener("click", function () {
                    index4 = (index4 < totalImages4 - 1) ? index4 + 1 : 0;
                    updateCarousel4();
                });

                console.log("✅ Carousel 4 Initialized!");
            }

            initializeCarousel4();

            Livewire.on('artifactsAfterUpdated', () => {
                
                setTimeout(initializeCarousel4, 500);
            });


        });
        
    </script>
@endscript
