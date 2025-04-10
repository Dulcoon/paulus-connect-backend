<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Sakramen Event') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-3xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Edit Sakramen Event</h2>
            <form action="{{ route('sakramen-events.update', $sakramenEvent->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Tambahkan method PUT untuk update -->
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="nama_event" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Event</label>
                        <input type="text" name="nama_event" id="nama_event" value="{{ $sakramenEvent->nama_event }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan nama event" required>
                    </div>
                    <div class="sm:col-span-2">
                        <label for="deskripsi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                        <input type="text" name="deskripsi" id="deskripsi" value="{{ $sakramenEvent->deskripsi }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan deskripsi" required>
                    </div>
                    <div class="w-full">
                        <label for="jenis_sakramen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Sakramen</label>
                        <select name="jenis_sakramen" id="jenis_sakramen" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="baptis" {{ $sakramenEvent->jenis_sakramen == 'baptis' ? 'selected' : '' }}>Baptis</option>
                            <option value="komuni" {{ $sakramenEvent->jenis_sakramen == 'komuni' ? 'selected' : '' }}>Komuni</option>
                            <option value="krisma" {{ $sakramenEvent->jenis_sakramen == 'krisma' ? 'selected' : '' }}>Krisma</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="tanggal_pelaksanaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" id="tanggal_pelaksanaan" value="{{ $sakramenEvent->tanggal_pelaksanaan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="tempat_pelaksanaan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tempat Pelaksanaan</label>
                        <input type="text" name="tempat_pelaksanaan" id="tempat_pelaksanaan" value="{{ $sakramenEvent->tempat_pelaksanaan }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan tempat pelaksanaan" required>
                    </div>
                    <div class="w-full">
                        <label for="nama_romo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Romo</label>
                        <input type="text" name="nama_romo" id="nama_romo" value="{{ $sakramenEvent->nama_romo }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan nama romo" required>
                    </div>
                    <div class="w-full">
                        <label for="tanggal_pendaftaran_dibuka" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pendaftaran Dibuka</label>
                        <input type="date" name="tanggal_pendaftaran_dibuka" id="tanggal_pendaftaran_dibuka" value="{{ $sakramenEvent->tanggal_pendaftaran_dibuka }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="tanggal_pendaftaran_ditutup" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal Pendaftaran Ditutup</label>
                        <input type="date" name="tanggal_pendaftaran_ditutup" id="tanggal_pendaftaran_ditutup" value="{{ $sakramenEvent->tanggal_pendaftaran_ditutup }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required>
                    </div>
                    <div class="w-full">
                        <label for="kuota_pendaftar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kuota Pendaftar</label>
                        <input type="number" name="kuota_pendaftar" id="kuota_pendaftar" value="{{ $sakramenEvent->kuota_pendaftar }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Masukkan kuota pendaftar" required>
                    </div>
                    <div class="w-full">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option value="opened" {{ $sakramenEvent->status == 'opened' ? 'selected' : '' }}>Opened</option>
                            <option value="closed" {{ $sakramenEvent->status == 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-5 text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Update</button>
            </form>
        </div>
    </section>
</x-app-layout>