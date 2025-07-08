<div class="w-full flex flex-col gap-1 p-2">
    <label for="" class="text-txt-secondary">
        {{ $label }}
    </label>
    <textarea
        {{ $attributes->merge(['class' => 'bg-transparent border border-brdr-primary text-txt-primary text-sm rounded-lg focus:ring-btn-blue focus:border-btn-blue block w-full p-2.5', 'rows' => '10']) }}></textarea>
</div>
