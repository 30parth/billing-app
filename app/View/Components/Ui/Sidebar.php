<?php

namespace App\View\Components\Ui;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public array $menuItems = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {

        $this->menuItems = [
            [
                'label' => 'Dashboard',
                'url' => 'dashboard',
                'icon' => 'ui.icon.dashboard',
            ],
            [
                'label' => 'Products',
                'url' => 'product.list',
                'icon' => 'ui.icon.product',
            ],
            [
                'label' => 'Bill',
                'url' => 'bill.list',
                'icon' => 'ui.icon.bill',
            ],
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.sidebar');
    }
}
