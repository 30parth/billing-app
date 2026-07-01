@php
    $setting = $setting ?? null;
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice No: {{ $bill->bill_no }}</title>
    <style>
        body {
            @if($setting && $setting->use_gujarati_font)
                font-family: 'gujarati', sans-serif;
            @else
                font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            @endif
            font-size: 11px;
            color: #000;
            margin: 0;
            padding: 0;
        }

        .main-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #000;
        }

        .main-table td,
        .main-table th {
            border: 1px solid #000;
            padding: 4px;
            vertical-align: top;
        }

        .no-border-bottom {
            border-bottom: none !important;
        }

        .no-border-top {
            border-top: none !important;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .font-bold {
            font-weight: bold;
        }

        .bg-light-blue {
            background-color: #d9edf7;
        }

        .inner-table {
            width: 100%;
            border-collapse: collapse;
        }

        .inner-table td {
            border: none;
            padding: 3px 5px;
        }

        .products-table {
            width: 100%;
            border-collapse: collapse;
        }

        .products-table th,
        .products-table td {
            border: 1px solid #000;
            padding: 6px 4px;
            text-align: center;
        }

        .products-table th {
            background-color: #d9edf7;
            font-weight: bold;
        }

        .products-table tr.item-row td {
            border-top: none;
            border-bottom: none;
        }

        .products-table tr.last-item-row td {
            border-bottom: 1px solid #000;
        }
    </style>
</head>

<body>
    <table class="main-table">
        <!-- HEADER -->
        <tr>
            <td colspan="2" class="text-center font-bold"
                style="font-size: 20px; padding: 15px; border-bottom: 2px solid #000;">
                TAX INVOICE
            </td>
        </tr>

        <!-- INVOICE DETAILS -->
        <tr>
            <td width="50%" style="padding: 0;">
                <table class="inner-table" style="height: 100%;">
                    <tr>
                        <td width="30%">Invoice No.</td>
                        <td width="5%">:</td>
                        <td width="65%" class="font-bold">{{ $bill->bill_no }}</td>
                    </tr>
                    <tr>
                        <td>Invoice Date</td>
                        <td>:</td>
                        <td class="font-bold">{{ \Carbon\Carbon::parse($bill->date)->format('d-m-Y') }}</td>
                    </tr>
                </table>
            </td>
            <td width="50%" style="padding: 0;">
                <table class="inner-table" style="height: 100%;">
                    <!-- Placeholder for symmetry -->
                    <tr>
                        <td width="30%"></td>
                        <td width="5%"></td>
                        <td width="65%"></td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- BILLED TO -->
        <tr>
            <td width="50%" class="bg-light-blue font-bold text-center"
                style="border-bottom: 1px solid #000; padding: 6px;">
                Details of Buyer
            </td>
            <td width="50%" class="bg-light-blue font-bold text-center"
                style="border-bottom: 1px solid #000; padding: 6px;">
                Details of Seller
            </td>
        </tr>
        <tr>
            <td width="50%" style="padding: 0;">
                <table class="inner-table" style="margin-top: 5px; margin-bottom: 5px;">
                    <tr>
                        <td width="20%">Name</td>
                        <td width="5%">:</td>
                        <td width="75%" class="font-bold">{{ $bill->customer_name }}</td>
                    </tr>
                </table>
            </td>
            <td width="50%" style="padding: 0;">
                <table class="inner-table" style="margin-top: 5px; margin-bottom: 5px;">
                    <tr>
                        <td width="25%">Name</td>
                        <td width="5%">:</td>
                        <td width="70%" class="font-bold">{{ $setting->company_name ?? 'Bharat Vara' }}</td>
                    </tr>
                    @if($setting && $setting->company_address)
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td style="font-size: 10px;">{{ $setting->company_address }}</td>
                    </tr>
                    @endif
                    @if($setting && $setting->company_phone)
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td>{{ $setting->company_phone }}</td>
                    </tr>
                    @endif
                    @if($setting && $setting->company_email)
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $setting->company_email }}</td>
                    </tr>
                    @endif
                    @if($setting && $setting->company_gstin)
                    <tr>
                        <td>GSTIN</td>
                        <td>:</td>
                        <td class="font-bold">{{ $setting->company_gstin }}</td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>

        <!-- PRODUCTS -->
        <tr>
            <td colspan="2" style="padding: 0; border-bottom: none;">
                <table class="products-table" style="border: none; border-bottom: 1px solid #000;">
                    <thead>
                        <tr>
                            <th width="8%" style="border-top: none; border-left: none;">Sr. No.</th>
                            <th width="32%" style="border-top: none;">Name of product</th>
                            <th width="10%" style="border-top: none;">Unit</th>
                            <th width="15%" style="border-top: none;">Size</th>
                            <th width="15%" style="border-top: none;">Rate</th>
                            <th width="20%" style="border-top: none; border-right: none;">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bill->billProducts as $index => $item)
                            <tr class="item-row">
                                <td style="border-left: none;">{{ $index + 1 }}</td>
                                <td class="text-left font-bold">{{ $item->product->name ?? 'N/A' }}</td>
                                <td>{{ ucfirst($item->unit ?? '') }}</td>
                                <td>{{ $item->size }}</td>
                                <td class="text-right">{{ number_format($item->price, 2) }}</td>
                                <td class="text-right" style="border-right: none;">{{ number_format($item->total, 2) }}
                                </td>
                            </tr>
                        @endforeach

                        <!-- Empty row to stretch table -->
                        <tr class="item-row last-item-row">
                            <td style="border-left: none; height: 100px;"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="border-right: none;"></td>
                        </tr>

                        <!-- TOTAL ROW -->
                        <tr>
                            <th colspan="5" class="text-right font-bold" style="border-left: none;">Total Quantity:
                                {{ $bill->billProducts->count() }} &nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp; Total Invoice
                                Amount</th>
                            <th class="text-right font-bold" style="border-right: none; font-size: 14px;">
                                {{ number_format($bill->total, 2) }}</th>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>

        <!-- FOOTER: WORDS & BANK -->
        <tr>
            <td width="60%" style="padding: 0;">
                <table class="inner-table" style="height: 100%;">
                    <tr>
                        <td class="font-bold bg-light-blue text-center"
                            style="border-bottom: 1px solid #000; padding: 5px;">
                            Total Invoice Amount in words
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center font-bold" style="padding: 10px; border-bottom: 1px solid #000;">
                            {{ $bill->amount_in_words }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 5px 10px; font-size: 10px;">
                            @if($setting && $setting->bank_name)
                                <div class="font-bold" style="border-bottom: 1px solid #ddd; margin-bottom: 3px;">Bank Details:</div>
                                <div><strong>Bank:</strong> {{ $setting->bank_name }} ({{ $setting->bank_branch }})</div>
                                <div><strong>A/C No:</strong> {{ $setting->account_no }}</div>
                                <div><strong>IFSC:</strong> {{ $setting->ifsc_code }}</div>
                                <div><strong>Name:</strong> {{ $setting->account_holder }}</div>
                            @endif
                        </td>
                    </tr>
                </table>
            </td>
            <td width="40%" style="padding: 0; vertical-align: top;">
                <table class="inner-table" style="height: 100%;">
                    <tr>
                        <td width="60%" class="bg-light-blue"
                            style="border-bottom: 1px solid #000; border-right: 1px solid #000; padding: 6px;">Total
                            Amount</td>
                        <td width="40%" class="text-right font-bold"
                            style="border-bottom: 1px solid #000; padding: 6px;">{{ number_format($bill->total, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center" style="padding: 15px;">
                            <!-- QR Space -->
                            <div style="margin-bottom: 5px; font-weight: bold;">Scan to Pay</div>
                            <div
                                style="border: 2px solid #000; width: 100px; height: 100px; margin: 0 auto; overflow: hidden; padding: 2px;">
                                @if($setting && $setting->qr_code_path && file_exists(storage_path('app/public/' . $setting->qr_code_path)))
                                    <img src="{{ storage_path('app/public/' . $setting->qr_code_path) }}"
                                        width="96" height="96" style="display: block; margin: 0 auto;">
                                @else
                                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABAAQMAAACQp+OdAAAABlBMVEX///8AAABVwtN+AAAAxElEQVQoz2P4//8/A71g8gEBDa/jA/4L6BfQP0D//wI6+gD9/wP0HwjQP4B+gf//H/4P0C+go4//g4GBfAD/A/T/P8D/AfoF9P//w/8H6D9gIP+BgfwHAgT4+D/4H6BfQP//D/8H6D/QPwD0CwQEGCCeX0D//z/8H6BfQB8E6B8A+gWUBgD/H6BfQP//D/8H6D/QPwD0CwQEGCCeX0D//wP8H6BfQP//P/wfoF9ARx/QP4B+AQEGDORB9A/QP6CgDwD9D9AvgH7xHwwMBQYQfwDBi/wBAkC+AfoH6B/QP0AABgDIqNfB/z+OAAAAAElFTkSuQmCC"
                                        width="96" height="96" style="display: block; margin: 0 auto;">
                                @endif
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

        <!-- FOOTER: TERMS AND SIGNATORY -->
        {{-- <tr>
            <td width="60%" style="padding: 0;">
                <div class="font-bold" style="padding: 5px; border-bottom: 1px solid #000;">Terms And Conditions</div>
                <div style="padding: 5px; font-size: 10px; height: 80px;">
                    @if ($bill->notes)
                        {!! nl2br(e($bill->notes)) !!}
                    @else
                        1. All disputes are subject to jurisdiction.<br>
                        2. Goods once sold will not be taken back.
                    @endif
                </div>
            </td>
            <td width="40%" class="text-center"
                style="vertical-align: bottom; padding-bottom: 10px; position: relative;">
                <div class="font-bold" style="margin-bottom: 40px; margin-top: 30px;">For, Authorised Company</div>
                <div style="font-size: 11px;">Authorised Signatory</div>
            </td>
        </tr> --}}
    </table>
</body>

</html>
