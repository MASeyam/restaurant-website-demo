<?php

use App\Models\Order;
use App\Models\User;

test('guests are redirected when trying to access orders', function () {
    $response = $this->get(route('orders.index'));

    $response->assertRedirect(route('login'));
});

test('authenticated users can place an order from their account', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $payload = [
        'fulfillment_type' => 'pickup',
        'special_notes' => 'No peanuts, please.',
        'items' => [
            'woodfire_chicken_supreme' => ['selected' => '1', 'quantity' => 2],
            'ember_citrus_fizz' => ['selected' => '1', 'quantity' => 1],
        ],
    ];

    $response = $this->post(route('orders.store'), $payload);

    $order = Order::query()->where('user_id', $user->id)->first();

    expect($order)->not->toBeNull();

    $response->assertRedirect(route('orders.show', $order));

    $this->assertDatabaseHas('orders', [
        'id' => $order->id,
        'user_id' => $user->id,
        'fulfillment_type' => 'pickup',
        'status' => 'pending',
    ]);

    $this->assertDatabaseHas('order_items', [
        'order_id' => $order->id,
        'item_name' => 'Woodfire Chicken Supreme',
        'quantity' => 2,
    ]);
});

test('users cannot view another users order', function () {
    $owner = User::factory()->create();
    $otherUser = User::factory()->create();

    $order = Order::query()->create([
        'user_id' => $owner->id,
        'order_number' => 'ORD-20260301-99999',
        'status' => 'pending',
        'fulfillment_type' => 'pickup',
        'subtotal' => 34.00,
        'service_fee' => 0.00,
        'tax' => 3.40,
        'total' => 37.40,
        'special_notes' => null,
        'placed_at' => now(),
    ]);

    $order->items()->create([
        'item_name' => 'Charred Sea Bass',
        'quantity' => 1,
        'unit_price' => 34.00,
        'line_total' => 34.00,
    ]);

    $this->actingAs($otherUser);

    $response = $this->get(route('orders.show', $order));

    $response->assertNotFound();
});
