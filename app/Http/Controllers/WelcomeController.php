<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        // Initialize default values
        $cart = collect();
        $cartItems = collect(); // Empty collection
        $total = 0;
        $cartItemCount = 0;
        $cartId = 0;
        $createdAt = null;

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart) {
                $cartItems = $cart->items; // Assuming `items` is a relationship on `Cart`
                $total = $cart->total; 
                $cartItemCount = $cartItems->count();
                $cartId = $cart->id;
                $createdAt = $cart->created_at;
            }
        }
        // Logging values
        \Log::info('Cart:', [
            'cart' => $cart
        ]);
        \Log::info('Cart Items:', [
            'cartItems' => $cartItems
        ]);
        \Log::info('Total:', [
            'total' => $total
        ]);
        \Log::info('Cart Item Count:', [
            'cartItemCount' => $cartItemCount
        ]);

        return view('welcome', [
            'categories' => $categories,
            'cartItems' => $cartItems,
            'total' => $total,
            'cartItemCount' => $cartItemCount,
            'cartId' => $cartId,
            'createdAt' => $createdAt,
        ]);
    }
}
