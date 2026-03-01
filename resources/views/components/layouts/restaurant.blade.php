<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Ember and Thyme | Restaurant' }}</title>
        <meta
            name="description"
            content="{{ $description ?? 'Modern restaurant website with menu highlights, reservations, and contact details.' }}"
        >

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link
            href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap"
            rel="stylesheet"
        >

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="restaurant-body text-stone-100 antialiased">
        <div class="restaurant-noise"></div>
        <div class="restaurant-grid-overlay"></div>
        <div class="restaurant-blur restaurant-blur-left"></div>
        <div class="restaurant-blur restaurant-blur-right"></div>

        @php
            $links = [
                ['name' => 'Home', 'route' => 'home'],
                ['name' => 'Menu', 'route' => 'menu'],
                ['name' => 'About', 'route' => 'about'],
                ['name' => 'Reservations', 'route' => 'reservations'],
                ['name' => 'Gallery', 'route' => 'gallery'],
                ['name' => 'Contact', 'route' => 'contact'],
            ];
            $cartQuantity = collect(session('cart.items', []))->sum('quantity');
        @endphp

        <header class="restaurant-topbar sticky top-0 z-30 border-b border-white/10 bg-stone-950/70 backdrop-blur-lg">
            <div class="mx-auto flex w-full max-w-7xl flex-wrap items-center justify-between gap-4 px-5 py-4 lg:px-8">
                <a href="{{ route('home') }}" class="group flex items-center gap-2">
                    <span class="text-xs uppercase tracking-[0.35em] text-amber-300">Est. 2026</span>
                    <span class="restaurant-display text-2xl text-amber-50 transition group-hover:text-amber-300">
                        Ember and Thyme
                    </span>
                </a>

                <nav class="flex flex-wrap items-center justify-center gap-2 text-sm sm:gap-3">
                    @foreach ($links as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            @class([
                                'restaurant-nav-link',
                                'restaurant-nav-link-active' => request()->routeIs($link['route']),
                            ])
                        >
                            {{ $link['name'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="flex items-center gap-2">
                    <a
                        href="{{ route('cart.index') }}"
                        class="restaurant-button restaurant-button-ghost"
                    >
                        Cart
                        @if ($cartQuantity > 0)
                            <span class="rounded-full bg-amber-300 px-2 py-0.5 text-xs font-bold text-stone-900">
                                {{ $cartQuantity }}
                            </span>
                        @endif
                    </a>

                    @auth
                        <a href="{{ route('orders.index') }}" class="restaurant-button restaurant-button-ghost">
                            My Orders
                        </a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="restaurant-button restaurant-button-ghost">
                                Register
                            </a>
                        @endif
                        <a href="{{ route('login') }}" class="restaurant-button restaurant-button-ghost">
                            Sign In
                        </a>
                    @endauth

                    <a href="{{ route('reservations') }}" class="restaurant-button restaurant-button-primary">
                        Book a Table
                    </a>
                </div>
            </div>
        </header>

        <main class="restaurant-main relative z-10 mx-auto w-full max-w-7xl px-5 py-10 lg:px-8 lg:py-14">
            @if (session('cart_status'))
                <div class="mb-5 rounded-xl border border-green-500/40 bg-green-500/10 px-4 py-3 text-sm text-green-200">
                    {{ session('cart_status') }}
                </div>
            @endif

            @if (session('cart_error'))
                <div class="mb-5 rounded-xl border border-red-500/40 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                    {{ session('cart_error') }}
                </div>
            @endif

            {{ $slot }}
        </main>

        <footer class="restaurant-footer relative z-10 mt-8 border-t border-white/10 bg-black/25">
            <div class="mx-auto grid w-full max-w-7xl gap-8 px-5 py-10 lg:grid-cols-3 lg:px-8">
                <section class="space-y-3">
                    <h2 class="restaurant-display text-3xl text-amber-200">Ember and Thyme</h2>
                    <p class="max-w-sm text-sm text-stone-300">
                        Crafted food, warm service, and memorable nights. This is a polished starter site while your
                        full brand details are prepared.
                    </p>
                </section>

                <section class="space-y-3 text-sm text-stone-300">
                    <h2 class="text-xs uppercase tracking-[0.3em] text-stone-400">Opening Hours</h2>
                    <p>Monday to Thursday: 12:00 PM to 10:30 PM</p>
                    <p>Friday and Saturday: 12:00 PM to 12:00 AM</p>
                    <p>Sunday Brunch: 10:30 AM to 3:00 PM</p>
                </section>

                <section class="space-y-3 text-sm text-stone-300">
                    <h2 class="text-xs uppercase tracking-[0.3em] text-stone-400">Contact</h2>
                    <p>124 Harbor Avenue, Downtown</p>
                    <p>(+1) 555-0148</p>
                    <p>hello@emberandthyme.com</p>
                </section>
            </div>
        </footer>
    </body>
</html>
