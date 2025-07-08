<x-slot:heading>Museo De Urdaneta</x-slot:heading>
<x-slot:secHeading>Artifact Restored</x-slot:secHeading>
<x-admin.body>
    <div class="w-full flex flex-wrap px-2 py-4 gap-2">
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="conservator">Add Conservator field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="artifact">Add Artifact field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="before_status">Add Before Status field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="after_status">Add After Status field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="day">Add Day field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="date">Add Date field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="before_images">Add Before Image attachments</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="after_images">Add After Image attachments</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="before_remarks">Add Before Remarks field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="after_remarks">Add After Remarks field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="released">Add Released by field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-placeholder" data-placeholder="approved">Add Approved by field</button>
        <button class="bg-clr-crimson rounded p-2 text-white insert-indent" data-placeholder="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">Add Indent</button>
    </div>
    <div wire:ignore>
        <textarea id="templateContent" class="w-full border rounded p-2" rows="20" placeholder="Write your letter template here..."></textarea>
    </div>
    <input type="hidden" wire:model="content" id="hiddenContent">
    <div class="flex items-center justify-end px-4 py-6">
        <div class="flex items-center gap-4">
            <x-form.cancel-link href="/artifacts-restoration">Cancel</x-form.cancel-link>
            <x-form.button wire:click="update">Save</x-form.button>
        </div>
    </div>
@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
   $(document).ready(function() {
        document.querySelector("#templateContent").value = document.querySelector("#hiddenContent").value;

        ClassicEditor
            .create(document.querySelector("#templateContent"), {
                toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'undo', 'redo'],
            })
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    let content = editor.getData();
                    document.querySelector("#hiddenContent").value = content;
                    @this.set('content', content);
                });

                document.querySelectorAll(".insert-placeholder").forEach(button => {
                    button.addEventListener("click", function () {
                        let placeholder = `"${this.getAttribute("data-placeholder")}"`;

                        editor.model.change(writer => {
                            const insertPosition = editor.model.document.selection.getFirstPosition();
                            writer.insertText(placeholder, insertPosition);
                        });

                        editor.editing.view.focus();
                    });
                });

                document.querySelectorAll(".insert-indent").forEach(button => {
                    button.addEventListener("click", function () {
                        let placeholder = this.getAttribute("data-placeholder");

                        editor.model.change(writer => {
                            const insertPosition = editor.model.document.selection.getFirstPosition();
                            writer.insertText(placeholder, insertPosition);
                        });

                        editor.editing.view.focus();
                    });
                });
            })
            .catch(error => console.error(error));
    });

</script>
@endpush

</x-admin.body>
