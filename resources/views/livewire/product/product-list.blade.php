<div class="p-4">
    <div class="w-full">
        <div class="flex flex-col items-center justify-between space-y-3 md:flex-row">
            <x-common.search-filter />
            <div class="flex flex-col justify-end w-full md:flex-row">
                <x-ui.button wire:click="addProduct">
                    Add Product
                </x-ui.button>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <x-ui.table>
            <x-ui.table.head>
                <tr>
                    <x-ui.table.th>Sr No</x-ui.table.th>
                    <x-ui.table.th>Product Name</x-ui.table.th>
                    <x-ui.table.th>Price</x-ui.table.th>
                    <x-ui.table.th>Description</x-ui.table.th>
                    <x-ui.table.th class="text-between">Action</x-ui.table.th>
                </tr>
            </x-ui.table.head>
            <x-ui.table.body>
                @foreach ($products as $index => $product)
                    <x-ui.table.row wire:key="{{ $product->id }}">
                        <x-ui.table.td>{{ $index + 1 }}</x-ui.table.td>
                        <x-ui.table.td>{{ $product->name }}</x-ui.table.td>
                        <x-ui.table.td>{{ $product->price }}</x-ui.table.td>
                        <x-ui.table.td>{{ $product->description }}</x-ui.table.td>
                        <x-ui.table.td>
                            <x-common.action-button id="{{ $product->id }}" modalId="product-form-modal" />
                        </x-ui.table.td>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table.body>
        </x-ui.table>

        {{ $products->links() }}
    </div>
</div>
