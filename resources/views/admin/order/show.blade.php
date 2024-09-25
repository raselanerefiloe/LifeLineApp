<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order Details - Order ID: ' . $order->id) }}
        </h2>
    </x-slot>
    <!-- Back Button -->
    <div class="m-auto lmd:ml-40 g:ml-40">
        <a href="{{ route('admin.order.index') }}" class="text-green-600 hover:underline">
            &larr; Back to Orders
        </a>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Order Summary -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-800">Order Summary</h3>
                        <div class="mt-2">
                            <p><strong>Customer Name:</strong> {{ $order->user->name }}</p>
                            <p><strong>Email:</strong> {{ $order->user->email }}</p>
                            <p><strong>Phone:</strong> {{ $order->user->phone ?? 'N/A' }}</p>
                            <p><strong>Total Amount:</strong> R{{ number_format($order->total, 2) }}</p>
                            <p><strong>Status:</strong> 
                                @if ($order->status === 'pending')
                                    <span class="text-yellow-500">Pending</span>
                                @elseif ($order->status === 'processing')
                                    <span class="text-blue-500">Processing</span>
                                @elseif ($order->status === 'on the way')
                                    <span class="text-green-500">On the Way</span>
                                @elseif ($order->status === 'completed')
                                    <span class="text-gray-500">Completed</span>
                                @else
                                    <span class="text-red-500">Unknown Status</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="mb-6">
                        <h3 class="text-lg font-medium text-gray-800">Items Ordered</h3>
                        <ul class="divide-y divide-gray-200 mt-2">
                            @foreach ($order->orderItems as $item)
                                <li class="flex items-center justify-between py-4">
                                    <div class="flex items-center space-x-2">
                                        <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="h-16 w-16 object-cover rounded-md">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                            <p class="text-sm text-gray-500">{{ $item->pack_size }}</p>
                                            <p class="text-sm text-gray-600">R{{ number_format($item->price, 2) }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex space-x-4 mt-6">
                        <a href="{{ route('admin.order.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-800 transition">
                            Back to Orders
                        </a>
                        <x-confirm-delete 
                            :title="'Delete Order'"
                            :message="'Are you sure you want to delete this order?'"
                            :action="route('admin.order.destroy', $order->id)"
                            :triggerText="'Delete Order'"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function closeAlert() {
            document.getElementById('success-message').style.display = 'none';
        }
    </script>
</x-app-layout>
