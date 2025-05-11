<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h2 class="text-2xl font-bold mb-4">Available Toppings</h2>
        <ul>
            @foreach ($toppings as $topping)
            <li>{{ $topping->name }} - £{{ number_format($topping->price, 2) }}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>