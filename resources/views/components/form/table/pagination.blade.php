<div class="w-full flex items-center justify-between px-4 py-5">
    <div class="flex justify-center items-center gap-2 text-nowrap mr-8">
        Per page:
        <select class="rounded text-sm bg-bg-secondary" {{ $attributes }}>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="50">50</option>
            <option value="80">80</option>
        </select>
    </div>
    <div class="w-full">
        {{ $slot }}
    </div>
</div>
