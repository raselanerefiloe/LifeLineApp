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
                <form id="productForm" action="{{ route('admin.product.store') }}" method="POST"
                    enctype="multipart/form-data">
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

                    <!-- Alpine.js & Tailwind CSS Searchable Multiselect -->
                    <div x-data="dropdown()" class="mb-4 relative">
                        <label for="category" class="block text-gray-700 font-semibold">Categories</label>

                        <!-- Dropdown button -->
                        <div @click="toggle"
                            class="border-gray-300 border rounded-md shadow-sm cursor-pointer p-2 w-full">
                            <template x-if="selectedCategories.length > 0">
                                <!-- Show selected categories -->
                                <div class="flex flex-wrap">
                                    <template x-for="(category, index) in selectedCategories" :key="index">
                                        <span
                                            class="bg-green-100 text-green-800 rounded-full px-2 py-1 text-sm mr-2 mb-2">
                                            <span x-text="category.name"></span>
                                            <button @click="removeCategory(index)" class="ml-1 text-red-500">x</button>
                                        </span>
                                    </template>
                                </div>
                            </template>
                            <template x-if="selectedCategories.length === 0">
                                <!-- Placeholder text when no category selected -->
                                <span class="text-gray-400">Select categories</span>
                            </template>
                        </div>

                        <!-- Dropdown list -->
                        <div x-show="open" @click.away="close"
                            class="absolute z-10 w-full mt-2 bg-white border border-gray-300 rounded-md shadow-lg">
                            <!-- Search input -->
                            <div class="p-2">
                                <input type="text" x-model="searchQuery"
                                    class="block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Search categories...">
                            </div>
                            <div class="max-h-48 overflow-y-auto">
                                <template x-for="category in filteredCategories" :key="category.id">
                                    <div class="flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                                        <input type="checkbox" :id="'category-' + category.id" :value="category.id"
                                            x-model="selected"
                                            @click="toggleCategory(category); $event.stopPropagation()" class="mr-2">
                                        <label :for="'category-' + category.id" x-text="category.name"
                                            class="cursor-pointer"></label>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <!-- Hidden input to hold selected category values -->
                        <input type="hidden" name="category[]"
                            :value="selectedCategories.map(category => category.id)">

                        @error('categories')
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
                        <button id="submitBtn" type="submit"
                            class="bg-[#63C186] text-white px-4 py-2 rounded-md hover:bg-green-600 transition flex items-center justify-center">
                            <span id="submitText">Add Product</span>
                            <!-- Spinner (initially hidden) -->
                            <svg id="spinner" class="hidden animate-spin h-5 w-5 ml-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                    stroke-width="4"></circle>
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

    <script>
        function dropdown() {
            return {
                open: false,
                searchQuery: '',
                categories: @json($categories) || [],
                selectedCategories: [],
                selected: [],

                toggle() {
                    this.open = !this.open;
                },

                close() {
                    this.open = false;
                },

                toggleCategory(category) {
                    if (!category || !category.id) return;
                    console.log('toggleCategory called with:', category);
                    const index = this.selectedCategories.findIndex(item => item.id === category.id);
                    console.log("Index: ", index);
                    if (index === -1) {
                        console.log('Adding category:', category);
                        this.selectedCategories.push(category);
                    } else {
                        console.log('Removing category:', category);
                        this.selectedCategories.splice(index, 1);
                    }
                    console.log('Selected categories:', JSON.stringify(this.selectedCategories, null, 2));
                },

                removeCategory(index) {
                    this.selectedCategories.splice(index, 1);
                    this.selected = this.selectedCategories.map(category => category.id);
                },

                get filteredCategories() {
                    if (!this.categories || this.searchQuery === '') {
                        return this.categories || []; // Ensure it returns an empty array if categories is undefined
                    }
                    return this.categories.filter(category =>
                        category.name.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                }
            }
        }
    </script>
    <!-- Add JavaScript to handle the loading state -->
    <script>
        document.getElementById('productForm').addEventListener('submit', function(event) {
            var submitBtn = document.getElementById('submitBtn');
            var submitText = document.getElementById('submitText');
            var spinner = document.getElementById('spinner');

            // Disable the submit button
            submitBtn.disabled = true;

            // Change the button text to show saving state and display the spinner
            submitText.textContent = 'Saving...';
            spinner.classList.remove('hidden'); // Show spinner
        });
    </script>

    <!-- Tailwind CSS Spinner animation -->
    <style>
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }
    </style>
</x-app-layout>
