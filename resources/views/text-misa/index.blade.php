<!-- filepath: resources/views/text-misa/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Teks Misa') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="w-full px-10 min-h-screen py-10">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Daftar Teks Misa</h2>
                <a href="{{ route('text-misa.create') }}" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Tambah Teks Misa
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Judul</th>
                            <th scope="col" class="px-6 py-3">Tanggal</th>
                            <th scope="col" class="px-6 py-3">File</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($misaPdfs as $misaPdf)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $misaPdf->judul }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($misaPdf->tanggal)->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ asset('storage/' . $misaPdf->file_path) }}" target="_blank" class="text-blue-600 dark:text-blue-500 hover:underline">Lihat PDF</a>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <form action="{{ route('text-misa.destroy', $misaPdf->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus teks misa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>