<?php

namespace App\View\Components\Dropdown;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaxDropdown extends Component
{
    public array $taxRates = [
        ['id' => 0, 'name' => '0%'],
        ['id' => 5, 'name' => '5%'],
        ['id' => 12, 'name' => '12%'],
        ['id' => 18, 'name' => '18%'],
        ['id' => 28, 'name' => '28%'],
    ];

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropdown.tax-dropdown');
    }
}
