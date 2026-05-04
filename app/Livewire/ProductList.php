<?php

namespace App\Livewire;

use Livewire\Component;

class ProductList extends Component
{
    public $title = 'Product List';

    public function render()
    {
        return view('livewire.product-list');
    }
}
