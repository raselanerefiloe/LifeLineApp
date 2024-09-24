<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Package;
use App\Models\Category;
use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all categories from the database
        $categories = Category::all();

        // Fetch all products from the database
        $products = Product::all();

        // Get search term
        $searchTerm = $request->input('search');

        // Query products with search functionality
        $products = Product::when($searchTerm, function ($query) use ($searchTerm) {
            return $query->where('name', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');
        })->get();

        return view('product.index', ['products' => $products, 'categories' => $categories]);
    }

    public function adminIndex()
    {
        $products = Product::all();
        return view('admin.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('Request Data:', $request->all());

        // Validate the incoming request data
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'category' => 'required|array',
                'price' => 'required|numeric|min:0',
                'pack_size' => 'required|string',
                'category.*' => 'exists:categories,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Errors:', $e->errors());
            return back()->withErrors($e->errors());
        }

        // Handle the image upload to Cloudinary
        $image = $request->file('image');
        $uploadedFileUrl = '';
        if ($image) {
            try {
                $uploadResult = Cloudinary::upload($image->getRealPath(), [
                    'folder' => 'lifeline/products'
                ]);
                $uploadedFileUrl = $uploadResult->getSecurePath();
                \Log::info('Uploaded File URL:', ['url' => $uploadedFileUrl]);
            } catch (\Exception $e) {
                \Log::error('Image Upload Error:', ['message' => $e->getMessage()]);
                return back()->withErrors(['image' => 'Failed to upload image']);
            }
        } else {
            return back()->withErrors(['image' => 'Image is required']);
        }

        // Create the new product
        try {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->pack_size = $request->pack_size;
            $product->image_url = $uploadedFileUrl;

            // Save the product to the database
            $product->save();


            // Decode the category input
            $categories = $request->input('category');

            // If $categories is a single string, split it into an array
            if (is_array($categories)) {
                $categories = array_map('trim', explode(',', $categories[0])); // Split and trim each ID
            }

            // Ensure all IDs are integers
            $categories = array_map('intval', $categories);

            // Attach the selected categories to the product
            if (is_array($categories)) {
                $product->categories()->attach($categories);
            }

            \Log::info('Product created successfully:', ['product_id' => $product->id]);
            return redirect()->route('admin.product.index')->with('success', 'Product added successfully.');
        } catch (\Exception $e) {
            \Log::error('Product Creation Error:', ['message' => $e->getMessage()]);
            return back()->withErrors(['general' => 'Failed to create product']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return "Product Show";
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //find the product by ID
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        $categories = Category::all();
        return view('admin.product.edit', [
            'categories' => $categories,
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        \Log::info('Update Request Data:', $request->all());
        //find the product by ID
        $product = Product::find($id);

        if (!$product) {
            abort(404, 'Product not found');
        }

        // Validate the incoming request data
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'price' => 'required|numeric|min:0',
                'pack_size' => 'required|string',
                'category' => 'required|array',
                'category.*' => 'exists:categories,id',
                'manufacturer' => 'required|string|max:255',
                'expiry_date' => 'required|date|after:today',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image is optional for update
                'inStock' => 'nullable|boolean'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation Errors:', $e->errors());
            return back()->withErrors($e->errors());
        }

        // Handle the image upload to Cloudinary if a new image is provided
        $uploadedFileUrl = $product->image_url; // Keep the old image URL if no new image is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Delete the old image from Cloudinary
            if ($product->image_url) {
                try {
                    // Extract the public ID from the image URL (assumes Cloudinary URL structure)
                    $publicId = basename($product->image_url, '.' . pathinfo($product->image_url, PATHINFO_EXTENSION));
                    Cloudinary::destroy('lifeline/products/' . $publicId);
                    \Log::info('Old image deleted from Cloudinary:', ['publicId' => $publicId]);
                } catch (\Exception $e) {
                    \Log::error('Failed to delete old image:', ['message' => $e->getMessage()]);
                }
            }

            // Upload new image to Cloudinary
            try {
                $uploadResult = Cloudinary::upload($image->getRealPath(), [
                    'folder' => 'lifeline/products'
                ]);
                $uploadedFileUrl = $uploadResult->getSecurePath();
                \Log::info('Uploaded new File URL:', ['url' => $uploadedFileUrl]);
            } catch (\Exception $e) {
                \Log::error('Image Upload Error:', ['message' => $e->getMessage()]);
                return back()->withErrors(['image' => 'Failed to upload new image']);
            }
        }

        // Update the product
        try {
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->pack_size = $request->pack_size;
            $product->manufacturer = $request->manufacturer;
            $product->expiry_date = $request->expiry_date;
            $product->image_url = $uploadedFileUrl; // Update the image URL if necessary
            $product->inStock = $request->has('inStock') ? true : false;

            // Save the updated product to the database
            $product->save();

            // Attach the product to the selected categories (detach old ones first)
            $categories = $request->input('category');
            if (is_array($categories)) {
                $product->categories()->sync($categories);
            } else {
                $product->categories()->sync([$categories]);
            }

            \Log::info('Product updated successfully:', ['product_id' => $product->id]);
            return redirect()->route('admin.product.index')->with('success', 'Product updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Product Update Error:', ['message' => $e->getMessage()]);
            return back()->withErrors(['general' => 'Failed to update product']);
        }
    }


    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete the product image from Cloudinary if it exists
        if ($product->image_url) {
            // Extract the public ID from the image URL
            $publicId = basename(parse_url($product->image_url, PHP_URL_PATH));

            // Delete the image from Cloudinary
            Cloudinary::destroy($publicId);

        }

        // Delete the product from the database
        $product->delete();

        // Redirect back to the product index page with a success message
        return redirect()->route('admin.product.index')
            ->with('success', 'Product deleted successfully.');
    }


}
