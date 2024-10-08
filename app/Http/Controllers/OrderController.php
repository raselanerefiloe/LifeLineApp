<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch orders for the authenticated user
        $orders = Order::where('user_id', Auth::id())->get();
        return view('orders.index', compact('orders'));
    }

    public function adminIndex()
    {
        $orders = Order::with('orderItems')->get();
        \Log::info("Orders", ['orders' => $orders]);
        return view('admin.order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Redirect to the index of CartController
        return redirect()->route('carts.index');
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

        // Create a new order for the authenticated user
        $order = new Order();
        $order->user_id = Auth::id();
        $order->total = $request->input('total');
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Redirect to the index of OrderController
        return redirect()->route('orders.index');
    }
    public function adminShow($id)
    {
        // Fetch the order with its related items and user
        $order = Order::with(['orderItems.product', 'user'])->findOrFail($id);

        // Return the view with the order details
        return view('admin.order.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        // Redirect to the index of OrderController
        return redirect()->route('orders.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Ensure the order belongs to the authenticated user
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $request->validate([
            'total' => 'required|numeric|min:0',
        ]);

        // Update the order
        $order->total = $request->input('total');
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        // Check if the authenticated user is the order owner or an admin
        $user = Auth::user();
        \Log::info("User: ", ["user" => $user]);
        if ($user->id !== $order->user_id || $user->usertype !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }

        // Delete the order
        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'Order deleted successfully.');
    }

    public function cancel($id)
    {
        $order = Order::findOrFail($id);

        // Check if the order is already completed or cancelled
        if ($order->status === 'completed' || $order->status === 'cancelled') {
            return redirect()->back()->with('error', 'This order cannot be canceled.');
        }

        // Check if the authenticated user is an admin or the owner of the order
        if (Auth::user()->usertype === 'admin') {
            // Admin can cancel any order
            $order->status = 'cancelled';
        } elseif (Auth::id() === $order->user_id) {
            // Customer can cancel their own order only if it's still pending or processing
            if ($order->status === 'pending' || $order->status === 'processing') {
                $order->status = 'cancelled';
            } else {
                return redirect()->back()->with('error', 'You can only cancel orders that are pending or processing.');
            }
        } else {
            // Unauthorized action
            return redirect()->back()->with('error', 'You are not authorized to cancel this order.');
        }

        // Save the updated order status
        $order->save();

        // Redirect with a success message
        return redirect()->route(Auth::user()->usertype === 'Admin' ? 'admin.order.index' : 'orders.index')
            ->with('success', 'Order has been canceled successfully.');
    }



}
