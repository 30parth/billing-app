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

        $setting = Auth::user()->setting;

        $html = view('pdf.bill', compact('bill', 'setting'))->render();

        $mpdfConfig = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'tempDir' => storage_path('app/mpdf'),
        ];

        if ($setting && $setting->use_gujarati_font && $setting->font_path && file_exists(storage_path('app/public/' . $setting->font_path))) {
            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];

            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];

            $mpdfConfig['fontDir'] = array_merge($fontDirs, [
                storage_path('app/public/' . dirname($setting->font_path))
            ]);
            $mpdfConfig['fontdata'] = $fontData + [
                'gujarati' => [
                    'R' => basename($setting->font_path),
                    'useOTL' => 0xFF,
                ]
            ];
        }

        $mpdf = new Mpdf($mpdfConfig);

        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Bill_'.$bill->bill_no.'.pdf', 'I'), 200)
            ->header('Content-Type', 'application/pdf');
    }

    public function publicPreview($token)
    {
        $bill = Bill::where('secure_token', $token)->with('billProducts.product')->firstOrFail();
        $setting = \App\Models\Setting::where('user_id', $bill->user_id)->first();
        
        $downloadUrl = route('bill.public.download', ['token' => $bill->secure_token]);

        return view('bill.public-preview', compact('bill', 'setting', 'downloadUrl'));
    }

    public function publicDownload($token)
    {
        $bill = Bill::where('secure_token', $token)->with('billProducts.product')->firstOrFail();
        $setting = \App\Models\Setting::where('user_id', $bill->user_id)->first();

        $html = view('pdf.bill', compact('bill', 'setting'))->render();

        $mpdfConfig = [
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'tempDir' => storage_path('app/mpdf'),
        ];

        if ($setting && $setting->use_gujarati_font && $setting->font_path && file_exists(storage_path('app/public/' . $setting->font_path))) {
            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];

            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];

            $mpdfConfig['fontDir'] = array_merge($fontDirs, [
                storage_path('app/public/' . dirname($setting->font_path))
            ]);
            $mpdfConfig['fontdata'] = $fontData + [
                'gujarati' => [
                    'R' => basename($setting->font_path),
                    'useOTL' => 0xFF,
                ]
            ];
        }

        $mpdf = new Mpdf($mpdfConfig);
        $mpdf->WriteHTML($html);

        return response($mpdf->Output('Bill_'.$bill->bill_no.'.pdf', 'I'), 200)
            ->header('Content-Type', 'application/pdf');
    }
}
