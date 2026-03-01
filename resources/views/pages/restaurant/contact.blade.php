<x-layouts.restaurant
    title="Ember and Thyme | Contact"
    description="Contact page with location, opening hours, and inquiry form placeholders."
>
    <section class="restaurant-panel p-8 lg:p-10">
        <p class="restaurant-eyebrow">Get in Touch</p>
        <h1 class="restaurant-display mt-4 text-5xl text-amber-50 sm:text-6xl">Contact</h1>
        <p class="mt-4 max-w-2xl text-base text-stone-300">
            Keep this page live now, then replace contact details when your brand documents arrive.
        </p>
    </section>

    <section class="mt-6 grid gap-6 lg:grid-cols-[0.9fr_1.1fr]">
        <aside class="restaurant-panel p-6 lg:p-8">
            <h2 class="restaurant-display text-3xl text-amber-100">Visit Us</h2>
            <div class="mt-5 space-y-3 text-sm text-stone-300">
                <p>124 Harbor Avenue, Downtown, New York, NY</p>
                <p>(+1) 555-0148</p>
                <p>hello@emberandthyme.com</p>
            </div>

            <h3 class="mt-7 text-xs uppercase tracking-[0.2em] text-stone-400">Hours</h3>
            <div class="mt-3 space-y-2 text-sm text-stone-300">
                <p>Mon-Thu: 12:00 PM - 10:30 PM</p>
                <p>Fri-Sat: 12:00 PM - 12:00 AM</p>
                <p>Sun Brunch: 10:30 AM - 3:00 PM</p>
            </div>
        </aside>

        <form class="restaurant-panel p-6 lg:p-8" action="#" method="get">
            <h2 class="restaurant-display text-3xl text-amber-100">Send a Message</h2>
            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                <label class="restaurant-field">
                    <span>Name</span>
                    <input type="text" class="restaurant-input" placeholder="Your name">
                </label>
                <label class="restaurant-field">
                    <span>Email</span>
                    <input type="email" class="restaurant-input" placeholder="you@example.com">
                </label>
                <label class="restaurant-field sm:col-span-2">
                    <span>Subject</span>
                    <input type="text" class="restaurant-input" placeholder="Private event, general inquiry, feedback">
                </label>
                <label class="restaurant-field sm:col-span-2">
                    <span>Message</span>
                    <textarea rows="5" class="restaurant-input" placeholder="Tell us what you need"></textarea>
                </label>
            </div>
            <button type="submit" class="restaurant-button restaurant-button-primary mt-6">Send Inquiry</button>
        </form>
    </section>
</x-layouts.restaurant>
