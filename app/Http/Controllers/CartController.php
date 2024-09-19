<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
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
    }

    /**
     * Add a product to the cart.
     */
    public function addProduct(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Fetch the product and user information
        $product = Product::findOrFail($request->input('product_id'));
        $userId = Auth::id();

        // Fetch or create a cart for the user
        $cart = Cart::firstOrCreate(['user_id' => $userId]);

        // Check if the product already exists in the cart
        $cartItem = $cart->items()->where('product_id', $product->id)->first();

        if ($cartItem) {
            // Update the quantity if the product is already in the cart
            $cartItem->quantity += $request->input('quantity');
            $cartItem->save();
        } else {
            // Add a new item to the cart
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $request->input('quantity'),
            ]);
        }

        // Update the cart total
        $cart->updateTotal();

        return response()->json(['success' => true, 'message' => 'Product added to cart!']);
    }


    public function increment(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($request->input('item_id'));
        $cartItem->quantity++;
        $cartItem->save();

        // Update the cart total
        $cartItem->cart->updateTotal();

        return response()->json([
            'success' => true,
            'updatedCart' => $cartItem->cart->items, // Return updated items
            'cartItemCount' => $cartItem->cart->items->count(),
            'total' => $cartItem->cart->total,
        ]);
    }

    public function decrement(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($request->input('item_id'));

        if ($cartItem->quantity > 1) {
            $cartItem->quantity--;
            $cartItem->save();
        } else {
            $cartItem->delete();
        }

        // Update the cart total
        $cartItem->cart->updateTotal();

        return response()->json([
            'success' => true,
            'updatedCart' => $cartItem->cart->items, // Return updated items
            'cartItemCount' => $cartItem->cart->items->count(),
            'total' => $cartItem->cart->total,
        ]);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($request->input('item_id'));
        $cart = $cartItem->cart; // Get the cart associated with the item
        $cartItem->delete();

        // Update the cart total
        $cart->updateTotal();

        // Fetch updated cart items
        $updatedCartItems = $cart->items; // Assuming `items` is a relationship on `Cart`
        $cartItemCount = $updatedCartItems->count();
        $total = $cart->total;

        return response()->json([
            'success' => true,
            'updatedCart' => $updatedCartItems,
            'cartItemCount' => $cartItemCount,
            'total' => $total,
        ]);
    }
}
