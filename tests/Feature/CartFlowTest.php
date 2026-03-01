<?php

use App\Models\Order;
use App\Models\User;

test('guest can add menu item to cart', function () {
    $response = $this->post(route('cart.items.add'), [
        'item_key' => 'ember_citrus_fizz',
        'quantity' => 2,
    ]);

    $response->assertRedirect();

    $this->followRedirects($response)
        ->assertSee('Ember Citrus Fizz');
});

test('authenticated user can checkout cart and create order', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $this->post(route('cart.items.add'), [
        'item_key' => 'woodfire_chicken_supreme',
        'quantity' => 1,
    ]);

    $response = $this->post(route('cart.checkout'), [
        'fulfillment_type' => 'pickup',
        'special_notes' => 'Ring the bell once.',
    ]);

    $order = Order::query()->where('user_id', $user->id)->first();

    expect($order)->not->toBeNull();

    $response->assertRedirect(route('orders.show', $order));
    $response->assertSessionMissing('cart');

    $this->assertDatabaseHas('order_items', [
        'order_id' => $order->id,
        'item_name' => 'Woodfire Chicken Supreme',
        'quantity' => 1,
    ]);
});

test('guest cannot checkout cart without signing in', function () {
    $response = $this
        ->withSession([
            'cart' => [
                'items' => [
                    'ember_citrus_fizz' => [
                        'item_key' => 'ember_citrus_fizz',
                        'name' => 'Ember Citrus Fizz',
                        'description' => 'Orange, mint, elderflower tonic',
                        'section' => 'Drinks',
                        'unit_price' => 10.00,
                        'quantity' => 1,
                        'line_total' => 10.00,
                    ],
                ],
            ],
        ])
        ->post(route('cart.checkout'), [
            'fulfillment_type' => 'pickup',
        ]);

    $response->assertRedirect(route('login'));
});
