<div wire:ingnore class="w-full flex flex-col gap-1 p-2">
    <label for="" class="text-txt-secondary">
        {{ $label }}
    </label>
    <select {{ $attributes }}>
        {{ $slot }}
    </select>
</div>
