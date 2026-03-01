<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Account' }} - {{ config('app.name', 'Laravel') }}</title>

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

        <main class="relative z-10 flex min-h-screen items-center px-5 py-10 lg:px-8">
            <div class="mx-auto grid w-full max-w-6xl gap-6 lg:grid-cols-[1.1fr_0.9fr]">
                <section class="restaurant-panel hidden p-8 lg:block lg:p-10">
                    <a href="{{ route('home') }}" class="restaurant-display text-4xl text-amber-100">
                        Ember and Thyme
                    </a>
                    <p class="restaurant-eyebrow mt-3">Guest Experience Starts Here</p>
                    <h1 class="restaurant-display mt-6 text-5xl text-amber-50">
                        {{ $heading ?? 'Welcome Back' }}
                    </h1>
                    <p class="mt-4 max-w-xl text-base text-stone-300">
                        Sign in to place fast orders, manage your history, and track your table and delivery requests.
                    </p>
                    <div class="mt-8 space-y-3 text-sm text-stone-300">
                        <p class="restaurant-list-row"><span>Secure account</span><span>Email + password</span></p>
                        <p class="restaurant-list-row"><span>Quick checkout</span><span>Saved account flow</span></p>
                        <p class="restaurant-list-row"><span>Order history</span><span>View any time</span></p>
                    </div>
                </section>

                <section class="restaurant-panel p-6 sm:p-8 lg:p-10">
                    <a href="{{ route('home') }}" class="restaurant-display text-3xl text-amber-100 lg:hidden">
                        Ember and Thyme
                    </a>
                    {{ $slot }}
                </section>
            </div>
        </main>
    </body>
</html>
