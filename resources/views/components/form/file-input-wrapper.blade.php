<div title="Upload" class="w-fit flex flex-col items-end gap-1">
    <label for="dropzone-file">
        <div class="flex flex-wrap gap-2 p-2 border border-gray-400 rounded-lg">
            {{ $slot }}
        </div>
    </label>
    <input id="dropzone-file" type="file" class="hidden" {{ $attributes }} />
</div>
