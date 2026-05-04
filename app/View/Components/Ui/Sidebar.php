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
                'label' => 'Products',
                'url' => 'product',
                'icon' => 'ui.icon.product',
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
