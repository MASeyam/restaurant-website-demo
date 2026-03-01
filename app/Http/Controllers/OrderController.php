<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Support\MenuCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        $orders = $request->user()
            ->orders()
            ->latest('placed_at')
            ->latest('id')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create(): View
    {
        $menuItems = MenuCatalog::items();

        return view('orders.create', compact('menuItems'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'fulfillment_type' => ['required', 'in:pickup,delivery'],
            'special_notes' => ['nullable', 'string', 'max:1000'],
            'items' => ['required', 'array'],
            'items.*.selected' => ['nullable', 'boolean'],
            'items.*.quantity' => ['nullable', 'integer', 'min:0', 'max:20'],
        ]);

        $selectedItems = $this->extractSelectedItems(Arr::get($validated, 'items', []));

        if ($selectedItems === []) {
            throw ValidationException::withMessages([
                'items' => 'Select at least one menu item with quantity greater than 0.',
            ]);
        }

        $order = $this->createOrder(
            $request,
            $selectedItems,
            $validated['fulfillment_type'],
            $validated['special_notes'] ?? null,
        );

        return redirect()
            ->route('orders.show', $order)
            ->with('status', 'Your order was placed successfully.');
    }

    public function storeFromCart(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'fulfillment_type' => ['required', 'in:pickup,delivery'],
            'special_notes' => ['nullable', 'string', 'max:1000'],
        ]);

        /** @var array<string, array<string, mixed>> $cartItems */
        $cartItems = Arr::get($request->session()->get('cart', []), 'items', []);

        if ($cartItems === []) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart is empty. Add items before checkout.',
            ]);
        }

        $selectedItems = collect($cartItems)
            ->map(function (array $item): array {
                $quantity = (int) Arr::get($item, 'quantity', 0);
                $unitPrice = (float) Arr::get($item, 'unit_price', 0);

                return [
                    'item_name' => (string) Arr::get($item, 'name', 'Item'),
                    'quantity' => $quantity,
                    'unit_price' => $unitPrice,
                    'line_total' => round($quantity * $unitPrice, 2),
                ];
            })
            ->filter(fn (array $line) => $line['quantity'] > 0)
            ->values()
            ->all();

        if ($selectedItems === []) {
            throw ValidationException::withMessages([
                'cart' => 'Your cart has invalid quantities. Please update your cart.',
            ]);
        }

        $order = $this->createOrder(
            $request,
            $selectedItems,
            $validated['fulfillment_type'],
            $validated['special_notes'] ?? null,
        );

        $request->session()->forget('cart');

        return redirect()
            ->route('orders.show', $order)
            ->with('status', 'Order placed from cart successfully.');
    }

    public function show(Request $request, Order $order): View
    {
        $order = $request->user()
            ->orders()
            ->with('items')
            ->whereKey($order->id)
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }

    /**
     * @param  array<string, array<string, mixed>>  $items
     * @return array<int, array<string, float|int|string>>
     */
    private function extractSelectedItems(array $items): array
    {
        $lines = [];

        foreach (MenuCatalog::items() as $key => $item) {
            $selected = (bool) Arr::get($items, "{$key}.selected", false);
            $quantity = (int) Arr::get($items, "{$key}.quantity", 0);

            if (! $selected || $quantity < 1) {
                continue;
            }

            $lineTotal = round($item['price'] * $quantity, 2);

            $lines[] = [
                'item_name' => $item['name'],
                'quantity' => $quantity,
                'unit_price' => $item['price'],
                'line_total' => $lineTotal,
            ];
        }

        return $lines;
    }

    /**
     * @param  array<int, array<string, float|int|string>>  $selectedItems
     */
    private function createOrder(Request $request, array $selectedItems, string $fulfillmentType, ?string $specialNotes): Order
    {
        $subtotal = collect($selectedItems)->sum('line_total');
        $serviceFee = $fulfillmentType === 'delivery' ? 4.99 : 0.0;
        $tax = round($subtotal * 0.1, 2);
        $total = round($subtotal + $serviceFee + $tax, 2);

        $order = $request->user()->orders()->create([
            'order_number' => $this->generateOrderNumber(),
            'status' => 'pending',
            'fulfillment_type' => $fulfillmentType,
            'subtotal' => $subtotal,
            'service_fee' => $serviceFee,
            'tax' => $tax,
            'total' => $total,
            'special_notes' => $specialNotes,
            'placed_at' => now(),
        ]);

        $order->items()->createMany($selectedItems);

        return $order;
    }

    private function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-'.now()->format('Ymd').'-'.str_pad((string) random_int(0, 99999), 5, '0', STR_PAD_LEFT);
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }
}
