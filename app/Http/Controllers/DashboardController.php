<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->role->name == 'admin'){
            return $this->admin();
        }

        // $count_arsip = Arsip::where('user_id', auth()->user()->id)->count();
        // if(!$count_arsip){
        //     $count_arsip = 0;
        // }

        // $count_status_no = Arsip::where([
        //                         ['status', '!=', 'validated'],
        //                         ['user_id', '=', auth()->user()->id]
        //                     ])->count();
        // if(!$count_status_no){
        //     $count_status_no = 0;
        // }

        // $count_uraian = Uraian::count();
        // if(!$count_uraian){
        //     $count_uraian = 0;
        // }

        $data = [
            'title' => 'Dashboard User',
            'slug' => 'dashboard',
            // 'count_arsip' => $count_arsip,
            // 'count_status_no' => $count_status_no,
            // 'count_uraian' => $count_uraian
        ];

        // ddd($data);

        return view('admin.dashboard.index', $data);
    }

    function admin()
    {
        // $count_arsip = Arsip::count();
        // if(!$count_arsip){
        //     $count_arsip = 0;
        // }

        // $count_riwayat = Riwayat::where('user_id', auth()->user()->id)->count();
        // if(!$count_riwayat){
        //     $count_riwayat = 0;
        // }

        // $count_status_no = Arsip::where('status', '!=', 'validated')->count();
        // if(!$count_status_no){
        //     $count_status_no = 0;
        // }

        // $count_user = User::count();
        // if(!$count_user){
        //     $count_user = 0;
        // }

        $data = [
            'title' => 'Dashboard Admin',
            'slug' => 'dashboard',
            // 'count_arsip' => $count_arsip,
            // 'count_riwayat' => $count_riwayat,
            // 'count_status_no' => $count_status_no,
            // 'count_user' => $count_user
        ];

        return view('admin.dashboard.admin', $data);
    }
}
