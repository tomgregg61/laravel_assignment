<x-app-layout>
    <div class="max-w-4xl mx-auto p-4">
        <h2 class="text-2xl font-bold mb-4">Create Order</h2>

        <div class="flex space-x-4">
            <!-- Pizza List -->
            <div class="w-1/2">
                <h3 class="text-xl font-semibold mb-2">Pizzas</h3>
                @foreach($pizzas as $pizza)
                <form method="POST" action="{{ route('orders.addPizza') }}" class="mb-4 p-2 border rounded">
                    @csrf
                    <h4 class="font-bold">{{ $pizza->name }}</h4>
                    <p>Base: {{ $pizza->base_toppings }}</p>

                    <div>
                        <label>
                            <input type="radio" name="size" value="small">
                            Small - £{{ number_format($pizza->small_price, 2) }}
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="size" value="medium">
                            Medium - £{{ number_format($pizza->medium_price, 2) }}
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="size" value="large">
                            Large - £{{ number_format($pizza->large_price, 2) }}
                        </label>
                    </div>

                    <div class="mt-2">
                        <label>Select Extra Toppings:</label>
                        @foreach($toppings as $topping)
                        <div>
                            <input type="checkbox" name="toppings[]" value="{{ $topping->name }}">
                            {{ $topping->name }} (+£0.85)
                        </div>
                        @endforeach
                    </div>

                    <input type="hidden" name="pizza_id" value="{{ $pizza->id }}">
                    <button type="submit" class="mt-2 bg-green-500 text-black py-1 px-3 rounded-lg">Add to Order</button>
                </form>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="w-1/2">
                <h3 class="text-xl font-semibold mb-2">Order Summary</h3>
                @php $total = 0; @endphp
                @if(session()->has('order.items'))
                @foreach(session('order.items') as $item)
                <div class="p-2 border-b">
                    <p>{{ $item['name'] }} - £{{ number_format($item['price'], 2) }}</p>
                    <p>Toppings: {{ implode(', ', $item['toppings']) }}</p>
                    @php $total += $item['price']; @endphp
                </div>
                @endforeach
                <p class="font-bold mt-2">Total: £{{ number_format($total, 2) }}</p>
                <form method="POST" action="{{ route('orders.submit') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white py-1 px-3 rounded">Submit Order</button>
                </form>
                @else
                <p>No items added to the order yet.</p>
                @endif
                <!-- Cancel Order Button -->
                @if(session()->has('order.items'))
                <form method="POST" action="{{ route('orders.cancel') }}" class="mt-4">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded">Cancel Order</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>