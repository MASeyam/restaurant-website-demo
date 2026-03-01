<x-layouts.restaurant
    title="Ember and Thyme | About"
    description="About page with restaurant story, values, and team placeholders."
>
    @php
        $values = [
            ['title' => 'Ingredient Integrity', 'desc' => 'We source from trusted farms and fisheries with clear seasonal rotation.'],
            ['title' => 'Warm Precision', 'desc' => 'Every plate is thoughtful, but service always feels relaxed and human.'],
            ['title' => 'Local Community', 'desc' => 'We host neighborhood tastings and support local culinary students.'],
        ];

        $team = [
            ['name' => 'Maya Elson', 'role' => 'Executive Chef'],
            ['name' => 'Daniel Cruz', 'role' => 'Restaurant Manager'],
            ['name' => 'Nora Kent', 'role' => 'Pastry Chef'],
        ];
    @endphp

    <section class="restaurant-panel p-8 lg:p-10">
        <p class="restaurant-eyebrow">Our Story</p>
        <h1 class="restaurant-display mt-4 text-5xl text-amber-50 sm:text-6xl">About Ember and Thyme</h1>
        <p class="mt-5 max-w-3xl text-base text-stone-300 sm:text-lg">
            Ember and Thyme began as a small open-fire kitchen concept focused on comfort, craft, and community. This
            page is a professional placeholder you can personalize with your real founder story and team history.
        </p>
    </section>

    <section class="mt-6 grid gap-5 lg:grid-cols-3">
        @foreach ($values as $value)
            <article class="restaurant-panel p-6">
                <h2 class="restaurant-display text-3xl text-amber-100">{{ $value['title'] }}</h2>
                <p class="mt-3 text-sm text-stone-300">{{ $value['desc'] }}</p>
            </article>
        @endforeach
    </section>

    <section class="mt-10 grid gap-6 lg:grid-cols-[1.2fr_1fr]">
        <article class="restaurant-panel p-6 lg:p-8">
            <p class="restaurant-eyebrow">Milestones</p>
            <div class="mt-5 space-y-4">
                <div class="restaurant-list-row">
                    <span>2022</span>
                    <span>Pop-up concept launched in downtown district</span>
                </div>
                <div class="restaurant-list-row">
                    <span>2024</span>
                    <span>Opened flagship dining room and private tasting space</span>
                </div>
                <div class="restaurant-list-row">
                    <span>2026</span>
                    <span>Expanded menu program and weekday lunch service</span>
                </div>
            </div>
        </article>

        <article class="restaurant-panel p-6 lg:p-8">
            <p class="restaurant-eyebrow">Leadership Team</p>
            <div class="mt-5 space-y-4">
                @foreach ($team as $member)
                    <div class="rounded-xl border border-white/10 bg-black/25 p-4">
                        <p class="font-semibold text-stone-100">{{ $member['name'] }}</p>
                        <p class="text-sm text-stone-300">{{ $member['role'] }}</p>
                    </div>
                @endforeach
            </div>
        </article>
    </section>
</x-layouts.restaurant>
