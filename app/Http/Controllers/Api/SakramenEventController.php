<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SakramenEvent;
use Illuminate\Http\JsonResponse;

class SakramenEventController extends Controller
{
    /**
     * Ambil semua event baptis yang statusnya "opened".
     *
     * @return JsonResponse
     */
    public function getActiveEvents(): JsonResponse
    {
        $activeEvents = SakramenEvent::where('status', 'opened')->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar event baptis aktif.',
            'data' => $activeEvents,
        ]);
    }
}