<x-app-layout>
    <x-slot name="header">
        {{ __('Daftar Pendaftar') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="w-full px-10 min-h-screen py-10">
            @if ($pendaftars->isNotEmpty() && $pendaftars->first()->sakramenEvent)
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">
                    {{ $pendaftars->first()->sakramenEvent->nama_event }}
                </h2>
            @endif
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3">Jenis Kelamin</th>
                            <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                            <th scope="col" class="px-6 py-3">Nama Ayah</th>
                            <th scope="col" class="px-6 py-3">Nama Ibu</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($pendaftars->isEmpty())
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td colspan="6" class="px-6 py-4 text-center">Tidak ada pendaftar</td>
                            </tr>
                        @endif
                        @foreach ($pendaftars as $pendaftar)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="px-6 py-4">{{ $pendaftar->nama_lengkap }}</td>
                                <td class="px-6 py-4">{{ $pendaftar->jenis_kelamin }}</td>
                                <td class="px-6 py-4">{{ $pendaftar->tanggal_lahir }}</td>
                                <td class="px-6 py-4">{{ $pendaftar->nama_ayah }}</td>
                                <td class="px-6 py-4">{{ $pendaftar->nama_ibu }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('pendaftars.show', $pendaftar->id) }}"
                                        class="text-blue-600 dark:text-blue-500 hover:underline">Lihat Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>


        
    </section>
</x-app-layout>