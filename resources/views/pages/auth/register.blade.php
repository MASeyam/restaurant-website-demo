<x-layouts.restaurant-auth :title="__('Register')" :heading="__('Create Your Account')">
    <div class="flex flex-col gap-6">
        <div>
            <p class="restaurant-eyebrow">{{ __('New Guest') }}</p>
            <h2 class="restaurant-display mt-3 text-4xl text-amber-50">{{ __('Create an account') }}</h2>
            <p class="mt-3 text-sm text-stone-300">{{ __('Create your profile to place and track orders instantly.') }}</p>
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

        <form method="POST" action="{{ route('register.store') }}" class="flex flex-col gap-4">
            @csrf

            <label class="restaurant-field">
                <span>{{ __('Name') }}</span>
                <input
                    name="name"
                    type="text"
                    required
                    autofocus
                    autocomplete="name"
                    value="{{ old('name') }}"
                    placeholder="{{ __('Full name') }}"
                    class="restaurant-input"
                >
            </label>

            <label class="restaurant-field">
                <span>{{ __('Email address') }}</span>
                <input
                    name="email"
                    type="email"
                    required
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
                    autocomplete="new-password"
                    placeholder="{{ __('Password') }}"
                    class="restaurant-input"
                >
            </label>

            <label class="restaurant-field">
                <span>{{ __('Confirm password') }}</span>
                <input
                    name="password_confirmation"
                    type="password"
                    required
                    autocomplete="new-password"
                    placeholder="{{ __('Confirm password') }}"
                    class="restaurant-input"
                >
            </label>

            <button type="submit" class="restaurant-button restaurant-button-primary mt-2 w-full justify-center" data-test="register-user-button">
                {{ __('Create account') }}
            </button>
        </form>

        <p class="text-center text-sm text-stone-300">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}" class="text-amber-200 hover:text-amber-100">{{ __('Log in') }}</a>
        </p>
    </div>
</x-layouts.restaurant-auth>
