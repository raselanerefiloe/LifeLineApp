<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Stock Item') }}
            </h2>
        </div>
    </x-slot>

    <!-- Stock Creation Form -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form id="stockForm" action="{{ route('admin.stock.store') }}" method="POST">
                    @csrf

                    <!-- Product Selection Dropdown -->
                    <div x-data="productDropdown()" x-ref="productDropdown" class="mb-4 relative">
                        <label for="product" class="block text-gray-700 font-semibold">Select Product</label>

                        <!-- Dropdown button -->
                        <div @click="toggle"
                            class="border-gray-300 border rounded-md shadow-sm cursor-pointer p-2 w-full">
                            <template x-if="selectedProduct">
                                <span x-text="selectedProduct.name"></span>
                            </template>
                            <template x-if="!selectedProduct">
                                <span class="text-gray-400">Select a product</span>
                            </template>
                        </div>

                        <!-- Dropdown list -->
                        <div x-show="open" @click.away="close"
                            class="absolute z-10 w-full mt-2 bg-white border border-gray-300 rounded-md shadow-lg">
                            <div class="p-2">
                                <input type="text" x-model="searchQuery"
                                    class="block w-full border border-gray-300 rounded-md p-2"
                                    placeholder="Search products...">
                            </div>
                            <div class="max-h-48 overflow-y-auto">
                                <template x-for="product in filteredProducts" :key="product.id">
                                    <div class="flex items-center p-2 hover:bg-gray-100 cursor-pointer"
                                        @click="selectProduct(product)">
                                        <span x-text="product.name" class="flex-1"></span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <input type="hidden" name="product_id" :value="selectedProduct ? selectedProduct.id : ''">

                        @error('product_id')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Stock Item Description Input -->
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-semibold">Description</label>
                        <textarea id="description" name="description" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter SKU description" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pack size Input -->
                    <div class="mb-4">
                        <label for="pack_size" class="block text-gray-700 font-semibold">Pack Size</label>
                        <input type="text" id="pack_size" name="pack_size" min="1"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter pack size (e.g 1 x 100ml)"
                            value="{{ old('pack_size') }}" required>
                        @error('pack_size')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Manufacturer Date Input -->
                    <div class="mb-4">
                        <label for="expiry_date" class="block text-gray-700 font-semibold">Manufacturer</label>
                        <input type="text" id="manufacturer" name="manufacturer"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="PFIZER PHARMACIA INDIA"
                            value="{{ old('manufacturer') }}">
                        @error('manufacturer')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Expiry Date Input -->
                    <div class="mb-4">
                        <label for="expiry_date" class="block text-gray-700 font-semibold">Expiry Date</label>
                        <input type="date" id="expiry_date" name="expiry_date"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            value="{{ old('expiry_date') }}">
                        @error('expiry_date')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button id="submitBtn" type="submit"
                            class="bg-[#63C186] text-white px-4 py-2 rounded-md hover:bg-green-600 transition flex items-center justify-center">
                            <span id="submitText">Add Stock Item</span>
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
        function productDropdown() {
            return {
                open: false,
                searchQuery: '',
                products: @json($products) || [], // Ensure you pass products from your controller
                selectedProduct: null,
                packageDropdownRef: null, // Reference for package dropdown

                init() {
                    const $root = this.$el.closest('[x-data]');
                    this.packageDropdownRef = $root.__x.$refs.packageDropdown;
                },
                toggle() {
                    this.open = !this.open;
                },

                close() {
                    this.open = false;
                },

                selectProduct(product) {
                    this.selectedProduct = product;
                    this.close(); // Close the dropdown after selection
                    this.$dispatch('input', {
                        value: product.id
                    }); // Dispatch event to update packages
                    // Ensure that packageDropdown reference is available
                    this.$refs.packageDropdown.updatePackages(product.id);
                    
                },

                get filteredProducts() {
                    if (!this.products || this.searchQuery === '') {
                        return this.products || []; // Ensure it returns an empty array if products is undefined
                    }
                    return this.products.filter(product =>
                        product.name.toLowerCase().includes(this.searchQuery.toLowerCase())
                    );
                }
            }
        }

        
    </script>

    <script>
        document.getElementById('stockForm').addEventListener('submit', function(event) {
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
