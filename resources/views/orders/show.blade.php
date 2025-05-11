<x-app-layout>
    <div class="max-w-7xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-semibold">Order #{{ $order->id }} Details</h1>

        <p class="mt-4">Total Price: £{{ number_format($order->total_price, 2) }}</p>

        <h2 class="mt-6 text-lg font-semibold">Items:</h2>
        <ul class="mt-4">
            @foreach ($order->items as $item)
            <li class="mb-2">
                <p>Pizza: {{ $item->pizza->name }}</p>
                <p>Toppings: {{ implode(', ', json_decode($item->toppings)) }}</p>
                <p>Price: £{{ number_format($item->price, 2) }}</p>
            </li>
            @endforeach
        </ul>

        <div class="mt-6">
            <a href="{{ route('orders.index') }}" class="text-blue-500 hover:text-blue-700">Back to Orders</a>
        </div>
    </div>
</x-app-layout>