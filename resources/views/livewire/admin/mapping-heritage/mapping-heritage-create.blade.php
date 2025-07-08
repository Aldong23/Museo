<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Adding of Cultural Heritage</x-slot:secHeading>
<x-admin.body>

    <div class="w-full flex items-center gap-2">
        <x-form.select-input label="Cultural Heritage Category" wire:model.change="selectedCategory"
            wire:change="updateSubcategories">
            <option value="">Select Category</option>
            @foreach ($categories as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach
        </x-form.select-input>
        @if ($selectedCategory !== 'Significant Personalities')
            <x-form.select-input label="Types of Cultural Heritage" wire:model.change="selectedSubcategory"
                wire:change="updateType">
                <option value="">Select Subcategory</option>
                @foreach ($subcategories as $subcategory)
                    <option value="{{ $subcategory }}">{{ $subcategory }}</option>
                @endforeach
            </x-form.select-input>
        @endif
    </div>

    @if ($selectedCategory !== 'Significant Personalities')
        @if ($selectedSubcategory === 'Bodies of Water')
            <livewire:admin.mapping-heritage.types.bodies-of-water />
        @elseif ($selectedSubcategory === 'Plants (Flora)')
            <livewire:admin.mapping-heritage.types.plants />
        @elseif ($selectedSubcategory === 'Animals (Fauna)')
            <livewire:admin.mapping-heritage.types.animal />
        @elseif ($selectedSubcategory === 'Protected Area')
            <livewire:admin.mapping-heritage.types.protected-area />
        @elseif ($selectedSubcategory === 'Critical Area')
            <livewire:admin.mapping-heritage.types.critical-area />
        @elseif ($selectedSubcategory === 'Sites')
            <livewire:admin.mapping-heritage.types.sites />
        @elseif ($selectedSubcategory == 'Houses' || $selectedSubcategory == 'Houses with Period')
            <livewire:admin.mapping-heritage.types.houses :selectedSubcategory="$selectedSubcategory"  />
        @elseif ($selectedSubcategory == 'Government/Private' || $selectedSubcategory == 'School' || $selectedSubcategory == 'Hospital' || $selectedSubcategory == 'Church' || $selectedSubcategory == 'Monuments')
            <livewire:admin.mapping-heritage.types.government :selectedSubcategory="$selectedSubcategory" />
        @elseif ($selectedSubcategory === 'Ethnographic Object')
            <livewire:admin.mapping-heritage.types.ethnographic-object />
        @elseif ($selectedSubcategory === 'Archival Holdings')
            <livewire:admin.mapping-heritage.types.archival-holdings />
        @elseif ($selectedSubcategory === 'Social Practices')
            <livewire:admin.mapping-heritage.types.social-practices />
        @elseif ($selectedSubcategory === 'Knowledge and Practices')
            <livewire:admin.mapping-heritage.types.knowledge-and-practices />
        @elseif ($selectedSubcategory === 'Traditional Craftsmanship')
            <livewire:admin.mapping-heritage.types.traditional-craftsmanship />
        @elseif ($selectedSubcategory === 'Oral Tradition')
            <livewire:admin.mapping-heritage.types.oral-tradition />
        @elseif ($selectedCategory === 'Cultural Institutions')
            <livewire:admin.mapping-heritage.cultural-institutions />
        @endif
    @else
        <livewire:admin.mapping-heritage.types.personalities />
    @endif


    {{-- <livewire:admin.mapping-heritage.types.bodies-of-water /> --}}
    {{-- <livewire:admin.mapping-heritage.types.farmers-association /> --}}
    {{-- <livewire:admin.mapping-heritage.types.school-institutions /> --}}
    {{-- <livewire:admin.mapping-heritage.types.associations /> --}}
    {{-- <livewire:admin.mapping-heritage.types.political-clan /> --}}
    {{-- <livewire:admin.mapping-heritage.types.school-institutions-library /> --}}

</x-admin.body>
