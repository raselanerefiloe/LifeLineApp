<div id="cartPopup"
    class="fixed top-0 right-0 mt-16 w-80 bg-white border border-gray-200 rounded-md shadow-lg hidden z-50">
    <div class="p-4">
        @if ($cartItemCount === 0 || $cartId === 0 || $createdAt === null)
            <p class="text-sm text-gray-500">Your cart is empty.</p>
        @else
            <h3 class="text-lg font-semibold">Cart Items</h3>
            @foreach ($cartItems as $item)
                <div class="flex items-center justify-between my-2 p-2 border-b border-gray-200">
                    <img src="{{ asset($item->product->image_url) }}" alt="{{ $item->product->name }}"
                        class="w-12 h-12 object-cover rounded">
                    <div class="flex-1 ml-2">
                        <div class="text-sm font-semibold">{{ $item->product->name }}</div>
                        <div class="text-sm text-gray-500">R{{ number_format($item->product->price, 2) }}</div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="text-gray-600 hover:text-gray-900" onclick="decrementItem({{ $item->id }})">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                        <span>{{ $item->quantity }}</span>
                        <button class="text-gray-600 hover:text-gray-900" onclick="incrementItem({{ $item->id }})">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <button class="text-red-600 hover:text-red-900 ml-2" onclick="deleteItem({{ $item->id }})">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
            <div class="font-semibold">Total: R{{ number_format($total, 2) }}</div>
             <!-- Place Order Button -->
             <div class="mt-4">
                <a href="{{ route('checkout') }}"
                    class="inline-block w-full text-center text-white bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg">
                    Place Order
                </a>
            </div>
        @endif
    </div>
</div>
