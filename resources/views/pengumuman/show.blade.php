<!-- filepath: c:\laragon\www\pelayanan-gereja\resources\views\pengumuman\show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Pengumuman') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">{{ $pengumuman->judul }}</h2>
            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $pengumuman->isi }}</p>
                @if ($pengumuman->gambar)
                    <img src="{{ asset($pengumuman->gambar) }}" alt="Gambar Pengumuman" class="mb-4 w-full max-w-md object-cover">
                @endif
                <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal: {{ $pengumuman->tanggal_pengumuman->format('d M Y') }}</p>
            </div>
        </div>
    </section>
</x-app-layout>