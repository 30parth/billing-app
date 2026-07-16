<?php

namespace App\Livewire\Product;

use App\Livewire\Forms\Product\ProductForm as ProductFormModel;
use App\Models\Product;
use Livewire\Component;

class ProductForm extends Component
{
    public ProductFormModel $form;

    public ?int $id = null;

    public function mount(?int $id = null): void
    {
        if ($id) {
            $this->id = $id;
            $product = Product::findOrFail($id);
            $this->form->setProduct($product);
        }
    }

    public function save(): void
    {
        $data = $this->form->validate();

        if ($this->id) {
            Product::findOrFail($this->id)->update($data);
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
        $taxRates = [
            ['id' => 0, 'name' => '0%'],
            ['id' => 5, 'name' => '5%'],
            ['id' => 12, 'name' => '12%'],
            ['id' => 18, 'name' => '18%'],
            ['id' => 28, 'name' => '28%'],
        ];

        return view('livewire.product.product-form', compact('taxRates'));
    }
}
