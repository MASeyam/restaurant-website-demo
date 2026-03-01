<x-layouts::app :title="__('Create Order')">
    <div class="mx-auto max-w-4xl space-y-6">
        <div>
            <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">Create Order</h1>
            <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                Select menu items, quantities, and place your order from your account.
            </p>
        </div>

        @if ($errors->any())
            <div class="rounded-lg border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-300">
                <p class="font-semibold">Please fix the following:</p>
                <ul class="mt-1 list-disc ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('orders.store') }}" class="space-y-6">
            @csrf

            <section class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Order Type</h2>
                <div class="mt-4 flex flex-wrap gap-3 text-sm">
                    <label class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-600">
                        <input
                            type="radio"
                            name="fulfillment_type"
                            value="pickup"
                            @checked(old('fulfillment_type', 'pickup') === 'pickup')
                        >
                        <span>Pickup</span>
                    </label>
                    <label class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-zinc-300 px-3 py-2 dark:border-zinc-600">
                        <input
                            type="radio"
                            name="fulfillment_type"
                            value="delivery"
                            @checked(old('fulfillment_type') === 'delivery')
                        >
                        <span>Delivery (+$4.99 service fee)</span>
                    </label>
                </div>
            </section>

            <section class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Menu Selection</h2>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Choose one or more items and set quantities.</p>

                <div class="mt-4 grid gap-3">
                    @foreach ($menuItems as $key => $item)
                        <div class="flex flex-wrap items-center justify-between gap-3 rounded-lg border border-zinc-200 p-4 dark:border-zinc-700">
                            <label class="inline-flex items-center gap-3">
                                <input
                                    type="checkbox"
                                    name="items[{{ $key }}][selected]"
                                    value="1"
                                    @checked(old("items.{$key}.selected"))
                                >
                                <span class="text-sm">
                                    <span class="block font-medium text-zinc-900 dark:text-zinc-100">{{ $item['name'] }}</span>
                                    <span class="block text-zinc-600 dark:text-zinc-400">${{ number_format($item['price'], 2) }}</span>
                                </span>
                            </label>

                            <div class="flex items-center gap-2">
                                <label class="text-xs uppercase tracking-wide text-zinc-500">Qty</label>
                                <input
                                    type="number"
                                    min="0"
                                    max="20"
                                    name="items[{{ $key }}][quantity]"
                                    value="{{ old("items.{$key}.quantity", 1) }}"
                                    class="w-20 rounded-lg border border-zinc-300 bg-transparent px-3 py-2 text-sm dark:border-zinc-600"
                                >
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Special Notes</h2>
                <textarea
                    name="special_notes"
                    rows="4"
                    placeholder="Allergies, delivery instructions, or special requests."
                    class="mt-4 w-full rounded-lg border border-zinc-300 bg-transparent px-3 py-2 text-sm dark:border-zinc-600"
                >{{ old('special_notes') }}</textarea>
            </section>

            <div class="flex flex-wrap gap-3">
                <button
                    type="submit"
                    class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-300"
                >
                    Place Order
                </button>
                <a
                    href="{{ route('orders.index') }}"
                    class="inline-flex items-center rounded-lg border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 dark:border-zinc-600 dark:text-zinc-200"
                >
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-layouts::app>
