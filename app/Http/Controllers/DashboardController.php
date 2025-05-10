<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Filter waktu berdasarkan parameter
        $filter = $request->get('filter', 'today'); // Default: hari ini
        $startDate = Carbon::now();
        $endDate = Carbon::now();

        switch ($filter) {
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday();
                break;
            case '7days':
                $startDate = Carbon::now()->subDays(7);
                break;
            case '30days':
                $startDate = Carbon::now()->subDays(30);
                break;
            case '90days':
                $startDate = Carbon::now()->subDays(90);
                break;
        }

        // Total pengguna
        $totalPengguna = User::where('role', 'user')->count();
        
        // Total pengguna terverifikasi dan belum
        $terverifikasi = User::where('isCompleted', true, )->where('role', 'user')->count();
        $belumTerverifikasi = User::where('isCompleted', false, )->where('role', 'user')->count();
        
        // Data untuk chart: Total semua pendaftar
        $totalUsers = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->where('role', 'user')
        ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
            // Data untuk chart: Total pendaftar yang terverifikasi
            $verifiedUsers = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('role', 'user')
            ->where('isCompleted', true)
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();

            
            $totalUserBaptis = UserProfile::where('sudah_baptis', 'sudah')->count();
            $totalUserKomuni = UserProfile::where('sudah_komuni', 'sudah')->count();
            $totalUserKrisma = UserProfile::where('sudah_krisma', 'sudah')->count();

            $totalUsersCount = $totalUsers->sum('count'); // Hitung total pengguna dari data chart

            $persentaseBaptis = ($totalUserBaptis / $totalUsersCount) * 100;
            $persentaseKomuni = ($totalUserKomuni / $totalUsersCount) * 100;
            $persentaseKrisma = ($totalUserKrisma / $totalUsersCount) * 100;
            
            return view('dashboard', [
                'totalPengguna' => $totalPengguna,
                'terverifikasi' => $terverifikasi,
                'belumTerverifikasi' => $belumTerverifikasi,
                'totalUserBaptis' => $totalUserBaptis,
                'totalUserKomuni' => $totalUserKomuni,
                'totalUserKrisma' => $totalUserKrisma,
                'persentaseBaptis' => $persentaseBaptis,
                'persentaseKomuni' => $persentaseKomuni,
                'persentaseKrisma' => $persentaseKrisma,

                'chartData' => [
                    'totalUsers' => $totalUsers,
                    'verifiedUsers' => $verifiedUsers,
                ],
                'filter' => $filter,
            ]);
        }
        
        public function downloadReport()
        {
            return Excel::download(new UsersExport, 'laporan_pendaftar.xlsx');
    }
}