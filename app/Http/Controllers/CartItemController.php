<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Redirect to the index of CartController
        return redirect()->route('carts.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cart_items.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if the cart belongs to the authenticated user
        $cart = Cart::findOrFail($request->input('cart_id'));
        if ($cart->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        // Create a new cart item
        CartItem::create([
            'cart_id' => $request->input('cart_id'),
            'product_id' => $request->input('product_id'),
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('cart_items.index')->with('success', 'Cart item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartItem)
    {
        // Redirect to the index of CartController
        return redirect()->route('carts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CartItem $cartItem)
    {
        // Redirect to the index of CartController
        return redirect()->route('carts.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        // Ensure the cart item belongs to the authenticated user's cart
        if ($cartItem->cart->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Update the cart item
        $cartItem->update([
            'quantity' => $request->input('quantity'),
            'price' => $request->input('price'),
        ]);

        return redirect()->route('cart_items.index')->with('success', 'Cart item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartItem)
    {
        // Ensure the cart item belongs to the authenticated user's cart
        if ($cartItem->cart->user_id !== Auth::id()) {
            return abort(403, 'Unauthorized action.');
        }

        // Delete the cart item
        $cartItem->delete();

        return redirect()->route('cart_items.index')->with('success', 'Cart item deleted successfully.');
    }
}
