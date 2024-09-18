<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch wish lists for the authenticated user
        $wishLists = WishList::where('user_id', Auth::id())->get();
        return view('wish_lists.index', compact('wishLists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('wish_list.index');
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

        // Create a new wish list for the authenticated user
        $wishList = new WishList();
        $wishList->user_id = Auth::id();
        $wishList->total = $request->input('total');
        $wishList->save();

        return redirect()->route('wish_lists.index')->with('success', 'Wish List created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WishList $wishList)
    {
        return redirect()->route('wish_list.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WishList $wishList)
    {
        return redirect()->route('wish_list.index');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WishList $wishList)
    {
        // Ensure the wish list belongs to the authenticated user
        if ($wishList->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate the request
        $request->validate([
            'total' => 'required|numeric|min:0',
        ]);

        // Update the wish list
        $wishList->total = $request->input('total');
        $wishList->save();

        return redirect()->route('wish_lists.index')->with('success', 'Wish List updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishList $wishList)
    {
        // Ensure the wish list belongs to the authenticated user
        if ($wishList->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the wish list
        $wishList->delete();

        return redirect()->route('wish_lists.index')->with('success', 'Wish List deleted successfully.');
    }
}
