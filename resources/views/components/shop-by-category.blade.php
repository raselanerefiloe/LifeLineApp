<section class="bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-sm md:text-3xl lg:text-3xl font-bold text-green-600">Shop By Category</h2>
            <a href="{{ route('guest.category.index') }}" class="text-gray-500 hover:underline text-[8px] md:text-xl lg:text-xl">View All <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-6">
            <!-- Loop through dynamic categories -->
            @foreach ($categories as $category)
                <div class="bg-white p-4 rounded-lg shadow-[2px] md:shadow-sm lg:shadow-sm flex flex-col items-center">
                    <!-- Dynamic Image -->
                    <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-40 object-cover rounded-md">
                    
                    <!-- Dynamic Name -->
                    <h3 class="text-lg font-semibold mt-2">{{ $category->name }}</h3>
                </div>
            @endforeach
        </div>
    </div>
</section>
