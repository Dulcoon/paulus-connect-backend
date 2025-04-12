<!-- filepath: c:\laragon\www\pelayanan-gereja\resources\views\pengumuman\create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Pengumuman') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Pengumuman</h2>
            <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="judul" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                        <input type="text" name="judul" id="judul" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan judul pengumuman" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="isi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Isi</label>
                        <textarea name="isi" id="isi" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan isi pengumuman" required></textarea>
                    </div>
                    <div class="w-full">
                        <label for="gambar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gambar</label>
                        <input type="file" name="gambar" id="gambar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                    <div class="w-full">
                        <label for="tanggal_pengumuman" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pengumuman</label>
                        <input type="date" name="tanggal_pengumuman" id="tanggal_pengumuman" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                </div>
                <button type="submit" class="mt-5 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Simpan</button>
            </form>
        </div>
    </section>
</x-app-layout>