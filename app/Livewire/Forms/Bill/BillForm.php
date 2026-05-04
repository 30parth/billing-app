<?php

namespace App\Livewire\Forms\Bill;

use App\Models\Bill;
use Livewire\Form;

class BillForm extends Form
{
    public $date;

    public $bill_no;

    public $customer_name;

    public $notes;

    public $total;

    public $products = [];

    public $product = [
        'product_id' => '',
        'size' => '',
        'price' => '',
        'total' => '',
    ];

    public function rules()
    {
        return [
            'date' => 'required',
            'bill_no' => 'required',
            'customer_name' => 'required',
            'total' => 'required',
            'products' => 'required',
            'products.*.product_id' => 'required',
            'products.*.size' => ['required', 'regex:/^\d+(\.\d+)?(x\d+(\.\d+)?)?$/'],
            'products.*.price' => 'required|numeric|min:1',
            'products.*.total' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => 'Date is required',
            'bill_no.required' => 'Bill No is required',
            'customer_name.required' => 'Customer Name is required',
            'notes.nullable' => 'Notes is optional',
            'total.required' => 'Total is required',
            'products.required' => 'Products is required',
            'products.*.product_id.required' => 'Product is required',
            'products.*.size.required' => 'Size is required',
            'products.*.size.regex' => 'Size must be a number or in numberxnumber format (e.g., 5 or 5x5.5)',
            'products.*.price.required' => 'Price is required',
            'products.*.total.required' => 'Total is required',
            'products.*.price.numeric' => 'Price must be a number',
            'products.*.total.numeric' => 'Total must be a number',
            'products.*.price.min' => 'Price must be at least 1',
        ];
    }

    public function setBill(Bill $bill)
    {
        $this->date = $bill->date;
        $this->bill_no = $bill->bill_no;
        $this->customer_name = $bill->customer_name;
        $this->notes = $bill->notes;
        $this->total = $bill->total;
        $this->products = $bill->billProducts->toArray();
    }

    public function calculateTotal()
    {
        $this->total = collect($this->products)->sum('total');
    }

    public function updatedProducts($value, $key)
    {
        $key = explode('.', $key);

        $product = $this->products[$key[0]];

        if ($key[1] == 'size') {
            $size = explode('x', $value);
            $total_size = 1;
            foreach ($size as $s) {
                $total_size *= (float) $s;
            }
            $product['total'] = (float) $product['price'] * $total_size;
        }

        if ($key[1] == 'price') {
            $size = explode('x', $product['size']);
            $total_size = 1;
            foreach ($size as $s) {
                $total_size *= (float) $s;
            }
            $product['total'] = (float) $value * $total_size;
        }

        $this->products[$key[0]] = $product;

        $this->calculateTotal();

    }
}
