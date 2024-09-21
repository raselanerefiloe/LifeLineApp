<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Session;


class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        // Fetch the authenticated user
        $user = Auth::user();

        // Ensure the user has only one cart
        $cart = Cart::where('user_id', $user->id)->firstOrFail();

        // Retrieve the cart items for the user's cart
        $cartItems = $cart->items;

        // Create a new order for the user
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $cart->total, // Calculate total based on cart items
        ]);

        // Create order items associated with the order
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'pack_size' => $item->pack_size,
                'price' => $item->product->price, // Fetch the product price
            ]);
        }

        // Delete the cart after creating the order
        $cart->delete();
        // On success
        Session::flash('success_message', 'Your order has been placed successfully.');
        return redirect()->route('home');
    }
}
