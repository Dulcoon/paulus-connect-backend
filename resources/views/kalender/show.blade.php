<!-- filepath: c:\laragon\www\pelayanan-gereja\resources\views\kalender\show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Kalender Liturgi') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ $kalenderLiturgi->title }}</h2>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Tanggal: {{ \Carbon\Carbon::parse($kalenderLiturgi->date)->format('d M Y') }}</p>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">Warna Liturgi: <span class="font-semibold">{{ $kalenderLiturgi->warna_liturgi }}</span></p>
                <div class="mb-4">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Bacaan Liturgi:</h3>
                    <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                        <li><strong>Bacaan 1:</strong> {{ $kalenderLiturgi->bacaan1 }}</li>
                        <li><strong>Mazmur:</strong> {{ $kalenderLiturgi->mazmur }}</li>
                        @if ($kalenderLiturgi->bacaan2)
                            <li><strong>Bacaan 2:</strong> {{ $kalenderLiturgi->bacaan2 }}</li>
                        @endif
                        @if ($kalenderLiturgi->bait_pengantar)
                            <li><strong>Bait Pengantar:</strong> {{ $kalenderLiturgi->bait_pengantar }}</li>
                        @endif
                        <li><strong>Bacaan Injil:</strong> {{ $kalenderLiturgi->bacaan_injil }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>