<x-layouts.restaurant-auth :title="__('Log in')" :heading="__('Welcome Back')">
    <div class="flex flex-col gap-6">
        <div>
            <p class="restaurant-eyebrow">{{ __('Account Access') }}</p>
            <h2 class="restaurant-display mt-3 text-4xl text-amber-50">{{ __('Log in to your account') }}</h2>
            <p class="mt-3 text-sm text-stone-300">{{ __('Enter your email and password below to continue.') }}</p>
        </div>

        @if (session('status'))
            <div class="rounded-xl border border-green-500/40 bg-green-500/10 px-4 py-3 text-sm text-green-200">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-xl border border-red-500/40 bg-red-500/10 px-4 py-3 text-sm text-red-200">
                <ul class="list-disc ps-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-4">
            @csrf

            <label class="restaurant-field">
                <span>{{ __('Email address') }}</span>
                <input
                    name="email"
                    type="email"
                    required
                    autofocus
                    autocomplete="email"
                    value="{{ old('email') }}"
                    placeholder="email@example.com"
                    class="restaurant-input"
                >
            </label>

            <label class="restaurant-field">
                <span>{{ __('Password') }}</span>
                <input
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    placeholder="{{ __('Password') }}"
                    class="restaurant-input"
                >
            </label>

            <div class="flex items-center justify-between gap-3">
                <label class="inline-flex items-center gap-2 text-sm text-stone-300">
                    <input
                        type="checkbox"
                        name="remember"
                        value="1"
                        @checked(old('remember'))
                        class="h-4 w-4 rounded border-white/30 bg-black/30 text-amber-400 focus:ring-amber-400"
                    >
                    <span>{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-amber-200 hover:text-amber-100">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <button type="submit" class="restaurant-button restaurant-button-primary mt-2 w-full justify-center" data-test="login-button">
                {{ __('Log in') }}
            </button>
        </form>

        @if (Route::has('register'))
            <p class="text-center text-sm text-stone-300">
                <span>{{ __('Don\'t have an account?') }}</span>
                <a href="{{ route('register') }}" class="text-amber-200 hover:text-amber-100">
                    {{ __('Sign up') }}
                </a>
            </p>
        @endif
    </div>
</x-layouts.restaurant-auth>
