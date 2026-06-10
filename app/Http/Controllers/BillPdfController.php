<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Mpdf\Mpdf;

class BillPdfController extends Controller
{
    public function generate($id)
    {
        $bill = Bill::where('user_id', Auth::user()->id)->with('billProducts.product')->findOrFail($id);

        $html = view('pdf.bill', compact('bill'))->render();

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
        ]);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Bill_'.$bill->bill_no.'.pdf', 'I'), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
