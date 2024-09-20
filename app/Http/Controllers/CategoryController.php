<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CategoryController extends Controller
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
        $categories = Category::all();
        return view('admin.category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Upload the image to Cloudinary
        $uploadedFileUrl = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'lifeline/categories', // Optional folder name in Cloudinary
        ])->getSecurePath();

        // Save the category to the database
        $category = new Category();
        $category->name = $request->input('name');
        $category->image_url = $uploadedFileUrl;
        $category->save();

        // Redirect or respond with success
        return redirect()->route('admin.category.index')->with('success', 'Category created successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    public function adminShow($id)
    {
        // Retrieve the category along with its related products
        $category = Category::with('products')->findOrFail($id);

        // Compute summary statistics
        $products = $category->products;
        $totalProducts = $products->count();
        $averagePrice = $totalProducts > 0 ? $products->avg('price') : 0;
        $highestPrice = $totalProducts > 0 ? $products->max('price') : 0;
        $lowestPrice = $totalProducts > 0 ? $products->min('price') : 0;

        // Pass data to the view
        return view('admin.category.show', [
            'category' => $category,
            'products' => $products,
            'totalProducts' => $totalProducts,
            'averagePrice' => $averagePrice,
            'highestPrice' => $highestPrice,
            'lowestPrice' => $lowestPrice,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Find the category by its ID
    $category = Category::findOrFail($id);

    // Check if the category has an image URL and delete it from Cloudinary
    if ($category->image_url) {
        // Extract the public ID from the image URL
        $publicId = basename(parse_url($category->image_url, PHP_URL_PATH));

        // Delete the image from Cloudinary
        Cloudinary::destroy($publicId);
    }

    // Delete the category
    $category->delete();

    // Redirect back with a success message
    return redirect()->route('admin.category.index')->with('success', 'Category deleted successfully.');
}

}
