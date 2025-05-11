<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pizza;
use App\Models\Topping;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())->get();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pizzas = Pizza::all();
        $toppings = Topping::all();

        return view('orders.create', compact('pizzas', 'toppings'));
    }

    public function addPizza(Request $request)
    {
        $pizza = Pizza::findOrFail($request->pizza_id);
        $size = $request->size;
        $toppings = $request->toppings ?? [];

        $price = $pizza->{$size . '_price'};

        $orderItems = session()->get('order.items', []);
        $orderItems[] = [
            'pizza_id' => $pizza->id,
            'name' => $pizza->name,
            'size' => $size,
            'toppings' => $toppings,
            'price' => $price + (count($toppings) * 0.85),
        ];

        session()->put('order.items', $orderItems);

        return back();
    }

    public function submit()
    {
        $orderItems = session()->get('order.items', []);

        $total = array_sum(array_column($orderItems, 'price'));

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_price' => $total,
        ]);

        foreach ($orderItems as $item) {
            $order->items()->create([
                'pizza_id' => $item['pizza_id'],
                'toppings' => json_encode($item['toppings']),
                'price' => $item['price'],
            ]);
        }

        session()->forget('order');

        return redirect()->route('orders.show', $order->id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('orders.index')->with('error', 'Unauthorized access');
        }

        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
