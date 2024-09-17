<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Product') }}
            </h2>
        </div>
    </x-slot>

    <!-- Product Creation Form -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Product Name Input -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold">Product Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter product name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Description Input -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-semibold">Description</label>
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter product description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Price Input -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 font-semibold">Price (R)</label>
                        <input type="number" id="price" name="price"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter price"
                            value="{{ old('price') }}" required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Quantity Input -->
                    <div class="mb-4">
                        <label for="quantity" class="block text-gray-700 font-semibold">Quantity</label>
                        <input type="number" id="quantity" name="quantity"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter quantity"
                            value="{{ old('quantity') }}" required>
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
                                    {{ old('category') == $category->id ? 'selected' : '' }}>
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
                            placeholder="Enter manufacturer" value="{{ old('manufacturer') }}" required>
                        @error('manufacturer')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Expiry Date Input -->
                    <div class="mb-4">
                        <label for="expiry_date" class="block text-gray-700 font-semibold">Expiry Date</label>
                        <input type="date" id="expiry_date" name="expiry_date"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('expiry_date') }}" required>
                        @error('expiry_date')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Size Input -->
                    <div class="mb-4">
                        <label for="size" class="block text-gray-700 font-semibold">Size</label>
                        <input type="text" id="size" name="size"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter size"
                            value="{{ old('size') }}" required>
                        @error('size')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Image Input -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-semibold">Product Image</label>
                        <input type="file" id="image" name="image"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*" required>
                        @error('image')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- In Stock Checkbox -->
                    <div class="mb-4">
                        <label for="inStock" class="block text-gray-700 font-semibold">In Stock</label>
                        <input type="checkbox" id="inStock" name="inStock" value="1"
                            {{ old('inStock') ? 'checked' : '' }}>
                        <!-- Default value should be null if not checked -->
                    </div>


                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit"
                            class="bg-[#63C186] text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                            Add Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
