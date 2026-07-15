<?php

namespace App\Livewire\Dashboard;

use App\Models\Bill;
use App\Models\Product;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalBills = Bill::count();
        $totalRevenue = Bill::sum('total');
        $totalProducts = Product::count();
        $recentBills = Bill::orderBy('date', 'desc')->take(5)->get();

        return view('livewire.dashboard.dashboard', [
            'totalBills' => $totalBills,
            'totalRevenue' => $totalRevenue,
            'totalProducts' => $totalProducts,
            'recentBills' => $recentBills,
        ]);
    }
}
