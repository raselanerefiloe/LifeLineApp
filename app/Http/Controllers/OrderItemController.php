<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Redirect to the index of OrderController
        return redirect()->route('orders.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'pack_size' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Create a new order item
        OrderItem::create([
            'order_id' => $request->input('order_id'),
            'product_id' => $request->input('product_id'),
            'pack_size' => $request->input('pack_size'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        // Redirect to the index of OrderController
        return redirect()->route('orders.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderItem $orderItem)
    {
        // Redirect to the index of OrderController
        return redirect()->route('orders.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        // Validate the request
        $request->validate([
            'pack_size' => 'required|string',
            'price' => 'required|numeric|min:0',
        ]);

        // Update the order item
        $orderItem->update([
            'pack_size' => $request->input('pack_size'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('orders.index')->with('success', 'Order item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        // Delete the order item
        $orderItem->delete();

        return redirect()->route('orders.index')->with('success', 'Order item deleted successfully.');
    }}
