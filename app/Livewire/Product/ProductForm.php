<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\Product\ProductForm as ProductFormModel;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductForm extends Component
{
    public ProductFormModel $form;

    public ?int $id = null;

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->id = $id;
            $product = Product::where('user_id', Auth::user()->id)->findOrFail($id);
            $this->form->setProduct($product);
        }
    }

    public function save(): void
    {
        $data = $this->form->validate();

        if ($this->id) {
            Product::where('user_id', Auth::user()->id)->findOrFail($this->id)->update($data);
        } else {
            Product::create($data);
        }

        $this->redirectRoute('product.list', navigate: true);
    }

    public function backToListView()
    {
        return $this->redirectRoute('product.list', navigate: true);
    }

    public function render()
    {
        return view('livewire.product.product-form');
    }
}
