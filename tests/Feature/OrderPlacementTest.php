<?php
use App\Models\User;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderPlacementTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_place_an_order()
    {
        // Create a test user
        $user = User::factory()->create();

        // Define the order data (adjust fields as necessary)
        $orderData = [
            'user_id' => $user->id, // assuming each order is associated with a user
            'order_type' => 'delivery', // or 'collection'
            'total_price' => 100.00, // or however your total price is calculated
            'delivery_address' => '123 Test St, Test City', // delivery address for delivery orders
            'items' => json_encode([ // list of items in the order
                ['product_id' => 1, 'quantity' => 2], // example product and quantity
                ['product_id' => 2, 'quantity' => 1]
            ]),
            'status' => 'pending', // order status, e.g., 'pending'
        ];

        // Make a post request to the order placement route (adjust route name if needed)
        $response = $this->actingAs($user)->post('/orders', $orderData);

        // Check if the response is a redirect to the order's page (adjust route if needed)
        $response->assertRedirect('/orders/'.$user->id);

        // Check that the order was created in the database
        $this->assertDatabaseHas('orders', [
            'user_id' => $user->id,
            'total_price' => 100.00,
            'order_type' => 'delivery',
            'status' => 'pending',
        ]);

        // Optionally, you can also check for the items if needed
        $this->assertDatabaseHas('order_items', [
            'order_id' => 1, // assumes the order ID is 1; adjust based on your DB structure
            'product_id' => 1,
            'quantity' => 2,
        ]);
    }
}