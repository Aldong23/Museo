<div {{ $attributes->merge(['class' => 'w-full h-fit p-2 border border-brdr-primary rounded-md']) }}>
    <table class="min-w-full">
        <thead class="bg-bg-tertiary">
            {{ $head }}
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>
