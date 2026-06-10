<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Mpdf\Mpdf;

class BilList extends Component
{
    use WithoutUrlPagination;
    use WithPagination;

    public $search = '';

    public function addBill()
    {
        return $this->redirectRoute('bill.add', navigate: true);
    }

    public function edit($id)
    {
        return $this->redirectRoute('bill.edit', $id, navigate: true);
    }

    public function delete($id)
    {
        $bill = Bill::where('user_id', Auth::user()->id)->findOrFail($id);
        $bill->billProducts()->delete();
        $bill->delete();

        return $this->redirectRoute('bill.list', navigate: true);
    }

    public function downloadBill($id)
    {
        // 1. Fetch bill with relationships
        $bill = Bill::where('user_id', Auth::user()->id)->with('billProducts.product')->findOrFail($id);

        $setting = Auth::user()->setting;

        // 2. Render the template we created earlier
        $html = view('pdf.bill', compact('bill', 'setting'))->render();

        // 3. Initialize mPDF
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

        // if ($setting && $setting->use_gujarati_font && $setting->font_path && file_exists(storage_path('app/public/' . $setting->font_path))) {
        //     $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
        //     $fontDirs = $defaultConfig['fontDir'];

        //     $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
        //     $fontData = $defaultFontConfig['fontdata'];

        //     $mpdfConfig['fontDir'] = array_merge($fontDirs, [
        //         storage_path('app/public/' . dirname($setting->font_path))
        //     ]);
        //     $mpdfConfig['fontdata'] = $fontData + [
        //         'gujarati' => [
        //             'R' => basename($setting->font_path),
        //             'useOTL' => 0xFF,
        //         ]
        //     ];
        // }

        $mpdf = new Mpdf($mpdfConfig);

        $mpdf->WriteHTML($html);

        // 4. Stream PDF using Livewire's built-in file download handling
        return response()->streamDownload(function () use ($mpdf) {
            echo $mpdf->Output('', 'S'); // 'S' returns PDF as string
        }, 'Bill_'.$bill->bill_no.'.pdf');
    }

    public function render()
    {
        $bills = Bill::where('user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('customer_name', 'like', "%{$this->search}%")
                    ->orWhere('bill_no', 'like', "%{$this->search}%")
                    ->orWhere('date', 'like', "%{$this->search}%")
                    ->orWhere('notes', 'like', "%{$this->search}%")
                    ->orWhere('total', 'like', "%{$this->search}%");
            })
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('livewire.bill.bil-list', compact('bills'));
    }
}
