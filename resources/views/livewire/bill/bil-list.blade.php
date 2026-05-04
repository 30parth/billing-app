<div class="p-4">
    <div class="w-full">
        <div class="flex flex-col items-center justify-between space-y-3 md:flex-row">
            <x-common.search-filter />
            <div class="flex flex-col justify-end w-full md:flex-row">
                <x-ui.button wire:click="addBill">
                    Add Bill
                </x-ui.button>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <x-ui.table>
            <x-ui.table.head>
                <tr>
                    <x-ui.table.th>Sr No</x-ui.table.th>
                    <x-ui.table.th>Date</x-ui.table.th>
                    <x-ui.table.th>Bill No</x-ui.table.th>
                    <x-ui.table.th>Customer Name</x-ui.table.th>
                    <x-ui.table.th>Notes</x-ui.table.th>
                    <x-ui.table.th>Total</x-ui.table.th>
                    <x-ui.table.th class="text-between">Action</x-ui.table.th>
                </tr>
            </x-ui.table.head>
            <x-ui.table.body>
                @foreach ($bills as $index => $bill)
                    <x-ui.table.row wire:key="{{ $bill->id }}">
                        <x-ui.table.td>{{ $index + 1 }}</x-ui.table.td>
                        <x-ui.table.td>{{ $bill->date }}</x-ui.table.td>
                        <x-ui.table.td>{{ $bill->bill_no }}</x-ui.table.td>
                        <x-ui.table.td>{{ $bill->customer_name }}</x-ui.table.td>
                        <x-ui.table.td>{{ $bill->notes }}</x-ui.table.td>
                        <x-ui.table.td>{{ $bill->total }}</x-ui.table.td>
                        <x-ui.table.td>
                            <x-common.action-button id="{{ $bill->id }}" modalId="product-form-modal">
                                <div class="cursor-pointer" wire:click="downloadBill('{{ $bill->id }}')">
                                    <x-ui.icon.printer />
                                </div>
                            </x-common.action-button>
                        </x-ui.table.td>
                    </x-ui.table.row>
                @endforeach
            </x-ui.table.body>
        </x-ui.table>

        {{ $bills->links() }}
    </div>
</div>
