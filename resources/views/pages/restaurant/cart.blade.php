<x-layouts.restaurant
    title="Ember and Thyme | Cart"
    description="Review your cart and checkout into your account order."
>
    <section class="restaurant-panel p-8 lg:p-10">
        <p class="restaurant-eyebrow">Your Cart</p>
        <h1 class="restaurant-display mt-4 text-5xl text-amber-50 sm:text-6xl">Ready to Checkout</h1>
        <p class="mt-4 max-w-2xl text-base text-stone-300">
            Add dishes from menu, adjust quantity, then place your order from your account.
        </p>
    </section>

    @if ($errors->any())
        <div class="mt-6 rounded-xl border border-red-500/40 bg-red-500/10 p-4 text-sm text-red-200">
            <p class="font-semibold">Please fix the following:</p>
            <ul class="mt-2 list-disc ps-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($cart['items'] === [])
        <section class="mt-6 restaurant-panel p-8">
            <p class="text-stone-300">Your cart is empty.</p>
            <a href="{{ route('menu') }}" class="restaurant-button restaurant-button-primary mt-4">Browse Menu</a>
        </section>
    @else
        <section class="mt-6 grid gap-6 lg:grid-cols-[1.4fr_1fr]">
            <div class="space-y-4">
                @foreach ($cart['items'] as $item)
                    <article class="restaurant-panel p-5">
                        <div class="flex flex-wrap items-start justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-semibold text-stone-100">{{ $item['name'] }}</h2>
                                <p class="text-sm text-stone-300">{{ $item['description'] }}</p>
                            </div>
                            <p class="text-sm text-amber-300">${{ number_format((float) $item['line_total'], 2) }}</p>
                        </div>
                        <div class="mt-4 flex flex-wrap items-center gap-2">
                            <form method="post" action="{{ route('cart.items.update', $item['item_key']) }}" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <label class="text-xs uppercase tracking-[0.2em] text-stone-400">Qty</label>
                                <input
                                    type="number"
                                    name="quantity"
                                    min="0"
                                    max="20"
                                    value="{{ $item['quantity'] }}"
                                    class="restaurant-input w-20 px-3 py-1.5 text-sm"
                                >
                                <button type="submit" class="restaurant-button restaurant-button-ghost px-3 py-2 text-xs">
                                    Update
                                </button>
                            </form>

                            <form method="post" action="{{ route('cart.items.remove', $item['item_key']) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="restaurant-button restaurant-button-ghost px-3 py-2 text-xs">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </article>
                @endforeach

                <form method="post" action="{{ route('cart.clear') }}">
                    @csrf
                    <button type="submit" class="restaurant-button restaurant-button-ghost px-3 py-2 text-xs">
                        Clear Cart
                    </button>
                </form>
            </div>

            <aside class="restaurant-panel p-6 lg:p-7">
                <h2 class="restaurant-display text-3xl text-amber-100">Order Summary</h2>
                <div class="mt-5 space-y-3 text-sm">
                    <div class="restaurant-list-row">
                        <span>Items</span>
                        <span>{{ $totals['quantity'] }}</span>
                    </div>
                    <div class="restaurant-list-row">
                        <span>Subtotal</span>
                        <span>${{ number_format((float) $totals['subtotal'], 2) }}</span>
                    </div>
                </div>

                @auth
                    <form method="post" action="{{ route('cart.checkout') }}" class="mt-6 space-y-4">
                        @csrf
                        <label class="restaurant-field">
                            <span>Fulfillment</span>
                            <select name="fulfillment_type" class="restaurant-input">
                                <option value="pickup" @selected(old('fulfillment_type', 'pickup') === 'pickup')>Pickup</option>
                                <option value="delivery" @selected(old('fulfillment_type') === 'delivery')>Delivery (+$4.99)</option>
                            </select>
                        </label>
                        <label class="restaurant-field">
                            <span>Notes</span>
                            <textarea name="special_notes" rows="3" class="restaurant-input" placeholder="Allergies or delivery notes">{{ old('special_notes') }}</textarea>
                        </label>
                        <button type="submit" class="restaurant-button restaurant-button-primary w-full justify-center">
                            Place Order
                        </button>
                        <p class="text-xs text-stone-400">Tax is calculated during checkout.</p>
                    </form>
                @else
                    <div class="mt-6 space-y-3">
                        <p class="text-sm text-stone-300">Sign in to place this order with your account.</p>
                        <a href="{{ route('login') }}" class="restaurant-button restaurant-button-primary w-full justify-center">
                            Sign In to Checkout
                        </a>
                    </div>
                @endauth
            </aside>
        </section>
    @endif
</x-layouts.restaurant>
