<!-- filepath: c:\laragon\www\pelayanan-gereja\resources\views\auth\login.blade.php -->
<x-guest-layout>
    <div class=" flex items-center justify-center bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
            <!-- Bagian Kiri -->
            <div class="md:w-1/2 bg-orange-500 dark:bg-orange-400 flex flex-col justify-center items-center p-8">
                <h1 class="text-4xl font-bold text-white">Paulus Connect</h1>
                <p class="mt-4 text-white text-center">
                    Iman, Komunitas, Pelayanan, dalam Genggaman
                </p>
                <img src="{{ asset('img/logo st paulus circle.png') }}" alt="Logo" class="mt-6 w-32 h-32">
            </div>

            <!-- Bagian Kanan -->
            <div class="md:w-1/2 p-8">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">Login Admin</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 dark:border-gray-700 text-orange-500 shadow-sm focus:ring-orange-500 dark:focus:ring-orange-400" name="remember">
                            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between mt-6">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('register') }}">
                            {{ __('Don\'t have an account? Register') }}
                        </a>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-3 bg-orange-500 hover:bg-orange-600 dark:bg-orange-400 dark:hover:bg-orange-500">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>