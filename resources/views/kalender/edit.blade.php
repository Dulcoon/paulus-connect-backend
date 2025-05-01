<!-- filepath: c:\laragon\www\pelayanan-gereja\resources\views\kalender\edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Kalender Liturgi') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Kalender Liturgi</h2>
            <form action="{{ route('kalender-liturgi.update', $kalenderLiturgi->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
                        <input type="date" name="date" id="date" value="{{ $kalenderLiturgi->date }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                        <input type="text" name="title" id="title" value="{{ $kalenderLiturgi->title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="warna_liturgi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Warna Liturgi</label>
                        <input type="text" name="warna_liturgi" id="warna_liturgi" value="{{ $kalenderLiturgi->warna_liturgi }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="bacaan1" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bacaan 1</label>
                        <input type="text" name="bacaan1" id="bacaan1" value="{{ $kalenderLiturgi->bacaan1 }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="mazmur" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mazmur</label>
                        <input type="text" name="mazmur" id="mazmur" value="{{ $kalenderLiturgi->mazmur }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="bacaan2" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bacaan 2</label>
                        <input type="text" name="bacaan2" id="bacaan2" value="{{ $kalenderLiturgi->bacaan2 }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="w-full">
                        <label for="bait_pengantar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bait Pengantar</label>
                        <input type="text" name="bait_pengantar" id="bait_pengantar" value="{{ $kalenderLiturgi->bait_pengantar }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="w-full">
                        <label for="bacaan_injil" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bacaan Injil</label>
                        <input type="text" name="bacaan_injil" id="bacaan_injil" value="{{ $kalenderLiturgi->bacaan_injil }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                </div>
                <button type="submit" class="mt-5 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Perbarui</button>
            </form>
        </div>
    </section>
</x-app-layout>