<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">Our Pizzas</h2>

        @foreach($pizzas as $pizza)
        <div class="border-b py-4">
            <h3 class="text-xl font-semibold">{{ $pizza->name }}</h3>
            <p class="text-sm text-gray-600">
                <strong>Base Toppings:</strong> {{ implode(', ', json_decode($pizza->base_toppings)) }}
            </p>
            <p class="text-sm text-gray-600">
                <strong>Additional Toppings:</strong> {{ implode(', ', json_decode($pizza->additional_toppings)) }}
            </p>
            <div class="mt-2">
                <span class="text-sm">Small: £{{ $pizza->small_price }}</span> |
                <span class="text-sm">Medium: £{{ $pizza->medium_price }}</span> |
                <span class="text-sm">Large: £{{ $pizza->large_price }}</span>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>