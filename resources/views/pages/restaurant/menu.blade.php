<x-layouts.restaurant
    title="Ember and Thyme | Menu"
    description="Restaurant menu page with structured sections and polished placeholder dishes."
>
    @php
        $menuSections = \App\Support\MenuCatalog::sections();
    @endphp

    <section class="restaurant-panel p-8 lg:p-10">
        <p class="restaurant-eyebrow">Menu Preview</p>
        <h1 class="restaurant-display mt-4 text-5xl text-amber-50 sm:text-6xl">Seasonal Menu</h1>
        <p class="mt-4 max-w-2xl text-base text-stone-300">
            The dishes below are polished placeholders. Replace names, ingredients, and prices once your final menu is
            approved.
        </p>
    </section>

    <section class="mt-6 grid gap-5 xl:grid-cols-2">
        @foreach ($menuSections as $sectionName => $items)
            <article class="restaurant-panel p-6">
                <h2 class="restaurant-display text-3xl text-amber-100">{{ $sectionName }}</h2>
                <div class="mt-5 space-y-4">
                    @foreach ($items as $item)
                        <div class="rounded-xl border border-white/10 bg-black/25 p-4">
                            <div class="flex items-start justify-between gap-3">
                                <h3 class="text-base font-semibold text-stone-100">{{ $item['name'] }}</h3>
                                <span class="text-sm text-amber-300">${{ number_format((float) $item['price'], 2) }}</span>
                            </div>
                            <p class="mt-2 text-sm text-stone-300">{{ $item['desc'] }}</p>
                            <form method="post" action="{{ route('cart.items.add') }}" class="mt-3 flex items-center gap-2">
                                @csrf
                                <input type="hidden" name="item_key" value="{{ $item['key'] }}">
                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="20"
                                    value="1"
                                    class="restaurant-input w-20 px-3 py-1.5 text-sm"
                                >
                                <button type="submit" class="restaurant-button restaurant-button-primary px-3 py-2 text-xs">
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </article>
        @endforeach
    </section>
</x-layouts.restaurant>
