<x-layouts.restaurant
    title="Ember and Thyme | Gallery"
    description="Gallery page featuring atmosphere and dish presentation placeholders."
>
    @php
        $tiles = [
            ['title' => 'Open Flame Kitchen', 'gradient' => 'linear-gradient(140deg, rgba(245, 158, 11, 0.86), rgba(234, 88, 12, 0.55), rgba(28, 25, 23, 0.92))'],
            ['title' => 'Evening Dining Room', 'gradient' => 'linear-gradient(140deg, rgba(225, 29, 72, 0.62), rgba(87, 83, 78, 0.5), rgba(3, 7, 18, 0.92))'],
            ['title' => 'Chef Plating Service', 'gradient' => 'linear-gradient(140deg, rgba(5, 150, 105, 0.62), rgba(15, 118, 110, 0.5), rgba(10, 10, 10, 0.92))'],
            ['title' => 'Dessert Pass', 'gradient' => 'linear-gradient(140deg, rgba(190, 24, 93, 0.58), rgba(157, 23, 77, 0.42), rgba(28, 25, 23, 0.94))'],
            ['title' => 'Weekend Brunch', 'gradient' => 'linear-gradient(140deg, rgba(234, 179, 8, 0.64), rgba(217, 119, 6, 0.45), rgba(28, 25, 23, 0.9))'],
            ['title' => 'Private Table Setup', 'gradient' => 'linear-gradient(140deg, rgba(37, 99, 235, 0.58), rgba(67, 56, 202, 0.42), rgba(9, 9, 11, 0.94))'],
        ];
    @endphp

    <section class="restaurant-panel p-8 lg:p-10">
        <p class="restaurant-eyebrow">Visual Identity</p>
        <h1 class="restaurant-display mt-4 text-5xl text-amber-50 sm:text-6xl">Gallery</h1>
        <p class="mt-4 max-w-2xl text-base text-stone-300">
            Add your final restaurant photos here later. These stylized placeholders preserve layout and visual rhythm
            for desktop and mobile.
        </p>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($tiles as $tile)
            <article class="restaurant-photo-tile group">
                <div
                    class="restaurant-photo-art"
                    style="background-image: {{ $tile['gradient'] }}"
                    aria-hidden="true"
                ></div>
                <div class="restaurant-photo-content">
                    <h2 class="restaurant-display text-3xl text-amber-50">{{ $tile['title'] }}</h2>
                </div>
            </article>
        @endforeach
    </section>
</x-layouts.restaurant>
