<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::with('profile') // Pastikan relasi profile dimuat
            ->get()
            ->map(function ($user) {
                return [
                    'name' => $user->name,
                    'email' => $user->email,
                    'no_hp' => optional($user->profile)->no_hp, // Ambil no_hp dari relasi profile
                    'registered_at' => $user->created_at->format('Y-m-d H:i:s'),
                    'is_verified' => $user->isCompleted ? 'Ya' : 'Tidak',
                    'verified_at' => $user->isCompleted ? optional($user->profile)->created_at : null,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'Email',
            'No HP',
            'Mendaftar Sejak',
            'Terverifikasi',
            'Terverifikasi Sejak',
        ];
    }
}