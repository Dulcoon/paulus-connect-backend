<!-- filepath: c:\laragon\www\pelayanan-gereja\resources\views\auth\register.blade.php -->
<x-guest-layout>
    <div class="flex items-center justify-center bg-gray-50 dark:bg-gray-900">
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
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6 text-center">Register Admin</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between mt-6">
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100" href="{{ route('login') }}">
                            {{ __('Already have an account? Log in') }}
                        </a>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-3 bg-orange-500 hover:bg-orange-600 dark:bg-orange-400 dark:hover:bg-orange-500">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>