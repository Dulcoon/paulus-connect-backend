<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Baptis Event') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Tambah Sakramen Event</h2>
            <form action="{{ route('sakramen-events.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="nama_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama event</label>
                        <input type="text" name="nama_event" id="nama_event" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan nama pendaftaran" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan deskripsi" required>
                    </div>
                    <div class="w-full">
                        <label for="jenis_sakramen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Sakramen</label>
                        <select name="jenis_sakramen" id="jenis_sakramen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="Baptis">Baptis</option>
                            <option value="Komuni">Komuni</option>
                            <option value="Krisma">Krisma</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="tanggal_pelaksanaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="tempat_pelaksanaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Pelaksanaan</label>
                        <input type="text" name="tempat_pelaksanaan" id="tempat_pelaksanaan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan tempat pelaksanaan" required>
                    </div>
                    <div class="w-full">
                        <label for="nama_romo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Romo </label>
                        <input type="text" name="nama_romo" id="nama_romo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan nama romo " required>
                    </div>
                    <div class="w-full">
                        <label for="tanggal_pendaftaran_dibuka" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pendaftaran Dibuka</label>
                        <input type="date" name="tanggal_pendaftaran_dibuka" id="tanggal_pendaftaran_dibuka" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="tanggal_pendaftaran_ditutup" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pendaftaran Ditutup</label>
                        <input type="date" name="tanggal_pendaftaran_ditutup" id="tanggal_pendaftaran_ditutup" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="kuota_pendaftar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kuota Pendaftar</label>
                        <input type="number" name="kuota_pendaftar" id="kuota_pendaftar" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan kuota pendaftar" required>
                    </div>

                </div>
                <button type="submit" class="mt-5 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Simpan</button>
            </form>
        </div>
    </section>
</x-app-layout>