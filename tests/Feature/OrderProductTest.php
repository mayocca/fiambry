<?php

use App\Models\Order;
use App\Models\Product;
use App\Models\User;


beforeEach(function () {
    $this->user = User::factory()->create();
    $this->order = Order::factory()->create(['user_id' => $this->user->id]);
    $this->allowedProducts = Product::factory()->count(3)->create();
    $this->order->allowedProducts()->sync($this->allowedProducts);
});

it('can add a product to an order if the product is allowed', function () {
    $this->actingAs($this->user);
    $productToAdd = $this->allowedProducts->first();

    $response = $this->post(route('orders.products.store', $this->order), [
        'products' => [
            ['id' => $productToAdd->id, 'quantity' => 2],
        ],
    ]);

    $response->assertSessionHas('success', 'Products saved.');
    $response->assertRedirect();

    expect($this->order->products->pluck('id'))
        ->toContain($productToAdd->id);
});

it('cannot add a product to an order if the product is not allowed', function () {
    $this->actingAs($this->user);
    $notAllowedProduct = Product::factory()->create();

    $response = $this->post(route('orders.products.store', $this->order), [
        'products' => [
            ['id' => $notAllowedProduct->id, 'quantity' => 2],
        ],
    ]);

    $response->assertSessionHasErrors();
    $response->assertRedirect();

    expect($this->order->products->pluck('id'))
        ->not->toContain($notAllowedProduct->id);
});

it('can update the quantity of an existing product in an order', function () {
    $this->actingAs($this->user);

    $productToUpdate = $this->allowedProducts->first();
    $this->order->products()->attach($productToUpdate, [
        'user_id' => $this->user->id,
        'quantity' => 2,
    ]);

    $response = $this->put(route('orders.products.update', [$this->order, $productToUpdate]), [
        'quantity' => 3,
    ]);

    $response->assertSessionHas('success', 'Product updated.');
    $response->assertRedirect();

    expect($this->order->fresh()->products->where('id', $productToUpdate->id)->first()->pivot->quantity)
        ->toBe(3);
});

it('can remove a product from an order', function () {
    $this->actingAs($this->user);

    $productToRemove = $this->allowedProducts->last();
    $this->order->products()->attach($productToRemove, [
        'user_id' => $this->user->id,
        'quantity' => 2,
    ]);

    $response = $this->delete(route('orders.products.destroy', [$this->order, $productToRemove]));

    $response->assertSessionHas('success', 'Product removed from order.');
    $response->assertRedirect();

    expect($this->order->fresh()->products)
        ->not->toContain($productToRemove);
});
