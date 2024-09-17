<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Categories') }}
            </h2>
            <!-- Add Category Button -->
            <a href="{{ route('admin.category.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                Add Category
            </a>
        </div>
    </x-slot>

    <!-- Category Section -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Category Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-6">
                <!-- Loop through categories -->
                @foreach ($categories as $category)
                    <div class="bg-white p-4 rounded-lg shadow-[2px] md:shadow-sm lg:shadow-sm flex flex-col items-center">
                        <!-- Category Image -->
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-40 object-cover rounded-md">
                        <!-- Category Name -->
                        <h3 class="text-lg font-semibold mt-2">{{ $category->name }}</h3>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</x-app-layout>
