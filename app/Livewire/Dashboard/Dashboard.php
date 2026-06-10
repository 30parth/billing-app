<?php

namespace App\Livewire\Dashboard;

use App\Models\Bill;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $userId = Auth::user()->id;
        $totalBills = Bill::where('user_id', $userId)->count();
        $totalRevenue = Bill::where('user_id', $userId)->sum('total');
        $totalProducts = Product::where('user_id', $userId)->count();
        $recentBills = Bill::where('user_id', $userId)->orderBy('date', 'desc')->take(5)->get();

        return view('livewire.dashboard.dashboard', [
            'totalBills' => $totalBills,
            'totalRevenue' => $totalRevenue,
            'totalProducts' => $totalProducts,
            'recentBills' => $recentBills,
        ]);
    }
}
