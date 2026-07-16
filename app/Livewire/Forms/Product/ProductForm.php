<?php

namespace App\Livewire\Forms\Product;

use App\Models\Product;
use Livewire\Form;

class ProductForm extends Form
{
    public string $name = '';

    public string $price;

    public int $tax = 0;

    public string $description = '';

    public function rules(): array
    {
        return [
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'tax' => 'required|integer|in:0,5,12,18,28',
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
            'tax.required' => 'Tax rate is required.',
            'tax.integer' => 'Tax rate must be an integer.',
            'tax.in' => 'Tax rate must be one of the predefined rates.',
        ];
    }

    public function setProduct(Product $product): void
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->price = $product->price;
        $this->tax = $product->tax ?? 0;
        $this->description = $product->description;
    }

    public function resetForm(): void
    {
        $this->reset();
    }
}
