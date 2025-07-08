

<div {{ $attributes->merge(['class' => 'absolute top-0 bottom-0 left-0 right-0 w-full h-full']) }}>
    <div class="w-full h-full p-6 flex flex-col overflow-auto">
        {{ $slot }}
    </div>
</div>
