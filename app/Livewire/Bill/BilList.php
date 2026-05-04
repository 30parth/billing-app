<?php

namespace App\Livewire\Bill;

use App\Models\Bill;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class BilList extends Component
{
    use WithoutUrlPagination;
    use WithPagination;

    public $search = '';

    public function addBill()
    {
        return $this->redirectRoute('bill.add', navigate: true);
    }

    public function edit($id)
    {
        return $this->redirectRoute('bill.edit', $id, navigate: true);
    }

    public function delete($id)
    {
        $bill = Bill::find($id);
        $bill->billProducts()->delete();
        $bill->delete();

        return $this->redirectRoute('bill.list', navigate: true);
    }

    public function render()
    {
        $bills = Bill::where('customer_name', 'like', "%{$this->search}%")
            ->orWhere('bill_no', 'like', "%{$this->search}%")
            ->orWhere('date', 'like', "%{$this->search}%")
            ->orWhere('notes', 'like', "%{$this->search}%")
            ->orWhere('total', 'like', "%{$this->search}%")
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('livewire.bill.bil-list', compact('bills'));
    }
}
