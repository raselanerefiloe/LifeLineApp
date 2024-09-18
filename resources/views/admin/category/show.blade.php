<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Category Details') }}
            </h2>
            <a href="{{ route('admin.category.edit', $category->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition">
                Edit Category
            </a>
        </div>
    </x-slot>

    <!-- Success Message -->
    @if (session('success'))
        <div id='success-message' class="max-w-2xl mx-auto mt-2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="closeAlert()">
                <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 5.652a1 1 0 10-1.414-1.414L10 7.586 7.066 4.652a1 1 0 10-1.414 1.414L8.586 10l-2.934 2.934a1 1 0 101.414 1.414L10 12.414l2.934 2.934a1 1 0 101.414-1.414L11.414 10l2.934-2.934z"/></svg>
            </span>
        </div>
    @endif

    <!-- Category Details -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <!-- Category Image -->
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-32 h-32 object-cover rounded-full">
                        <div class="ml-6">
                            <h3 class="text-2xl font-semibold">{{ $category->name }}</h3>
                            <p class="mt-2 text-gray-600">{{ $category->description }}</p>
                        </div>
                    </div>
                    <!-- Delete Category Button -->
                    <x-confirm-delete
                        :title="'Delete Category'"
                        :message="'Are you sure you want to delete this category?'"
                        :action="route('admin.category.destroy', $category->id)"
                        :triggerText="'Delete Category'"
                    />
                </div>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section class="max-w-7xl mx-auto rounded-lg bg-white py-8">
        <div class="px-4 sm:px-6 lg:px-8">
            <h3 class="text-xl font-semibold mb-4">Products Under This Category</h3>
            @if ($category->products->isEmpty())
                <div class="text-center py-8">
                    <p>No products found in this category.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach ($category->products as $product)
                        <div class="bg-white p-4 rounded-lg shadow-md flex flex-col items-center">
                            <!-- Product Image -->
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md">
                            <!-- Product Name -->
                            <h3 class="text-lg font-semibold mt-2">{{ $product->name }}</h3>
                            <!-- Product Price -->
                            <p class="text-green-600 font-semibold mt-2">R{{ number_format($product->price, 2) }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Summary Statistics -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4">Summary Statistics</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold">Total Products:</h4>
                        <p class="text-gray-700">{{ $category->products->count() }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold">Average Price:</h4>
                        <p class="text-gray-700">R{{ number_format($category->products->avg('price'), 2) }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold">Highest Price:</h4>
                        <p class="text-gray-700">R{{ number_format($category->products->max('price'), 2) }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold">Lowest Price:</h4>
                        <p class="text-gray-700">R{{ number_format($category->products->min('price'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function closeAlert() {
            document.getElementById('success-message').style.display = 'none';
        }
    </script>
</x-app-layout>
