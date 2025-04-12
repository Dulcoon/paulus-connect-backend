<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Pendaftar') }}
    </x-slot>

    <section class="bg-white dark:bg-gray-900">
        <div class="w-full px-10 min-h-screen py-10">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Detail Pendaftar {{ $pendaftar->sakramenEvent->nama_event }}</h2>
            <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-lg shadow-md">
                <p><strong>Jenis sakramen:</strong> {{ $pendaftar->jenis_sakramen }}</p>
                <p><strong>Nama Lengkap:</strong> {{ $pendaftar->nama_lengkap }}</p>
                <p><strong>Jenis Kelamin:</strong> {{ $pendaftar->jenis_kelamin }}</p>
                <p><strong>Tanggal Lahir:</strong> {{ $pendaftar->tanggal_lahir }}</p>
                <p><strong>Nama Ayah:</strong> {{ $pendaftar->nama_ayah }}</p>
                <p><strong>Nama Ibu:</strong> {{ $pendaftar->nama_ibu }}</p>
                <p><strong>Kecamatan:</strong> {{ $pendaftar->kecamatan }}</p>
                <p><strong>Kelurahan:</strong> {{ $pendaftar->kelurahan }}</p>
                <p><strong>Alamat Lengkap:</strong> {{ $pendaftar->alamat_lengkap }}</p>
                <p><strong>Lingkungan:</strong> {{ $pendaftar->lingkungan }}</p>
                <p><strong>Status:</strong> {{ $pendaftar->status }}</p>
                <p><strong>Berkas KK:</strong> <a href="{{ asset('storage/' . $pendaftar->berkas_kk) }}" target="_blank" class="text-blue-600 dark:text-blue-500 hover:underline">Lihat Berkas</a></p>
                <p><strong>Berkas Akta Kelahiran:</strong> <a href="{{ asset('storage/' . $pendaftar->berkas_akta_kelahiran) }}" target="_blank" class="text-blue-600 dark:text-blue-500 hover:underline">Lihat Berkas</a></p>
                @if ($pendaftar->berkas_surat_baptis)
                    <p><strong>Berkas Surat Baptis:</strong> <a href="{{ asset('storage/' . $pendaftar->berkas_surat_baptis) }}" target="_blank" class="text-blue-600 dark:text-blue-500 hover:underline">Lihat Berkas</a></p>
                @endif
                @if ($pendaftar->berkas_surat_komuni)
                    <p><strong>Berkas Surat Komuni:</strong> <a href="{{ asset('storage/' . $pendaftar->berkas_surat_komuni) }}" target="_blank" class="text-blue-600 dark:text-blue-500 hover:underline">Lihat Berkas</a></p>
                @endif
                @if ($pendaftar->berkas_surat_krisma)
                    <p><strong>Berkas Surat Krisma:</strong> <a href="{{ asset('storage/' . $pendaftar->berkas_surat_krisma) }}" target="_blank" class="text-blue-600 dark:text-blue-500 hover:underline">Lihat Berkas</a></p>
                @endif
            </div>

            <form action="{{ route('pendaftars.update-status', $pendaftar->id) }}" method="POST" class="mt-6">
                @csrf
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ubah Status</label>
                <select name="status" id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    <option value="diproses" {{ $pendaftar->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="ditolak" {{ $pendaftar->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    <option value="diterima" {{ $pendaftar->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="selesai" {{ $pendaftar->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
                <label for="alasan" class="block mb-2 mt-4 text-md font-medium text-gray-900 dark:text-white">alasan</label>
                <textarea name="alasan" id="alasan" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" rows="4" placeholder="Masukkan alasan jika ditolak">{{ old('alasan', $pendaftar->alasan) }}</textarea>
                <button type="submit" class="mt-4 text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Perbarui Status</button>
            </form>
        </div>
    </section>
</x-app-layout>