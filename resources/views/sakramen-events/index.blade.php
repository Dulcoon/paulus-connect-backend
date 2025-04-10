<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Sakramen Events') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="w-full px-10 min-h-screen py-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Daftar sakramen Events</h2>
                <a href="{{ route('sakramen-events.create') }}" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Tambah Event</a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Event</th>
                            <th scope="col" class="px-6 py-3">Jenis sakramen</th>
                            <th scope="col" class="px-6 py-3">Tanggal Pelaksanaan</th>
                            <th scope="col" class="px-6 py-3">Tempat</th>
                            <th scope="col" class="px-6 py-3">Status</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $event->nama_event }}</td>
                                <td class="px-6 py-4">{{ $event->jenis_sakramen}}</td>
                                <td class="px-6 py-4">{{ $event->tanggal_pelaksanaan }}</td>
                                <td class="px-6 py-4">{{ $event->tempat_pelaksanaan }}</td>
                                <td class="px-6 py-4">{{ $event->status }}</td>
                                <td class="px-6 py-4 flex gap-2">
    <a href="{{ route('sakramen-events.edit', $event->id) }}" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
    <form action="{{ route('sakramen-events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-600 dark:text-red-500 hover:underline">Hapus</button>
    </form>
    <!-- Tombol untuk melihat semua pendaftar -->
    <a href="{{ route('pendaftars.index', ['sakramen_event_id' => $event->id]) }}" class="text-green-600 dark:text-green-500 hover:underline">Lihat Pendaftar</a>
</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>