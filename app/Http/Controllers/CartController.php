<?php

namespace App\Http\Controllers;

use App\Support\MenuCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(Request $request): View
    {
        $cart = $this->cart($request);
        $totals = $this->totals($cart['items']);

        return view('pages.restaurant.cart', [
            'cart' => $cart,
            'totals' => $totals,
        ]);
    }

    public function add(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'item_key' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1', 'max:20'],
        ]);

        $menuItem = MenuCatalog::find($validated['item_key']);

        if (! $menuItem) {
            return back()->with('cart_error', 'That menu item is not available.');
        }

        $cart = $this->cart($request);
        $key = $menuItem['key'];
        $existingQty = (int) Arr::get($cart, "items.{$key}.quantity", 0);
        $qty = min(20, $existingQty + (int) $validated['quantity']);
        $price = (float) $menuItem['price'];

        $cart['items'][$key] = [
            'item_key' => $key,
            'name' => $menuItem['name'],
            'description' => $menuItem['desc'],
            'section' => $menuItem['section'],
            'unit_price' => $price,
            'quantity' => $qty,
            'line_total' => round($qty * $price, 2),
        ];

        $request->session()->put('cart', $cart);

        return back()->with('cart_status', "{$menuItem['name']} added to cart.");
    }

    public function update(Request $request, string $itemKey): RedirectResponse
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:0', 'max:20'],
        ]);

        $cart = $this->cart($request);
        $item = Arr::get($cart, "items.{$itemKey}");

        if (! is_array($item)) {
            return back()->with('cart_error', 'Item not found in cart.');
        }

        $qty = (int) $validated['quantity'];

        if ($qty === 0) {
            unset($cart['items'][$itemKey]);
            $request->session()->put('cart', $cart);

            return back()->with('cart_status', 'Item removed from cart.');
        }

        $unitPrice = (float) Arr::get($item, 'unit_price', 0);
        $cart['items'][$itemKey]['quantity'] = $qty;
        $cart['items'][$itemKey]['line_total'] = round($qty * $unitPrice, 2);

        $request->session()->put('cart', $cart);

        return back()->with('cart_status', 'Cart updated.');
    }

    public function remove(Request $request, string $itemKey): RedirectResponse
    {
        $cart = $this->cart($request);

        if (! isset($cart['items'][$itemKey])) {
            return back()->with('cart_error', 'Item not found in cart.');
        }

        unset($cart['items'][$itemKey]);
        $request->session()->put('cart', $cart);

        return back()->with('cart_status', 'Item removed from cart.');
    }

    public function clear(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');

        return back()->with('cart_status', 'Cart cleared.');
    }

    /**
     * @return array{items: array<string, array<string, float|int|string>>}
     */
    private function cart(Request $request): array
    {
        return [
            'items' => Arr::get($request->session()->get('cart', []), 'items', []),
        ];
    }

    /**
     * @param  array<string, array<string, float|int|string>>  $items
     * @return array{subtotal: float, quantity: int}
     */
    private function totals(array $items): array
    {
        $subtotal = round((float) collect($items)->sum(fn (array $item) => (float) $item['line_total']), 2);
        $quantity = (int) collect($items)->sum(fn (array $item) => (int) $item['quantity']);

        return [
            'subtotal' => $subtotal,
            'quantity' => $quantity,
        ];
    }
}
