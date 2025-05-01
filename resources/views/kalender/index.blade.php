<!-- filepath: c:\laragon\www\pelayanan-gereja\resources\views\kalender\index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Kalender Liturgi') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="w-full px-10 min-h-screen py-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Daftar Kalender Liturgi</h2>
                <a href="{{ route('kalender-liturgi.create') }}" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Tambah Kalender Liturgi
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Warna Liturgi</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kalenderLiturgi as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                <td class="px-6 py-4">{{ $item->title }}</td>
                                <td class="px-6 py-4">{{ $item->warna_liturgi }}</td>
                                <td class="px-6 py-4 flex gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('kalender-liturgi.edit', $item->id) }}" class="text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('kalender-liturgi.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kalender liturgi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                    </form>
                                    
                                    <!-- Tombol Lihat Detail -->
                                    <a href="{{ route('kalender-liturgi.show', $item->id) }}" class="text-green-600 dark:text-green-500 hover:underline">Lihat</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $kalenderLiturgi->links() }}
            </div>
        </div>
    </section>
</x-app-layout>