<x-guest-layout>
    <!-- Main Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8 lg:px-8 py-8">
        <!-- Container for the Left Content and Right Image -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-0 md:gap-8 lg:gap-8">
            <!-- Left Content -->
            <div class="col-span-2">
                <!-- Main Text Content -->
                <div class="bg-[#ACCF46] p-6 rounded-lg shadow-md mb-8">
                    <div class="flex gap-4">
                        <h2 class="text-[4px] md:text-xl lg:text-xl font-bold text-green-600 mb-4 bg-white py-2 px-2 inline-block rounded-lg">
                            4.9
                            <i class="fa-solid fa-star text-[4px] md:text-2xl lg:text-2xl" style="color: #FFD43B;"></i>
                        </h2>
                        <h3 class="text-sm md:text-2xl lg:text-2xl font-semibold mb-2">Top Pharmaceutical Industry Supplier</h3>
                    </div>
                    <p class="text-sm md:text-xl lg:text-xl text-gray-700 mb-4">Your Trusted Partner in Quality</p>
                    <p class="text-sm md:text-lg lg:text-lg text-gray-600 mb-6">LifeLine offers top-tier products that stand out in the market</p>
                    <a href="#"
                        class="inline-block text-md md:text-2xl lg:text-2xl bg-green-600 text-white px-6 py-2 rounded-lg shadow hover:bg-green-700">
                        Shop Now
                    </a>
                </div>

                <!-- Additional Images Below the Main Content -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 md:gap-8 lg:gap-8">
                    <!-- Medicine Image 1 -->
                    <div class="bg-white h-[60%] md:h-full lg:h-full rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('/img/slider_content/slide-2.png') }}" alt="Medicine 1"
                            class="w-full h-full object-cover">
                    </div>

                    <!-- Medicine Image 2 -->
                    <div class="bg-white h-[60%] md:h-full lg:h-full rounded-lg shadow-md overflow-hidden">
                        <img src="{{ asset('/img/slider_content/slide-3.png') }}" alt="Medicine 2"
                            class="w-full h-full object-cover">
                    </div>
                </div>
            </div>

            <!-- Right Image with Height Matching the Left Content -->
            <div class="hidden md:flex lg:flex items-center justify-center ml-4">
                <img src="{{ asset('/img/slider_content/slide-4.jpg') }}" alt="Pharmacy Logo"
                    class="w-full h-full object-cover rounded-lg shadow-md">
            </div>
        </div>
    </div>

    @include('components.flash-sale');

    @include('components.consult-promo');

    @include('components.shop-by-category');

    @include('components.quality-promo');

</x-guest-layout>
