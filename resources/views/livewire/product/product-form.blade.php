<div class="p-4">
    <x-ui.card title="Product Form">
        <form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <x-ui.form.input-with-label name="form.name" label="Product Name" placeholder="Product Name" />
                <x-ui.form.input-with-label name="form.price" label="Price" placeholder="Product Price" />
            </div>
            <x-ui.form.input-with-label name="form.description" label="Description" placeholder="Product Description" />
            <div class="mt-6 flex justify-between">
                <x-ui.button variant="secondary" wire:click="backToListView">Cancel</x-ui.button>
                <x-ui.button type="submit">Save</x-ui.button>
            </div>
        </form>
    </x-ui.card>
</div>
