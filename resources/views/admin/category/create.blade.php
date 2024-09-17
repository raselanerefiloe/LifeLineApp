<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Category') }}
            </h2>
        </div>
    </x-slot>

    <!-- Category Creation Form -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Category Name Input -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold">Category Name</label>
                        <input type="text" id="name" name="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" placeholder="Enter category name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Image Input -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-semibold">Category Image</label>
                        <input type="file" id="image" name="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*" required>
                        @error('image')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-[#63C186] text-white px-4 py-2 rounded-md hover:bg-green-600 transition">
                            Add Category
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
