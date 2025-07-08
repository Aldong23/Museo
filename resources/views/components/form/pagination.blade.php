<div class="w-full flex items-center justify-between px-4 py-5">
    <div class="flex text-sm justify-center items-center gap-2 text-nowrap mr-8">
        Per page:
        <select class="rounded text-xs bg-bg-secondary" {{ $attributes }}>
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="50">50</option>
        </select>
    </div>
    <div class="w-full">
        {{ $slot }}
    </div>
</div>
