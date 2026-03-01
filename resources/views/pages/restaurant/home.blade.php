<x-layouts.restaurant
    title="Ember and Thyme | Home"
    description="A refined restaurant landing page with menu highlights, service promises, and reservation prompts."
>
    <section class="grid gap-6 lg:grid-cols-[1.35fr_1fr]">
        <article class="restaurant-panel p-8 lg:p-10">
            <p class="restaurant-eyebrow">Seasonal Mediterranean Kitchen</p>
            <h1 class="restaurant-display mt-4 text-5xl leading-tight text-amber-50 sm:text-6xl">
                A table worth slowing down for.
            </h1>
            <p class="mt-5 max-w-2xl text-base text-stone-300 sm:text-lg">
                Ember and Thyme is where live-fire flavors meet modern comfort. This version uses premium placeholder
                content until your full brand story and final menu are ready.
            </p>
            <div class="mt-8 flex flex-wrap items-center gap-3">
                <a href="{{ route('reservations') }}" class="restaurant-button restaurant-button-primary">
                    Reserve Tonight
                </a>
                <a href="{{ route('menu') }}" class="restaurant-button restaurant-button-ghost">
                    Explore Menu
                </a>
            </div>
        </article>

        <aside class="restaurant-panel p-6 sm:p-8">
            <p class="restaurant-eyebrow">Tonight at Ember and Thyme</p>
            <div class="mt-6 space-y-4 text-sm">
                <div class="restaurant-list-row">
                    <span>Chef's tasting</span>
                    <span>$72 per guest</span>
                </div>
                <div class="restaurant-list-row">
                    <span>Live jazz session</span>
                    <span>8:00 PM</span>
                </div>
                <div class="restaurant-list-row">
                    <span>Happy hour</span>
                    <span>4:00 PM to 6:00 PM</span>
                </div>
                <div class="restaurant-list-row">
                    <span>Private dining</span>
                    <span>Up to 20 guests</span>
                </div>
            </div>
            <a href="{{ route('contact') }}" class="mt-7 inline-flex text-sm text-amber-200 hover:text-amber-100">
                Plan a private event ->
            </a>
        </aside>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        <article class="restaurant-panel p-5">
            <p class="text-xs uppercase tracking-[0.2em] text-stone-400">Fresh Daily</p>
            <p class="mt-2 text-sm text-stone-300">Ingredients sourced from nearby farms each morning.</p>
        </article>
        <article class="restaurant-panel p-5">
            <p class="text-xs uppercase tracking-[0.2em] text-stone-400">Open Kitchen</p>
            <p class="mt-2 text-sm text-stone-300">Watch every dish finished over charcoal and herbs.</p>
        </article>
        <article class="restaurant-panel p-5">
            <p class="text-xs uppercase tracking-[0.2em] text-stone-400">Craft Pairings</p>
            <p class="mt-2 text-sm text-stone-300">Natural wines and signature mocktails for every course.</p>
        </article>
        <article class="restaurant-panel p-5">
            <p class="text-xs uppercase tracking-[0.2em] text-stone-400">Fast Booking</p>
            <p class="mt-2 text-sm text-stone-300">Simple online reservations and quick confirmation.</p>
        </article>
    </section>

    @php
        $signatures = [
            ['name' => 'Charred Sea Bass', 'desc' => 'Fennel puree, lemon butter, crispy capers', 'price' => '$34'],
            ['name' => 'Smoked Lamb Shoulder', 'desc' => 'Rosemary glaze, saffron couscous, jus', 'price' => '$39'],
            ['name' => 'Burnt Citrus Tart', 'desc' => 'Caramelized orange, almond cream, sea salt', 'price' => '$14'],
        ];
    @endphp

    <section class="mt-12">
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="restaurant-eyebrow">Signature Selections</p>
                <h2 class="restaurant-display mt-3 text-4xl text-amber-100">Crowd Favorites</h2>
            </div>
            <a href="{{ route('menu') }}" class="text-sm text-amber-200 hover:text-amber-100">View full menu -></a>
        </div>
        <div class="mt-6 grid gap-4 lg:grid-cols-3">
            @foreach ($signatures as $dish)
                <article class="restaurant-panel p-6">
                    <div class="flex items-start justify-between gap-3">
                        <h3 class="restaurant-display text-2xl text-amber-100">{{ $dish['name'] }}</h3>
                        <p class="text-sm text-amber-300">{{ $dish['price'] }}</p>
                    </div>
                    <p class="mt-3 text-sm text-stone-300">{{ $dish['desc'] }}</p>
                </article>
            @endforeach
        </div>
    </section>
</x-layouts.restaurant>
