<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class ProductList extends Component
{
    use WithoutUrlPagination;
    use WithPagination;

    public $search = '';

    public function addProduct()
    {
        $this->redirectRoute('product.add', navigate: true);
    }

    public function edit($id)
    {
        $this->redirectRoute('product.edit', $id, navigate: true);
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
    }

    public function render()
    {
        $products = Product::where('name', 'like', "%$this->search%")
            ->orWhere('price', 'like', "%$this->search%")
            ->orWhere('description', 'like', "%$this->search%")
            ->orderBy('name', 'asc')->paginate(10);

        return view('livewire.product.product-list', compact('products'));
    }
}
