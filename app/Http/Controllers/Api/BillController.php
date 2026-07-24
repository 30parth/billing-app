<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bills = Bill::all();

        return response()->json([
            'success' => true,
            'message' => 'Bills retrieved successfully',
            'data' => $bills,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'bill_no' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.unit' => 'nullable|string',
            'products.*.size' => 'nullable|string',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $bill = DB::transaction(function () use ($request) {
            $total = collect($request->products)->sum('total');

            $bill = $request->user()->bills()->create([
                'date' => $request->date,
                'bill_no' => $request->bill_no,
                'customer_name' => $request->customer_name,
                'contact_number' => $request->contact_number,
                'notes' => $request->notes,
                'total' => $total,
            ]);

            foreach ($request->products as $item) {
                $bill->billProducts()->create([
                    'product_id' => $item['product_id'],
                    'unit' => $item['unit'] ?? null,
                    'size' => $item['size'] ?? null,
                    'price' => $item['price'],
                    'total' => $item['total'],
                    'user_id' => $request->user()->id,
                ]);
            }

            return $bill->load('billProducts.product');
        });

        return response()->json([
            'message' => 'Bill created',
            'data' => $bill,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $bill = $request->user()->bills()->find($id);

        if (! $bill) {
            return response()->json(['message' => 'Bill not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            'bill_no' => 'required|string|max:255',
            'customer_name' => 'required|string|max:255',
            'contact_number' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.unit' => 'nullable|string',
            'products.*.size' => 'nullable|string',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        $bill = DB::transaction(function () use ($request, $bill) {
            $total = collect($request->products)->sum('total');

            $bill->update([
                'date' => $request->date,
                'bill_no' => $request->bill_no,
                'customer_name' => $request->customer_name,
                'contact_number' => $request->contact_number,
                'notes' => $request->notes,
                'total' => $total,
            ]);

            // simplest approach: wipe old line items, recreate fresh ones
            $bill->billProducts()->delete();

            foreach ($request->products as $item) {
                $bill->billProducts()->create([
                    'product_id' => $item['product_id'],
                    'unit' => $item['unit'] ?? null,
                    'size' => $item['size'] ?? null,
                    'price' => $item['price'],
                    'total' => $item['total'],
                    'user_id' => $request->user()->id,
                ]);
            }

            return $bill->load('billProducts.product');
        });

        return response()->json([
            'message' => 'Bill updated',
            'data' => $bill,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill = Bill::find($id);

        $bill->billProducts()->delete();

        $bill->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bill deleted successfully.',
        ], 200);
    }
}
