<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch the carts for the authenticated user
        $carts = Cart::where('user_id', Auth::id())->get();
        return view('carts.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Redirect to the index of ProductController
        return redirect()->route('product.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'total' => 'required|numeric|min:0',
        ]);

        // Create a new cart for the authenticated user
        $cart = new Cart();
        $cart->user_id = Auth::id();
        $cart->total = $request->input('total');
        $cart->save();

        return redirect()->route('carts.index')->with('success', 'Cart created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        // Ensure the cart belongs to the authenticated user
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('carts.show', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        // Redirect to the index of CartController
        return redirect()->route('carts.index'); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        // Ensure the cart belongs to the authenticated user
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $request->validate([
            'total' => 'required|numeric|min:0',
        ]);

        // Update the cart
        $cart->total = $request->input('total');
        $cart->save();

        return redirect()->route('carts.index')->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        // Ensure the cart belongs to the authenticated user
        if ($cart->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the cart
        $cart->delete();

        return redirect()->route('carts.index')->with('success', 'Cart deleted successfully.');
    }}
