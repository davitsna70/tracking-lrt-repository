<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;use App\LogActivity;

class MenuTimelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function timeline()
    {
        $date = Activity::where('hak_akses', '=', 'public')
            ->orderBy('tanggal_mulai')->first()->tanggal_mulai;

//        dd([date('m',strtotime($date)), date('y',strtotime($date))]);
        $month = date('m',strtotime($date));
        $year = date('Y',strtotime($date));
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        $activities = Activity::where('hak_akses', '=', 'public')
            ->whereMonth('tanggal_mulai', '=', $month)
            ->whereYear('tanggal_mulai', '=', $year)
            ->orWhere('hak_akses', '=', 'public')
            ->whereMonth('tanggal_berakhir', '=', $month)
            ->whereYear('tanggal_berakhir', '=', $year)
            ->get();

        return view('user.timeline.timeline')
            ->with('activities', $activities)
            ->with('days', $days)
            ->with('month', $month)
            ->with('year', $year)
            ->with('hak_akses', 'public')
            ->with('status', 'all');
    }

    public function timelineActivityWithSpesification(Request $request){
//        $date = Activity::where('hak_akses', '=', 'public')
//            ->where('status', '=', $request->status)
//            ->orderBy('tanggal_mulai')->first()->tanggal_mulai;

//        dd([date('m',strtotime($date)), date('y',strtotime($date))]);
        $month = $request->bulan;
        $year = $request->tahun;
        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        if ($request->status == 'all'){
            $activities = Activity::where('hak_akses', '=', 'public')
                ->whereMonth('tanggal_mulai', '=', $month)
                ->whereYear('tanggal_mulai', '=', $year)
                ->orWhere('hak_akses', '=', 'public')
                ->whereMonth('tanggal_berakhir', '=', $month)
                ->whereYear('tanggal_berakhir', '=', $year)
                ->get();
        }else{
//            dd($request->status);
            $activities = Activity::where('hak_akses', '=', 'public')
                ->where('status', '=', $request->status)
                ->whereMonth('tanggal_mulai', '=', $month)
                ->whereYear('tanggal_mulai', '=', $year)
                ->orWhere('hak_akses', '=', 'public')
                ->where('status', '=', $request->status)
                ->whereMonth('tanggal_berakhir', '=', $month)
                ->whereYear('tanggal_berakhir', '=', $year)
                ->get();
        }

        return view('user.timeline.timeline')
            ->with('activities', $activities)
            ->with('days', $days)
            ->with('month', $month)
            ->with('year', $year)
            ->with('hak_akses', 'public')
            ->with('status', $request->status);
    }
}
