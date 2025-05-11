<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Order Details</h2>

        <div class="bg-white p-4 rounded shadow-lg">
            <h3 class="text-xl font-semibold mb-2">Order #{{ $order->id }}</h3>
            <p><strong>Status:</strong> {{ $order->status }}</p>
            <p><strong>Total Price:</strong> £{{ number_format($order->total_price, 2) }}</p>
            <p><strong>Order Type:</strong> {{ ucfirst($order->order_type) }}</p>

            <h4 class="text-lg mt-4 mb-2">Ordered Items</h4>
            @foreach($order->items as $item)
            <div>
                <p>{{ $item->pizza->name }} - £{{ number_format($item->price, 2) }}</p>
                <p>Toppings: {{ implode(', ', json_decode($item->toppings)) }}</p>
            </div>
            @endforeach

            <form method="POST" action="{{ route('orders.reorder', $order->id) }}" class="mt-4">
                @csrf
                <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded">Re-order</button>
            </form>
        </div>
    </div>
</x-app-layout>