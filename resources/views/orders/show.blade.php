<x-layouts::app :title="__('Order Details')">
    <div class="mx-auto max-w-4xl space-y-6">
        <div class="flex flex-wrap items-start justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                    Order {{ $order->order_number }}
                </h1>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    Placed {{ $order->placed_at->format('M d, Y h:i A') }}
                </p>
            </div>
            <a
                href="{{ route('orders.index') }}"
                class="inline-flex items-center rounded-lg border border-zinc-300 px-4 py-2 text-sm font-medium text-zinc-700 dark:border-zinc-600 dark:text-zinc-200"
            >
                Back to Orders
            </a>
        </div>

        <section class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <div class="grid gap-3 text-sm sm:grid-cols-3">
                <div>
                    <p class="text-zinc-500 dark:text-zinc-400">Status</p>
                    <p class="mt-1 font-medium capitalize text-zinc-900 dark:text-zinc-100">{{ $order->status }}</p>
                </div>
                <div>
                    <p class="text-zinc-500 dark:text-zinc-400">Type</p>
                    <p class="mt-1 font-medium capitalize text-zinc-900 dark:text-zinc-100">{{ $order->fulfillment_type }}</p>
                </div>
                <div>
                    <p class="text-zinc-500 dark:text-zinc-400">Total</p>
                    <p class="mt-1 font-medium text-zinc-900 dark:text-zinc-100">${{ number_format((float) $order->total, 2) }}</p>
                </div>
            </div>
        </section>

        <section class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
            <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Items</h2>
            <div class="mt-4 overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-700">
                <table class="w-full divide-y divide-zinc-200 text-left text-sm dark:divide-zinc-700">
                    <thead class="bg-zinc-50 text-xs uppercase tracking-wide text-zinc-500 dark:bg-zinc-800/70 dark:text-zinc-300">
                        <tr>
                            <th class="px-4 py-3">Item</th>
                            <th class="px-4 py-3">Qty</th>
                            <th class="px-4 py-3">Unit Price</th>
                            <th class="px-4 py-3">Line Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach ($order->items as $item)
                            <tr class="text-zinc-700 dark:text-zinc-200">
                                <td class="px-4 py-3">{{ $item->item_name }}</td>
                                <td class="px-4 py-3">{{ $item->quantity }}</td>
                                <td class="px-4 py-3">${{ number_format((float) $item->unit_price, 2) }}</td>
                                <td class="px-4 py-3">${{ number_format((float) $item->line_total, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-5 ms-auto max-w-xs space-y-2 text-sm">
                <div class="flex items-center justify-between">
                    <span class="text-zinc-600 dark:text-zinc-400">Subtotal</span>
                    <span class="text-zinc-900 dark:text-zinc-100">${{ number_format((float) $order->subtotal, 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-zinc-600 dark:text-zinc-400">Service Fee</span>
                    <span class="text-zinc-900 dark:text-zinc-100">${{ number_format((float) $order->service_fee, 2) }}</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-zinc-600 dark:text-zinc-400">Tax</span>
                    <span class="text-zinc-900 dark:text-zinc-100">${{ number_format((float) $order->tax, 2) }}</span>
                </div>
                <div class="flex items-center justify-between border-t border-zinc-200 pt-2 text-base font-semibold dark:border-zinc-700">
                    <span>Total</span>
                    <span>${{ number_format((float) $order->total, 2) }}</span>
                </div>
            </div>
        </section>

        @if ($order->special_notes)
            <section class="rounded-xl border border-zinc-200 bg-white p-6 dark:border-zinc-700 dark:bg-zinc-900">
                <h2 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Special Notes</h2>
                <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-300">{{ $order->special_notes }}</p>
            </section>
        @endif
    </div>
</x-layouts::app>
