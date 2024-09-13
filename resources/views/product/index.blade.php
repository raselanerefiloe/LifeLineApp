<x-guest-layout>
    <!-- Hero Section -->
    <div class="relative mx-auto mt-4 bg-green-600 text-white text-center py-16 md:py-24 overflow-hidden rounded-lg w-[80%]">
        <div class="absolute inset-0 z-0">
            <!-- Optional: Add a background image with opacity -->
            <img src="{{ asset('img/hero/product.jpg') }}" alt="Background" class="w-full h-full object-cover opacity-90" />
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-12 grid grid-cols-1 md:grid-cols-4 gap-8">
        <!-- Filter Sidebar -->
        <aside class="bg-white p-6 rounded-lg shadow-md md:col-span-1">
            <h3 class="text-lg font-semibold text-green-500 mb-4">Filter Products</h3>
            <form>
                <!-- Category Filter -->
                <div class="mb-4">
                    <label for="category" class="block text-gray-600">Category</label>
                    <select id="category" name="category"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All Categories</option>
                        <option value="baby-care">Baby Care</option>
                        <option value="personal-care">Personal Care</option>
                        <option value="health-devices">Health Devices</option>
                        <option value="nutrition">Nutrition</option>
                        <!-- Add more categories as needed -->
                    </select>
                </div>

                <!-- Brand Filter -->
                <div class="mb-4">
                    <label for="brand" class="block text-gray-600">Brand</label>
                    <select id="brand" name="brand"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All Brands</option>
                        <option value="brand-a">Brand A</option>
                        <option value="brand-b">Brand B</option>
                        <option value="brand-c">Brand C</option>
                        <option value="brand-d">Brand D</option>
                        <!-- Add more brands as needed -->
                    </select>
                </div>

                <!-- Price Range Filter -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-600">Price Range</label>
                    <input type="range" id="price" name="price" min="0" max="500" step="10"
                        class="mt-1 w-full">
                    <div class="flex justify-between text-gray-600 text-sm mt-1">
                        <span>R0</span>
                        <span>R500+</span>
                    </div>
                </div>

                <!-- Rating Filter -->
                <div class="mb-4">
                    <label for="rating" class="block text-gray-600">Rating</label>
                    <select id="rating" name="rating"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All Ratings</option>
                        <option value="1">1 Star & Up</option>
                        <option value="2">2 Stars & Up</option>
                        <option value="3">3 Stars & Up</option>
                        <option value="4">4 Stars & Up</option>
                        <option value="5">5 Stars</option>
                    </select>
                </div>

                <!-- Availability Filter -->
                <div class="mb-4">
                    <label for="availability" class="block text-gray-600">Availability</label>
                    <select id="availability" name="availability"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All Availability</option>
                        <option value="in-stock">In Stock</option>
                        <option value="out-of-stock">Out of Stock</option>
                        <option value="pre-order">Pre-order</option>
                    </select>
                </div>

                <!-- Color Filter (example) -->
                <div class="mb-4">
                    <label for="color" class="block text-gray-600">Color</label>
                    <select id="color" name="color"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All Colors</option>
                        <option value="red">Red</option>
                        <option value="blue">Blue</option>
                        <option value="green">Green</option>
                        <option value="black">Black</option>
                        <!-- Add more colors as needed -->
                    </select>
                </div>

                <!-- Size Filter (example) -->
                <div class="mb-4">
                    <label for="size" class="block text-gray-600">Size</label>
                    <select id="size" name="size"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">All Sizes</option>
                        <option value="small">Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                        <option value="x-large">X-Large</option>
                        <!-- Add more sizes as needed -->
                    </select>
                </div>

                <!-- Apply Filters Button -->
                <div class="mb-4">
                    <button type="submit"
                        class="bg-green-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-green-700">Apply
                        Filters</button>
                </div>
            </form>
        </aside>


        <!-- Products Grid -->
        <div class="md:col-span-3">
            <!-- Search Bar -->
            <div class="mb-6">
                <form class="relative">
                    <input type="text" placeholder="Search products..."
                        class="w-full border border-gray-300 rounded-lg py-2 px-4 focus:outline-none focus:ring-2 focus:ring-green-500">
                    <button type="submit"
                        class="absolute inset-y-0 right-0 px-4 py-2 bg-green-600 text-white rounded-r-lg hover:bg-green-700">
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 4a7 7 0 00-7 7 7 7 0 0014 0 7 7 0 00-7-7zm0 14a9 9 0 01-9-9 9 9 0 1118 0 9 9 0 01-9 9z" />
                        </svg>
                    </button>
                </form>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Product Card 1-->
                <div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
                    <img src="{{ asset('img/products/dulcolax-5mg-tablets.png') }}" alt="Product 1"
                        class="w-full h-48 object-cover">
                    <div
                        class="absolute inset-0 flex flex-col items-end justify-start opacity-0 group-hover:opacity-100 bg-gray-800 bg-opacity-50 transition-opacity duration-300">
                        <a href="#" class="text-white text-3xl mb-4 mr-4 mt-2">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mb-4 mr-4">
                            <i class="fas fa-heart"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mr-4">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-600">Dulcolax 5mg Tablets 10's</h3>
                        <p class="mt-2 text-gray-600">Lorem ipsum</p>
                        <p class="mt-4 text-green-600 font-semibold">R29.99</p>
                    </div>
                </div>

                <!-- Product Card 2-->
                <div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
                    <img src="{{ asset('img/products/duphalac-dry-sachets.jpeg') }}" alt="Product 2"
                        class="w-full h-48 object-cover">
                    <div
                        class="absolute inset-0 flex flex-col items-end justify-start opacity-0 group-hover:opacity-100 bg-gray-800 bg-opacity-50 transition-opacity duration-300">
                        <a href="#" class="text-white text-3xl mb-4 mt-2 mr-4">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mb-4 mr-4">
                            <i class="fas fa-heart"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mr-4">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-600">Duphalac Dry Sachets</h3>
                        <p class="mt-2 text-gray-600">Lorem Ipsum</p>
                        <p class="mt-4 text-green-600 font-semibold">R49.99</p>
                    </div>
                </div>

                <!-- Product Card 3-->
                <div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
                    <img src="{{ asset('img/products/gaviscon-aniseed-suspension-syrup-150ml.jpeg') }}"
                        alt="Product 3" class="w-full h-48 object-cover">
                    <div
                        class="absolute inset-0 flex flex-col items-end justify-start opacity-0 group-hover:opacity-100 bg-gray-800 bg-opacity-50 transition-opacity duration-300">
                        <a href="#" class="text-white text-3xl mb-4 mt-2 mr-4">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mb-4 mr-4">
                            <i class="fas fa-heart"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mr-4">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-600">Gaviscon aniseed suspension syrup</h3>
                        <p class="mt-2 text-gray-600">Lorem Ipsum 150ml</p>
                        <p class="mt-4 text-green-600 font-semibold">R39.99</p>
                    </div>
                </div>

                <!-- Product Card 4-->
                <div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
                    <img src="{{ asset('img/products/probiflora-adult-everydayflora-balance-2-strain-capsules.jpeg') }}"
                        alt="Product 1" class="w-full h-48 object-cover">
                    <div
                        class="absolute inset-0 flex flex-col items-end justify-start opacity-0 group-hover:opacity-100 bg-gray-800 bg-opacity-50 transition-opacity duration-300">
                        <a href="#" class="text-white text-3xl mb-4 mr-4 mt-2">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mb-4 mr-4">
                            <i class="fas fa-heart"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mr-4">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-600">Probiflora adult everydayflora</h3>
                        <p class="mt-2 text-gray-600">Lorem ipsum balance-2-strain-capsules</p>
                        <p class="mt-4 text-green-600 font-semibold">R229.99</p>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
                    <img src="{{ asset('img/products/reuterina-drops.jpeg') }}" alt="Product 2"
                        class="w-full h-48 object-cover">
                    <div
                        class="absolute inset-0 flex flex-col items-end justify-start opacity-0 group-hover:opacity-100 bg-gray-800 bg-opacity-50 transition-opacity duration-300">
                        <a href="#" class="text-white text-3xl mb-4 mt-2 mr-4">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mb-4 mr-4">
                            <i class="fas fa-heart"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mr-4">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-600">Reuterina drops</h3>
                        <p class="mt-2 text-gray-600">Lorem Ipsum</p>
                        <p class="mt-4 text-green-600 font-semibold">R449.99</p>
                    </div>
                </div>

                <!-- Product Card -->
                <div class="relative bg-white rounded-lg shadow-md overflow-hidden group">
                    <img src="{{ asset('img/products/gaviscon-peppermint-tablets.jpeg') }}" alt="Product 3"
                        class="w-full h-48 object-cover">
                    <div
                        class="absolute inset-0 flex flex-col items-end justify-start opacity-0 group-hover:opacity-100 bg-gray-800 bg-opacity-50 transition-opacity duration-300">
                        <a href="#" class="text-white text-3xl mb-4 mt-2 mr-4">
                            <i class="fas fa-cart-plus"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mb-4 mr-4">
                            <i class="fas fa-heart"></i>
                        </a>
                        <a href="#" class="text-white text-3xl mr-4">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-semibold text-green-600">Gaviscon Peppermint Tablets</h3>
                        <p class="mt-2 text-gray-600">Lorem Ipsum 150ml</p>
                        <p class="mt-4 text-green-600 font-semibold">R59.99</p>
                    </div>
                </div>
                <!-- Add more product cards as needed -->
            </div>
        </div>
    </div>
</x-guest-layout>
