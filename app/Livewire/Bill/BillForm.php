<?php

namespace App\Livewire\Bill;

use App\Livewire\Forms\Bill\BillForm as Form;
use App\Models\Bill;
use App\Models\BillProduct;
use App\Models\BillSeries;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class BillForm extends Component
{
    public Form $form;

    public $id = null;

    public function mount($id = null)
    {
        $this->form->date = Carbon::today()->format('Y-m-d');
        if ($id) {
            $this->id = $id;
            $bill = Bill::where('user_id', Auth::user()->id)->findOrFail($id);
            $this->form->setBill($bill);
        } else {
            $series = BillSeries::firstOrCreate(
                ['user_id' => Auth::user()->id],
                ['prefix' => 'B_', 'current' => 0]
            );
            $this->form->bill_no = $series->prefix.($series->current + 1);
        }
    }

    public function addProduct()
    {
        $this->form->validate([
            'product.product_id' => 'required',
            'product.unit' => 'required|in:feet,inch',
            'product.size' => ['required', 'regex:/^\d+(\.\d+)?(x\d+(\.\d+)?)?$/'],
            'product.price' => 'required|numeric|min:1',
        ], [
            'product.size.regex' => 'Size must be a number or in numberxnumber format (e.g., 5 or 5x5.5)',
        ]);

        $this->form->products[] = $this->form->product;

        $this->form->calculateTotal();

        $this->form->product = [
            'product_id' => '',
            'unit' => 'feet',
            'size' => '',
            'price' => '',
            'total' => '',
        ];
    }

    public function removeProduct($index)
    {
        unset($this->form->products[$index]);
    }

    public function updatedFormProductProductId()
    {
        $product = Product::where('user_id', Auth::user()->id)->findOrFail($this->form->product['product_id']);
        $this->form->product['price'] = $product->price;
    }

    public function updatedFormProductUnit()
    {
        $this->updatedFormProductSize();
        $this->updatedFormProductPrice();
    }

    public function updatedFormProductSize()
    {
        if ($this->form->product['size']) {
            $total_size = 1;
            $size = explode('x', $this->form->product['size']);
            foreach ($size as $s) {
                if ($this->form->product['unit'] == 'inch') {
                    $total_size *= (float) $s / 12;
                } else {
                    $total_size *= (float) $s;
                }
            }
            $this->form->product['total'] = (float) ($this->form->product['price'] ?? 0) * $total_size;
        }
    }

    public function updatedFormProductPrice()
    {
        if ($this->form->product['price']) {
            $total_size = 1;
            $size = explode('x', $this->form->product['size'] ?? '0');
            foreach ($size as $s) {
                if ($this->form->product['unit'] == 'inch') {
                    $total_size *= (float) $s / 12;
                } else {
                    $total_size *= (float) $s;
                }
            }
            $this->form->product['total'] = (float) ($this->form->product['price'] ?? 0) * $total_size;
        }
    }

    public function save()
    {
        $this->form->validate();

        $this->form->total = collect($this->form->products)->sum('total');

        if ($this->id) {
            $bill = Bill::where('user_id', Auth::user()->id)->findOrFail($this->id);
            $bill->update([
                'date' => $this->form->date,
                'bill_no' => $this->form->bill_no,
                'customer_name' => $this->form->customer_name,
                'contact_number' => $this->form->contact_number,
                'notes' => $this->form->notes,
                'total' => $this->form->total,
            ]);
            BillProduct::where('bill_id', $this->id)->delete();
        } else {

            $bill = Bill::create([
                'date' => $this->form->date,
                'bill_no' => $this->form->bill_no,
                'customer_name' => $this->form->customer_name,
                'contact_number' => $this->form->contact_number,
                'notes' => $this->form->notes,
                'total' => $this->form->total,
            ]);

            $series = BillSeries::firstOrCreate(
                ['user_id' => Auth::user()->id],
                ['prefix' => 'B_', 'current' => 0]
            );
            $series->increment('current');
        }

        foreach ($this->form->products as $product) {
            BillProduct::create([
                'bill_id' => $bill->id,
                'product_id' => $product['product_id'],
                'unit' => $product['unit'],
                'size' => $product['size'],
                'price' => $product['price'],
                'total' => $product['total'],
            ]);
        }
        $this->redirectRoute('bill.list', navigate: true);
    }

    public function backToListView()
    {
        return $this->redirectRoute('bill.list', navigate: true);
    }

    public function render()
    {
        return view('livewire.bill.bill-form');
    }
}
