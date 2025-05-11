<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Pizza name
            $table->json('base_toppings'); // Base toppings (like cheese, tomato sauce)
            $table->json('additional_toppings')->nullable(); // Additional toppings
            $table->decimal('small_price', 8, 2); // Small pizza price
            $table->decimal('medium_price', 8, 2); // Medium pizza price
            $table->decimal('large_price', 8, 2); // Large pizza price
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizzas');
    }
};
