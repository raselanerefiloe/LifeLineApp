<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Illuminate\Http\Request;
use App\Models\Product;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }
    public function adminIndex()
    {
        $stocks = Stock::all();
        return view('admin.stock.index', ['stocks' => $stocks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all products to display in the form
        $products = Product::all();

        // Return the view with the products data
        return view('admin.stock.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'pack_size' => 'required|string',
            'manufacturer' => 'required|string',
            'description' => 'required|string',
            'expiry_date' => 'nullable|date',
        ]);

        // Generate SKU with prefix
        $sku = 'SKU-' . strtoupper(uniqid()); // Example: SKU-5f3e2d1c

        // Create stock
        Stock::create([
            'product_id' => $request->product_id,
            'sku' => $sku,
            'pack_size' => $request->pack_size,
            'manufacturer' => $request->manufacturer,
            'description' => $request->manufacturer,
            'expiry_date' => $request->expiry_date,
        ]);

        return redirect()->route('admin.stock.index')->with('success', 'Stock created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
