<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $bill->bill_no }}</title>
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased min-h-screen py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <!-- Back link / branding header -->
        <div class="flex justify-between items-center mb-6">
            <span class="text-lg font-bold text-slate-900 tracking-tight">Invoice System</span>
            <a href="{{ $downloadUrl }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white bg-green-600 hover:bg-green-700 transition rounded-lg shadow-sm">
                <!-- SVG Download Icon -->
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                Download PDF
            </a>
        </div>

        <!-- Main Invoice Card -->
        <div class="bg-white rounded-2xl shadow-md border border-slate-100 p-8 md:p-12 mb-8">
            <!-- Header Block -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-8 border-b border-slate-100 gap-6">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">{{ $setting->company_name ?? 'Bharat Vara' }}</h1>
                    @if($setting && $setting->company_address)
                        <p class="text-sm text-slate-500 mt-1 max-w-sm whitespace-pre-line">{{ $setting->company_address }}</p>
                    @endif
                    @if($setting && $setting->company_phone)
                        <p class="text-sm text-slate-500 mt-1">Phone: {{ $setting->company_phone }}</p>
                    @endif
                </div>
                <div class="text-left md:text-right">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 mb-2">Paid</span>
                    <h2 class="text-xl font-bold text-slate-900">INVOICE</h2>
                    <p class="text-sm text-slate-500 mt-1">No: <span class="font-semibold text-slate-700">{{ $bill->bill_no }}</span></p>
                    <p class="text-sm text-slate-500">Date: <span class="font-semibold text-slate-700">{{ \Carbon\Carbon::parse($bill->date)->format('d-m-Y') }}</span></p>
                </div>
            </div>

            <!-- Details Block -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 py-8 border-b border-slate-100">
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Billed To</h3>
                    <p class="text-base font-bold text-slate-900">{{ $bill->customer_name }}</p>
                    @if($bill->contact_number)
                        <p class="text-sm text-slate-500 mt-1">Contact: {{ $bill->contact_number }}</p>
                    @endif
                </div>
                @if($setting && ($setting->bank_name || $setting->qr_code_path))
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">Payment Details</h3>
                    @if($setting->bank_name)
                        <p class="text-sm text-slate-600"><span class="font-semibold">Bank:</span> {{ $setting->bank_name }}</p>
                        <p class="text-sm text-slate-600"><span class="font-semibold">A/C:</span> {{ $setting->account_no }}</p>
                        <p class="text-sm text-slate-600"><span class="font-semibold">IFSC:</span> {{ $setting->ifsc_code }}</p>
                    @endif
                </div>
                @endif
            </div>

            <!-- Table Block -->
            <div class="py-8">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-slate-200">
                                <th class="py-3 px-1 text-sm font-bold text-slate-400 uppercase tracking-wider w-12 text-center">#</th>
                                <th class="py-3 px-4 text-sm font-bold text-slate-400 uppercase tracking-wider">Product</th>
                                <th class="py-3 px-2 text-sm font-bold text-slate-400 uppercase tracking-wider text-center w-24">Unit</th>
                                <th class="py-3 px-4 text-sm font-bold text-slate-400 uppercase tracking-wider text-center w-24">Size</th>
                                <th class="py-3 px-4 text-sm font-bold text-slate-400 uppercase tracking-wider text-right w-32">Rate (Rs)</th>
                                <th class="py-3 px-4 text-sm font-bold text-slate-400 uppercase tracking-wider text-right w-32">Total (Rs)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bill->billProducts as $index => $product)
                            <tr class="border-b border-slate-100 hover:bg-slate-50/50 transition">
                                <td class="py-4 px-1 text-slate-500 text-center text-sm font-medium">{{ $index + 1 }}</td>
                                <td class="py-4 px-4 font-semibold text-slate-900 text-sm md:text-base">{{ $product->product->name }}</td>
                                <td class="py-4 px-2 text-slate-500 text-center text-sm capitalize">{{ $product->unit }}</td>
                                <td class="py-4 px-4 text-slate-700 text-center text-sm">{{ $product->size }}</td>
                                <td class="py-4 px-4 text-slate-700 text-right text-sm">{{ number_format($product->price, 2) }}</td>
                                <td class="py-4 px-4 font-semibold text-slate-900 text-right text-sm">{{ number_format($product->total, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Grand Total Block -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center py-6 px-8 bg-slate-50 rounded-xl gap-4">
                <div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Amount in Words</span>
                    <p class="text-sm font-medium text-slate-700 mt-1 capitalize">{{ $bill->amount_in_words }}</p>
                </div>
                <div class="text-left md:text-right min-w-[200px]">
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Grand Total</span>
                    <p class="text-3xl font-black text-slate-900 mt-1">Rs. {{ number_format($bill->total, 2) }}</p>
                </div>
            </div>

            @if($bill->notes)
            <div class="mt-8 pt-8 border-t border-slate-100">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Notes</span>
                <p class="text-sm text-slate-600 mt-1 whitespace-pre-line">{{ $bill->notes }}</p>
            </div>
            @endif
        </div>

        <!-- Footer -->
        <div class="text-center text-xs text-slate-400">
            <p>Thank you for your business!</p>
        </div>
    </div>
</body>
</html>
