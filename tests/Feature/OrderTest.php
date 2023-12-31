<?php

use App\Models\Order;
use App\Models\User;
use App\Models\Product;

it('creates an order and associates allowed products', function () {
    // Given: An authenticated user and some products
    $user = User::factory()->create();
    $products = Product::factory()->count(3)->make();

    // Setup user to be authenticated
    $this->actingAs($user);

    // When: We hit the store route for the order with a set of allowed products
    $response = $this->post(route('orders.store'), [
        'allowed_products' => $products->map(fn (Product $product) => ['name' => $product->name])->toArray(),
    ]);

    // Then: The order should be created and associated with the given products
    $response->assertRedirect();  // Assert that there's a redirect (e.g., to orders.show)
    $response->assertSessionHas('success', 'Order created.');

    $order = Order::first();
    expect($order->allowedProducts)->toHaveCount(3);

    $allowedProductNames = $order->allowedProducts->pluck('name')->toArray();
    foreach ($products as $product) {
        expect($allowedProductNames)->toContain($product->name);
    }
});
