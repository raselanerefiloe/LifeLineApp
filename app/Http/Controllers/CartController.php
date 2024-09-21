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
    // Check if the user is authenticated
    if (!Auth::check()) {
        return response()->json([
            'success' => false,
            'message' => 'You need to log in to add products to your cart.',
        ], 401);
    }

    // Validate the request
    $request->validate([
        'product_id' => 'required|integer|exists:products,id',
        'pack_size' => 'required|string',
    ]);

    // Fetch product and user information
    $product = Product::findOrFail($request->input('product_id'));
    $userId = Auth::id();

    // Fetch or create a cart for the user
    $cart = Cart::firstOrCreate(['user_id' => $userId]);

    // Check if the product already exists in the cart
    $cartItem = $cart->items()->where('product_id', $product->id)->first();

    if ($cartItem) {
        // Update the pack_size if the product is already in the cart
        preg_match('/^(\d+)\s*(?:x|by)\s*(\d*)\s*[a-zA-Z]+/i', $cartItem->pack_size, $matches);

        if (!empty($matches[1])) {
            // Increment the quantity
            $currentQuantity = (int) $matches[1];
            $newQuantity = $currentQuantity + 1;

            // Maintain original format, updating the quantity only
            $newPackSize = preg_replace('/^\d+/', $newQuantity, $cartItem->pack_size);
            $cartItem->pack_size = $newPackSize;
            $cartItem->save();
        }
    } else {
        // Attempt to add a new item to the cart
        try {
            // Use the pack_size directly from the request for a new item
            $initialPackSize = trim($request->input('pack_size'));

            $cart->items()->create([
                'product_id' => $product->id,
                'pack_size' => $initialPackSize,
                'price' => $product->price,
            ]);
        } catch (\Exception $e) {
            // Log the error and delete the cart
            Log::error('Failed to add product to cart', ['error' => $e->getMessage()]);
            $cart->delete();
            return response()->json([
                'success' => false,
                'message' => 'Failed to add product to cart.',
            ], 500);
        }
    }

    // Update the cart total
    $cart->updateTotal();

    // Load the cart items with products
    $updatedCartItems = $cart->items()->with('product')->get();

    return response()->json([
        'success' => true,
        'message' => 'Product added to cart!',
        'updatedCart' => $updatedCartItems,
        'cartItemCount' => $cart->items->count(),
        'total' => $cart->total,
    ]);
}




    public function increment(Request $request)
    {
        $request->validate([
            'item_id' => 'required|integer|exists:cart_items,id',
        ]);

        $cartItem = CartItem::findOrFail($request->input('item_id'));

        // Extract the current quantity from pack_size
        preg_match('/(\d+)\s*(?:x|by)\s*\d*\s*[a-zA-Z]+/i', $cartItem->pack_size, $matches);

        if (!empty($matches[1])) {
            // Increment the quantity
            $currentQuantity = (int) $matches[1];
            $newQuantity = $currentQuantity + 1;

            // Update pack_size with the new quantity (maintain original format)
            $newPackSize = preg_replace('/^\d+/', $newQuantity, $cartItem->pack_size);
            $cartItem->pack_size = $newPackSize;
        }

        $cartItem->save();

        // Update the cart total
        $cartItem->cart->updateTotal();
        // Load the cart items with products
        $updatedCartItems = $cartItem->cart->items()->with('product')->get();
        return response()->json([
            'success' => true,
            'updatedCart' => $updatedCartItems, // Return updated items
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

        // Extract the current quantity from pack_size
        preg_match('/(\d+)\s*(?:x|by)\s*\d*\s*[a-zA-Z]+/i', $cartItem->pack_size, $matches);

        if (!empty($matches[1])) {
            $currentQuantity = (int) $matches[1];

            if ($currentQuantity > 1) {
                // Decrement the quantity
                $newQuantity = $currentQuantity - 1;

                // Update pack_size with the new quantity (maintain original format)
                $newPackSize = preg_replace('/^\d+/', $newQuantity, $cartItem->pack_size);
                $cartItem->pack_size = $newPackSize;
                $cartItem->save();
            } else {
                // If quantity is 1, delete the cart item
                $cartItem->delete();
            }
        }

        // Update the cart total
        $cartItem->cart->updateTotal();

        // Load the cart items with products
        $updatedCartItems = $cartItem->cart->items()->with('product')->get();
        return response()->json([
            'success' => true,
            'updatedCart' => $updatedCartItems, // Return updated items
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
        $updatedCartItems = $cart->items()->with('product')->get(); // Assuming `items` is a relationship on `Cart`
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
