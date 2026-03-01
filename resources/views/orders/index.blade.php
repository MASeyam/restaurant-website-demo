<x-layouts::app :title="__('My Orders')">
    <div class="space-y-6">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">My Orders</h1>
                <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">
                    View your recent orders and create a new one from your account.
                </p>
            </div>
            <a
                href="{{ route('orders.create') }}"
                class="inline-flex items-center rounded-lg bg-zinc-900 px-4 py-2 text-sm font-medium text-white transition hover:bg-zinc-700 dark:bg-zinc-100 dark:text-zinc-900 dark:hover:bg-zinc-300"
            >
                Create Order
            </a>
        </div>

        @if (session('status'))
            <div class="rounded-lg border border-green-500/30 bg-green-500/10 px-4 py-3 text-sm text-green-300">
                {{ session('status') }}
            </div>
        @endif

        @if ($orders->isEmpty())
            <div class="rounded-xl border border-zinc-200 bg-white p-6 text-sm text-zinc-600 dark:border-zinc-700 dark:bg-zinc-900 dark:text-zinc-300">
                You have not placed any orders yet.
                <a href="{{ route('orders.create') }}" class="font-medium text-zinc-900 underline dark:text-zinc-100">
                    Place your first order
                </a>
                .
            </div>
        @else
            <div class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-700 dark:bg-zinc-900">
                <table class="w-full divide-y divide-zinc-200 text-left text-sm dark:divide-zinc-700">
                    <thead class="bg-zinc-50 text-xs uppercase tracking-wide text-zinc-500 dark:bg-zinc-800/70 dark:text-zinc-300">
                        <tr>
                            <th class="px-4 py-3">Order</th>
                            <th class="px-4 py-3">Placed</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach ($orders as $order)
                            <tr class="text-zinc-700 dark:text-zinc-200">
                                <td class="px-4 py-3 font-medium">{{ $order->order_number }}</td>
                                <td class="px-4 py-3">{{ $order->placed_at->format('M d, Y h:i A') }}</td>
                                <td class="px-4 py-3 capitalize">{{ $order->fulfillment_type }}</td>
                                <td class="px-4 py-3 capitalize">{{ $order->status }}</td>
                                <td class="px-4 py-3">${{ number_format((float) $order->total, 2) }}</td>
                                <td class="px-4 py-3 text-right">
                                    <a
                                        href="{{ route('orders.show', $order) }}"
                                        class="text-sm font-medium text-zinc-900 underline dark:text-zinc-100"
                                    >
                                        View
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div>
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-layouts::app>
