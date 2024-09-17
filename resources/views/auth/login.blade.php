<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen pt-2 bg-gray-100">
        <div class="w-full max-w-md bg-white shadow-lg rounded-lg px-8 py-6">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <h2 class="text-center text-2xl font-bold text-gray-700 mb-6">{{ __('Login to your account') }}</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 focus:border-[#A5CF44] focus:ring-[#A5CF44] rounded-lg shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 focus:border-[#A5CF44] focus:ring-[#A5CF44] rounded-lg shadow-sm" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#A5CF44] shadow-sm focus:ring-[#A5CF44]" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                        <a class="text-sm text-[#A5CF44] hover:text-[#7E9C2F]" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-center">
                    <x-primary-button class="w-full py-2 bg-[#A5CF44] hover:bg-[#7E9C2F] text-white font-bold rounded-lg shadow-md">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>

            <!-- Register Link -->
            <p class="text-center text-sm text-gray-600 mt-6">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="text-[#A5CF44] hover:text-[#7E9C2F] font-semibold">{{ __('Register here') }}</a>
            </p>
        </div>
    </div>
</x-guest-layout>
