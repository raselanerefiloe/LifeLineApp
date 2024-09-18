<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add New Category') }}
            </h2>
        </div>
    </x-slot>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Category Creation Form -->
    <section class="bg-gray-100 py-8">
        <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                <form id="categoryForm" action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Category Name Input -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-semibold">Category Name</label>
                        <input type="text" id="name" name="name"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Enter category name" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category Image Input -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 font-semibold">Category Image</label>
                        <input type="file" id="image" name="image"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" accept="image/*" required>
                        @error('image')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button id="submitBtn" type="submit"
                            class="bg-[#63C186] text-white px-4 py-2 rounded-md hover:bg-green-600 transition flex items-center justify-center">
                            <span id="submitText">Add Category</span>
                            <!-- Spinner (initially hidden) -->
                            <svg id="spinner" class="hidden animate-spin h-5 w-5 ml-2 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.961 7.961 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Add JavaScript to handle the loading state -->
    <script>
        document.getElementById('categoryForm').addEventListener('submit', function(event) {
            var submitBtn = document.getElementById('submitBtn');
            var submitText = document.getElementById('submitText');
            var spinner = document.getElementById('spinner');

            // Disable the submit button
            submitBtn.disabled = true;
            
            // Change the button text to show saving state and display the spinner
            submitText.textContent = 'saving...';
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
