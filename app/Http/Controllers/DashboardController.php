<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Question;
use App\Models\Survey;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $tanggal_awal = date('Y-m-d');
        $feedback = Survey::feedback();
        $laporan = DB::table('surveys')
                    ->select(DB::raw('CAST(created_at AS DATE) as tanggal, COUNT(feedback) as jumlah, feedback'))
                    ->whereDate('created_at', $tanggal_awal)
                    ->groupBy('tanggal', 'feedback')
                    ->get();
        $feedback_sangat_puas = Survey::whereDate('created_at', $tanggal_awal)->where('feedback', 3)->count();
        $feedback_puas = Survey::whereDate('created_at', $tanggal_awal)->where('feedback', 2)->count();
        $feedback_cukup_puas = Survey::whereDate('created_at', $tanggal_awal)->where('feedback', 1)->count();

        $data = [
            'title' => 'Dashboard Admin',
            'slug' => 'dashboard',
            'tanggal' => $tanggal_awal,
            'feedback' => $feedback,
            'laporan' => $laporan,
            'feedback_sangat_puas' => $feedback_sangat_puas,
            'feedback_puas' => $feedback_puas,
            'feedback_cukup_puas' => $feedback_cukup_puas
        ];

        return view('admin.dashboard.beranda', $data);
    }
}
