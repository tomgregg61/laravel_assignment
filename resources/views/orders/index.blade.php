<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-semibold">Your Orders</h1>

        <ul class="mt-6">
            @foreach ($orders as $order)
            <li class="mb-4">
                <a href="{{ route('orders.show', $order->id) }}" class="text-blue-500 hover:text-blue-700">
                    Order #{{ $order->id }} - Total: £{{ number_format($order->total_price, 2) }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
</x-app-layout>