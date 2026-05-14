<div class="p-6 space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-heading">Dashboard Overview</h1>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Revenue Card -->
        <x-ui.card title="Total Revenue">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-14 h-14 bg-brand-soft text-brand-strong rounded-xl">
                    <x-ui.icon.bill class="w-8 h-8" />
                </div>
                <h3 class="text-3xl font-bold text-heading">₹{{ number_format($totalRevenue, 2) }}</h3>
            </div>
        </x-ui.card>

        <!-- Bills Card -->
        <x-ui.card title="Total Bills">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-14 h-14 bg-brand-soft text-brand-strong rounded-xl">
                    <x-ui.icon.calender class="w-8 h-8" />
                </div>
                <h3 class="text-3xl font-bold text-heading">{{ $totalBills }}</h3>
            </div>
        </x-ui.card>

        <!-- Products Card -->
        <x-ui.card title="Total Products">
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-14 h-14 bg-brand-soft text-brand-strong rounded-xl">
                    <x-ui.icon.product class="w-8 h-8" />
                </div>
                <h3 class="text-3xl font-bold text-heading">{{ $totalProducts }}</h3>
            </div>
        </x-ui.card>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions (Direct Access) -->
        <div class="lg:col-span-1">
            <x-ui.card title="Quick Access">
                <div class="space-y-4">
                    <a href="{{ route('bill.add') }}" wire:navigate class="flex items-center p-3 bg-neutral-secondary-soft border border-default rounded-base hover:bg-neutral-secondary-medium transition-all group">
                        <div class="flex items-center justify-center w-10 h-10 bg-brand-soft text-brand-strong rounded-lg">
                            <x-ui.icon.plus class="w-5 h-5" />
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-heading">Create New Bill</p>
                            <p class="text-xs text-body">Generate a new invoice</p>
                        </div>
                        <x-ui.icon.arrow-right class="w-5 h-5 ml-auto text-body group-hover:text-heading transition-colors" />
                    </a>

                    <a href="{{ route('product.add') }}" wire:navigate class="flex items-center p-3 bg-neutral-secondary-soft border border-default rounded-base hover:bg-neutral-secondary-medium transition-all group">
                        <div class="flex items-center justify-center w-10 h-10 bg-brand-soft text-brand-strong rounded-lg">
                            <x-ui.icon.plus class="w-5 h-5" />
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-heading">Add New Product</p>
                            <p class="text-xs text-body">Add items to inventory</p>
                        </div>
                        <x-ui.icon.arrow-right class="w-5 h-5 ml-auto text-body group-hover:text-heading transition-colors" />
                    </a>

                    <a href="{{ route('bill.list') }}" wire:navigate class="flex items-center p-3 bg-neutral-secondary-soft border border-default rounded-base hover:bg-neutral-secondary-medium transition-all group">
                        <div class="flex items-center justify-center w-10 h-10 bg-brand-soft text-brand-strong rounded-lg">
                            <x-ui.icon.table class="w-5 h-5" />
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-heading">View All Bills</p>
                            <p class="text-xs text-body">Manage your invoices</p>
                        </div>
                        <x-ui.icon.arrow-right class="w-5 h-5 ml-auto text-body group-hover:text-heading transition-colors" />
                    </a>
                    
                    <a href="{{ route('product.list') }}" wire:navigate class="flex items-center p-3 bg-neutral-secondary-soft border border-default rounded-base hover:bg-neutral-secondary-medium transition-all group">
                        <div class="flex items-center justify-center w-10 h-10 bg-brand-soft text-brand-strong rounded-lg">
                            <x-ui.icon.product class="w-5 h-5" />
                        </div>
                        <div class="ml-4">
                            <p class="font-semibold text-heading">Manage Products</p>
                            <p class="text-xs text-body">View and edit inventory</p>
                        </div>
                        <x-ui.icon.arrow-right class="w-5 h-5 ml-auto text-body group-hover:text-heading transition-colors" />
                    </a>
                </div>
            </x-ui.card>
        </div>

        <!-- Recent Bills -->
        <div class="lg:col-span-2">
            <x-ui.card title="Recent Bills">
                @if($recentBills->count() > 0)
                    <div class="mt-4">
                        <x-ui.table>
                            <x-ui.table.head>
                                <tr>
                                    <x-ui.table.th>Bill No</x-ui.table.th>
                                    <x-ui.table.th>Date</x-ui.table.th>
                                    <x-ui.table.th>Customer</x-ui.table.th>
                                    <x-ui.table.th class="text-right">Amount</x-ui.table.th>
                                </tr>
                            </x-ui.table.head>
                            <x-ui.table.body>
                                @foreach($recentBills as $bill)
                                    <x-ui.table.row>
                                        <x-ui.table.td>
                                            <a href="{{ route('bill.edit', $bill->id) }}" wire:navigate class="font-semibold text-brand hover:underline">
                                                {{ $bill->bill_no }}
                                            </a>
                                        </x-ui.table.td>
                                        <x-ui.table.td>{{ \Carbon\Carbon::parse($bill->date)->format('d M, Y') }}</x-ui.table.td>
                                        <x-ui.table.td>{{ $bill->customer_name }}</x-ui.table.td>
                                        <x-ui.table.td class="text-right font-bold text-heading">₹{{ number_format($bill->total, 2) }}</x-ui.table.td>
                                    </x-ui.table.row>
                                @endforeach
                            </x-ui.table.body>
                        </x-ui.table>
                        
                        <div class="mt-4 text-right">
                            <a href="{{ route('bill.list') }}" wire:navigate class="text-sm font-medium text-brand hover:underline">
                                View All Bills &rarr;
                            </a>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-10 text-body">
                        <x-ui.icon.bill class="w-12 h-12 text-body mb-2 opacity-50" />
                        <p>No bills generated yet.</p>
                    </div>
                @endif
            </x-ui.card>
        </div>
    </div>
</div>
