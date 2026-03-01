<x-layouts.restaurant
    title="Ember and Thyme | Reservations"
    description="Reservations page with booking form and dining policies."
>
    <section class="restaurant-panel p-8 lg:p-10">
        <p class="restaurant-eyebrow">Reserve Your Table</p>
        <h1 class="restaurant-display mt-4 text-5xl text-amber-50 sm:text-6xl">Reservations</h1>
        <p class="mt-4 max-w-2xl text-base text-stone-300">
            This is a clean booking placeholder. Connect it to your booking engine later (OpenTable, custom form, or
            phone-only flow).
        </p>
    </section>

    <section class="mt-6 grid gap-6 lg:grid-cols-[1.2fr_0.8fr]">
        <form class="restaurant-panel p-6 lg:p-8" action="#" method="get">
            <h2 class="restaurant-display text-3xl text-amber-100">Book a Table</h2>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <label class="restaurant-field">
                    <span>Full Name</span>
                    <input type="text" placeholder="John Doe" class="restaurant-input">
                </label>
                <label class="restaurant-field">
                    <span>Email</span>
                    <input type="email" placeholder="you@example.com" class="restaurant-input">
                </label>
                <label class="restaurant-field">
                    <span>Phone</span>
                    <input type="tel" placeholder="+1 555 000 0000" class="restaurant-input">
                </label>
                <label class="restaurant-field">
                    <span>Guests</span>
                    <select class="restaurant-input">
                        <option>2 Guests</option>
                        <option>4 Guests</option>
                        <option>6 Guests</option>
                        <option>8 Guests</option>
                    </select>
                </label>
                <label class="restaurant-field">
                    <span>Date</span>
                    <input type="date" class="restaurant-input">
                </label>
                <label class="restaurant-field">
                    <span>Time</span>
                    <select class="restaurant-input">
                        <option>06:00 PM</option>
                        <option>07:00 PM</option>
                        <option>08:00 PM</option>
                        <option>09:00 PM</option>
                    </select>
                </label>
                <label class="restaurant-field sm:col-span-2">
                    <span>Special Notes</span>
                    <textarea rows="4" class="restaurant-input" placeholder="Allergies, occasion, seating preference"></textarea>
                </label>
            </div>
            <button type="submit" class="restaurant-button restaurant-button-primary mt-6">
                Request Reservation
            </button>
        </form>

        <aside class="restaurant-panel p-6 lg:p-8">
            <h2 class="restaurant-display text-3xl text-amber-100">Reservation Notes</h2>
            <div class="mt-5 space-y-4 text-sm text-stone-300">
                <p class="rounded-xl border border-white/10 bg-black/25 p-4">
                    We hold reservations for 15 minutes before releasing the table.
                </p>
                <p class="rounded-xl border border-white/10 bg-black/25 p-4">
                    Large groups of 8+ are confirmed by phone with a pre-selected menu option.
                </p>
                <p class="rounded-xl border border-white/10 bg-black/25 p-4">
                    For private events, contact us directly at events@emberandthyme.com.
                </p>
            </div>
        </aside>
    </section>
</x-layouts.restaurant>
