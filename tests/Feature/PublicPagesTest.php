<?php

test('public pages return a successful response', function (string $routeName) {
    $response = $this->get(route($routeName));

    $response->assertOk();
})->with([
    'home',
    'menu',
    'about',
    'reservations',
    'gallery',
    'contact',
]);
