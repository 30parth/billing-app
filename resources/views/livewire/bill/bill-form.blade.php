<div class="p-4">
    <x-ui.card title="Bill">
        <form wire:submit="save">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <x-ui.form.input-with-label type="date" label="Date" name="form.date" />
                <x-ui.form.input-with-label label="Bill No" name="form.bill_no" />
                <x-ui.form.input-with-label label="Customer Name" name="form.customer_name" />
                <x-ui.form.input-with-label label="Contact Number" name="form.contact_number" />
            </div>
            <div class="mt-4">
                <x-ui.form.input-with-label label="Notes" name="form.notes" />
            </div>
            <div class="mt-4">
                <x-ui.table>
                    <x-ui.table.head>
                        <x-ui.table.row>
                            <x-ui.table.th>Product</x-ui.table.th>
                            <x-ui.table.th>Unit</x-ui.table.th>
                            <x-ui.table.th>Size</x-ui.table.th>
                            <x-ui.table.th>Price</x-ui.table.th>
                            <x-ui.table.th>Total</x-ui.table.th>
                            <x-ui.table.th>Actions</x-ui.table.th>
                        </x-ui.table.row>
                    </x-ui.table.head>
                    <x-ui.table.body>
                        @foreach ($form->products as $index => $product)
                            <x-ui.table.row>
                                <x-ui.table.td>
                                    <x-dropdown.product-dropdown name="form.products.{{ $index }}.product_id"
                                        disabled no-label />
                                </x-ui.table.td>
                                <x-ui.table.td>
                                    <x-dropdown.unit-dropdown name="form.products.{{ $index }}.unit" disabled
                                        no-label />
                                </x-ui.table.td>
                                <x-ui.table.td>
                                    <x-ui.form.input-with-label label="Size"
                                        name="form.products.{{ $index }}.size" no-label is-live />
                                </x-ui.table.td>
                                <x-ui.table.td>
                                    <x-ui.form.input-with-label type="number" label="Price"
                                        name="form.products.{{ $index }}.price" no-label is-live />
                                </x-ui.table.td>
                                <x-ui.table.td>
                                    <x-ui.form.input-with-label label="Total"
                                        name="form.products.{{ $index }}.total" no-label disabled />
                                </x-ui.table.td>
                                <x-ui.table.td>
                                    <div wire:click="removeProduct({{ $index }})" class="cursor-pointer">
                                        <x-ui.icon.trash />
                                    </div>
                                </x-ui.table.td>
                            </x-ui.table.row>
                        @endforeach
                        <x-ui.table.row>
                            <x-ui.table.td>
                                <x-dropdown.product-dropdown name="form.product.product_id" is-live no-label />
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <x-dropdown.unit-dropdown name="form.product.unit" is-live no-label />
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <x-ui.form.input-with-label label="Size" name="form.product.size" is-blur no-label />
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <x-ui.form.input-with-label type="number" label="Price" name="form.product.price"
                                    is-blur no-label />
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <x-ui.form.input-with-label label="Total" name="form.product.total" no-label
                                    disabled />
                            </x-ui.table.td>
                            <x-ui.table.td>
                                <x-ui.button wire:click="addProduct" class="cursor-pointer">
                                    <x-ui.icon.plus />
                                </x-ui.button>
                            </x-ui.table.td>
                        </x-ui.table.row>
                    </x-ui.table.body>
                </x-ui.table>
            </div>
            <div class="mt-6 flex justify-between">
                <div class="flex gap-2">
                    <x-ui.button variant="secondary" wire:click="backToListView">Cancel</x-ui.button>
                </div>
                <x-ui.button type="submit">Save</x-ui.button>
            </div>
        </form>
    </x-ui.card>
</div>
