<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Product') }}
            </h2>
        </div>
    </x-slot>

    <!-- Product Edit Form -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form id="productForm" action="{{ route('admin.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Product Name Input -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold">Product Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter product name" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Description Input -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-semibold">Description</label>
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter product description" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Price Input -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-semibold">Price (R)</label>
                        <input type="number" id="price" name="price"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter price"
                            value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Quantity Input -->
                    <div class="mb-4">
                        <label for="quantity" class="block text-gray-700 font-semibold">Quantity</label>
                        <input type="number" id="quantity" name="quantity"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter quantity"
                            value="{{ old('quantity', $product->quantity) }}" required>
                        @error('quantity')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Category Dropdown -->
                    <div class="mb-4">
                        <label for="category" class="block text-gray-700 font-semibold">Category</label>
                        <select id="category" name="category"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('category', $product->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Manufacturer Input -->
                    <div class="mb-4">
                        <label for="manufacturer" class="block text-gray-700 font-semibold">Manufacturer</label>
                        <input type="text" id="manufacturer" name="manufacturer"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter manufacturer" value="{{ old('manufacturer', $product->manufacturer) }}"
                            required>
                        @error('manufacturer')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Expiry Date Input -->
                    <div class="mb-4">
                        <label for="expiry_date" class="block text-gray-700 font-semibold">Expiry Date</label>
                        <input type="date" id="expiry_date" name="expiry_date"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('expiry_date', $product->expiry_date) }}" required>
                        @error('expiry_date')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Size Input -->
                    <div class="mb-4">
                        <label for="size" class="block text-gray-700 font-semibold">Size</label>
                        <input type="text" id="size" name="size"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter size"
                            value="{{ old('size', $product->size) }}" required>
                        @error('size')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Image Input -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-semibold">Product Image</label>
                        <input type="file" id="image" name="image"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*">
                        @error('image')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- In Stock Checkbox -->
                    <div class="mb-4">
                        <label for="inStock" class="block text-gray-700 font-semibold">In Stock</label>
                        <input type="checkbox" id="inStock" name="inStock" value="1"
                            {{ old('inStock', $product->inStock) ? 'checked' : '' }}>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button id="submitBtn" type="submit"
                            class="bg-[#63C186] text-white px-4 py-2 rounded-md hover:bg-green-600 transition flex items-center justify-center">
                            <span id="submitText">Update Product</span>
                            <!-- Spinner (initially hidden) -->
                            <svg id="spinner" class="hidden animate-spin h-5 w-5 ml-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.961 7.961 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Add JavaScript to handle the loading state -->
    <script>
        document.getElementById('productForm').addEventListener('submit', function(event) {
            var submitBtn = document.getElementById('submitBtn');
            var submitText = document.getElementById('submitText');
            var spinner = document.getElementById('spinner');

            // Disable the submit button
            submitBtn.disabled = true;

            // Change the button text to show saving state and display the spinner
            submitText.textContent = 'Updating...';
            spinner.classList.remove('hidden'); // Show spinner
        });
    </script>
</x-app-layout>
