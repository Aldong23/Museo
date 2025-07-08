<x-layouts.visitor-layout>
    <div class="relative w-full p-10 flex flex-col gap-6">
        <x-visitor-view.row>
            @isset($arch->cultural_heritage_category)
                <x-visitor-view.text label="Cultural Heritage Category" content="{{ $arch->cultural_heritage_category }}" />
            @endisset

            @isset($arch->cultural_heritage_type)
                <x-visitor-view.text label="Types of Cultural Heritage" content="{{ $arch->cultural_heritage_type }}" />
            @endisset
        </x-visitor-view.row>


        @isset($arch->name)
            <x-visitor-view.text label="Name of Object" content="{{ $arch->name }}" />
        @endisset

        <x-visitor-view.section label="Featured Collections">
            @isset($arch->photo_details)
                @foreach ($arch->photo_details as $photo)
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
                @isset($arch->type)
                    <x-visitor-view.text label="Type" content="{{ $arch->type }}" />
                @endisset
                @isset($arch->date_of_record)
                    <x-visitor-view.text label="Date of Record" content="{{ $arch->date_of_record->format('F j, Y') }}" />
                @endisset
                @isset($arch->estimated_age)
                    <x-visitor-view.text label="Estimated Age" content="{{ $arch->estimated_age }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($arch->length)
                    <x-visitor-view.text label="Volume / Size of Record (length)" content="{{ $arch->length }}" />
                @endisset
                @isset($arch->width)
                    <x-visitor-view.text label="Volume / Size of Record (width)" content="{{ $arch->width }}" />
                @endisset
                @isset($arch->arrangement)
                    <x-visitor-view.text label="Arrangement" content="{{ $arch->arrangement }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.row>
                @isset($arch->office_of_origin)
                    <x-visitor-view.text label="Office of Origin" content="{{ $arch->office_of_origin }}" />
                @endisset
                @isset($arch->contact_person)
                    <x-visitor-view.text label="Contact Person" content="{{ $arch->contact_person }}" />
                @endisset
            </x-visitor-view.row>

            <x-visitor-view.section label="Description">

                @isset($arch->description_of_material)
                    <x-visitor-view.text label="Description of Material"
                        content="{{ implode(' ,', $arch->description_of_material) }}" />
                @endisset

                @isset($arch->remarks_1)
                    <x-visitor-view.text label="Remarks" content="{{ $arch->remarks_1 }}" />
                @endisset

            </x-visitor-view.section>

            @isset($arch->description)
                <x-visitor-view.text label="Description" content="{{ $arch->description }}" />
            @endisset

            @isset($arch->stories)
                <x-visitor-view.text label="Stories / Narratives / Beliefs / Practices Associated with Archival Holding"
                    content="{{ $arch->stories }}" />
            @endisset

            @isset($arch->significance)
                <x-visitor-view.text label="Significance" content="{{ $arch->significance }}" />
            @endisset

        </x-visitor-view.section>

        <x-visitor-view.section label="Conservation Status">

            @isset($arch->physical_condition)
                <x-visitor-view.text label="Physical Condition" content="{{ implode(' ,', $arch->physical_condition) }}" />
            @endisset

            @isset($arch->remarks_2)
                <x-visitor-view.text label="Remarks" content="{{ $arch->remarks_2 }}" />
            @endisset

            @isset($arch->narration)
                <x-visitor-view.text label="Narration" content="{{ $arch->narration }}" />
            @endisset

            @isset($arch->references)
                <x-visitor-view.text label="References" content="{{ $arch->references }}" />
            @endisset

            @isset($arch->mappers)
                <x-visitor-view.text label="Name of Mapper" content="{{ $arch->mappers }}" />
            @endisset

            @isset($arch->date_profiled)
                <x-visitor-view.text label="Date Profiled" content="{{ $arch->date_profiled->format('F j, Y') }}" />
            @endisset
        </x-visitor-view.section>


        <div class="px-5 py-10 flex justify-end">
            <x-form.cancel-link href="javascript:history.back()">
                Back
            </x-form.cancel-link>
        </div>


        <script src="{{ asset('js/zoom.js') }}"></script>
</x-layouts.visitor-layout>
