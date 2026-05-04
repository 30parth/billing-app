<?php

namespace App\Livewire\Forms\Product;

use App\Models\Product;
use Livewire\Form;

class ProductForm extends Form
{
    public string $name = '';

    public string $price;

    public string $description = '';

    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'description' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.min' => 'Product name must be at least 3 characters long.',
            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
        ];
    }

    public function setProduct(Product $product): void
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->description = $product->description;
    }

    public function resetForm(): void
    {
        $this->reset();
    }
}
