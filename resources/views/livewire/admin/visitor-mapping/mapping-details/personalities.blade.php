<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($sp->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $sp->cultural_heritage_category }}" />
            @endisset

            @isset($sp->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $sp->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($sp->name)
            <x-visitor-view.text label="Name of Object" content="{{ $sp->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($sp->photo_details)
                @foreach ($sp->photo_details as $photo)
                    <div class="w-full p-4 space-y-4 border border-gray-300 rounded-lg">
                        <x-visitor-view.row>
                            @isset($photo['photo_credit'])
                                <x-visitor-view.text label="Photo Credit" content="{{ $photo['photo_credit'] }}" />
                            @endisset

                            @isset($photo['photo_date'])
                                <x-visitor-view.text label="Photo Date Captured"
                                    content="{{ \Carbon\Carbon::parse($photo['photo_date'])->format('F j, Y') }}" />
                            @endisset
                        </x-visitor-view.row>

                        <x-visitor-view.image label="Photo">
                            @isset($photo['photos'])
                                @foreach ($photo['photos'] as $path)
                                    <img src="{{ asset('storage/' . $path) }}" alt="{{ $path }}"
                                        class="photo-img clickable-img w-auto h-60">
                                @endforeach
                            @endisset
                        </x-visitor-view.image>
                    </div>
                @endforeach
            @endisset
        </x-visitor-view.section>

        <!-- Modal for Image Display -->
        <div id="imageModal"
            class="fixed left-0 right-0 top-0 h-screen overflow-hidden bg-black/40 backdrop-blur-sm z-40 hidden p-5">
            <div class="relative w-full h-full flex flex-col items-center justify-center">
                <div class="absolute right-0 top-0">
                    <x-icons.close />
                </div>
                <img id="modalImage" class="w-auto h-full cursor-zoom-in" />
            </div>
        </div>

        <x-visitor-view.section label="Background Information">

            <x-visitor-view.row>
                @isset($sp->date_of_birth)
                    <x-visitor-view.text label="Date of Birth" content="{{ $sp->date_of_birth->format('F j, Y') }}" />
                @endisset
                @isset($sp->date_of_death)
                    <x-visitor-view.text label="Date of Death" content="{{ $sp->date_of_death->format('F j, Y') }}" />
                @endisset
                @isset($sp->age)
                    <x-visitor-view.text label="Age" content="{{ $sp->age }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($sp->prominence)
                    <x-visitor-view.text label="Prominence" content="{{ $sp->prominence }}" />
                @endisset
                @isset($sp->birthplace)
                    <x-visitor-view.text label="Birth Place" content="{{ $sp->birthplace }}" />
                @endisset
            </x-visitor-view.row>

            @isset($sp->present_address)
                <x-visitor-view.text label="Present Address" content="{{ $sp->present_address }}" />
            @endisset

            @isset($sp->biography)
                <x-visitor-view.text label="Biography" content="{{ $sp->biography }}" />
            @endisset

            @isset($sp->significance)
                <x-visitor-view.text label="Significance" content="{{ $sp->significance }}" />
            @endisset

        </x-visitor-view.section>

        <x-visitor-view.section label="References">

            @isset($sp->references)
                <x-visitor-view.text label="Key Informta/s" content="{{ $sp->references }}" />
            @endisset

            @isset($sp->mappers)
                <x-visitor-view.text label="Name of Mapper" content="{{ $sp->mappers }}" />
            @endisset

            @isset($sp->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $sp->date_profiled->format('F j, Y') }}" />
            @endisset


            @isset($sp->attachment)
                <x-visitor-view.text label="Attachment (Achievements)" content="{{ $sp->attachment }}" />
            @endisset

        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


       
        <script src="{{ asset('js/zoom.js') }}"></script>
        
</x-layouts.visitor-layout>
