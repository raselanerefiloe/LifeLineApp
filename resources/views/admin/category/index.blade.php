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
    <script>
        function closeAlert() {
            document.getElementById('success-message').style.display = 'none';
        }
    </script>
</x-app-layout>
