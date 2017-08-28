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
//        $date = Activity::where('hak_akses', '=', 'public')
//            ->orderBy('tanggal_mulai')->first()->tanggal_mulai;
//
////        dd([date('m',strtotime($date)), date('y',strtotime($date))]);
//        $month = date('m',strtotime($date));
//        $year = date('Y',strtotime($date));
//        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
//
//        $activities = Activity::where('hak_akses', '=', 'public')
//            ->whereMonth('tanggal_mulai', '=', $month)
//            ->whereYear('tanggal_mulai', '=', $year)
//            ->orWhere('hak_akses', '=', 'public')
//            ->whereMonth('tanggal_berakhir', '=', $month)
//            ->whereYear('tanggal_berakhir', '=', $year)
//            ->get();
//
//        return view('user.timeline.timeline')
//            ->with('activities', $activities)
//            ->with('days', $days)
//            ->with('month', $month)
//            ->with('year', $year)
//            ->with('hak_akses', 'public')
//            ->with('status', 'all');

        $act = Activity::where('hak_akses', '=', 'public')
            ->orderBy('tanggal_mulai');
        if($act->first()!=null){
        $date = $act->first()->tanggal_mulai;
        $dateFirst = $act->first()->tanggal_mulai;
        $act = Activity::where('hak_akses', '=', 'public')
            ->orderBy('tanggal_mulai', 'desc');
        $dateLast = $act->first()->tanggal_berakhir;

        $year = date('Y',strtotime($date));
        $month = date('m',strtotime($date));

        $activities = Activity::where('hak_akses', '=', 'public')
            ->whereYear('tanggal_mulai', '=', $year)
            ->orWhere('hak_akses', '=', 'public')
            ->whereYear('tanggal_berakhir', '=', $year)
            ->orderBy('tanggal_mulai')
            ->get();

        return view('user.timeline.timeline')
            ->with('activities', $activities)
            ->with('month', $month)
            ->with('year', $year)
            ->with('firstYear', date('Y', strtotime($dateFirst)))
            ->with('lastYear', date('Y', strtotime($dateLast)))
            ->with('hak_akses', 'public')
            ->with('status', 'all');
        }
        return view('user.timeline.timeline')
            ->with('activities', null);
    }

    public function timelineActivityWithSpesification(Request $request){
////        $date = Activity::where('hak_akses', '=', 'public')
////            ->where('status', '=', $request->status)
////            ->orderBy('tanggal_mulai')->first()->tanggal_mulai;
//
////        dd([date('m',strtotime($date)), date('y',strtotime($date))]);
//        $month = $request->bulan;
//        $year = $request->tahun;
//        $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
//
//        if ($request->status == 'all'){
//            $activities = Activity::where('hak_akses', '=', 'public')
//                ->whereMonth('tanggal_mulai', '=', $month)
//                ->whereYear('tanggal_mulai', '=', $year)
//                ->orWhere('hak_akses', '=', 'public')
//                ->whereMonth('tanggal_berakhir', '=', $month)
//                ->whereYear('tanggal_berakhir', '=', $year)
//                ->get();
//        }else{
////            dd($request->status);
//            $activities = Activity::where('hak_akses', '=', 'public')
//                ->where('status', '=', $request->status)
//                ->whereMonth('tanggal_mulai', '=', $month)
//                ->whereYear('tanggal_mulai', '=', $year)
//                ->orWhere('hak_akses', '=', 'public')
//                ->where('status', '=', $request->status)
//                ->whereMonth('tanggal_berakhir', '=', $month)
//                ->whereYear('tanggal_berakhir', '=', $year)
//                ->get();
//        }
//
//        return view('user.timeline.timeline')
//            ->with('activities', $activities)
//            ->with('days', $days)
//            ->with('month', $month)
//            ->with('year', $year)
//            ->with('hak_akses', 'public')
//            ->with('status', $request->status);

        $act = Activity::where('hak_akses', '=', 'public')
            ->whereYear('tanggal_mulai', '<=', $request->tahun)
//            ->orWhere('hak_akses', '=', 'public')
            ->whereYear('tanggal_berakhir', '>=', $request->tahun)
            ->orderBy('tanggal_mulai');
//        dd($act->get());
        if($act->first()!=null){
//            $date = $act->first()->tanggal_berakhir;
            if(strtotime($act->first()->tanggal_mulai)<strtotime($request->tahun.'-01-01')){
                $date = date('Y-m-d', strtotime($request->tahun.'-01-01'));
            }
            else{
                $date = $act->first()->tanggal_mulai;
            }
//            $date = date('Y-m-d', strtotime($request->tahun.'-01-01'));
            $act = Activity::where('hak_akses', '=', 'public')
                ->orderBy('tanggal_mulai');
            $dateFirst = $act->first()->tanggal_mulai;
            $act = Activity::where('hak_akses', '=', 'public')
                ->orderBy('tanggal_berakhir', 'desc');
            $dateLast = $act->first()->tanggal_berakhir;

            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));
//            dd($act->first());

            if($request->status == 'all'){
                $activities = Activity::where('hak_akses', '=', 'public')
                    ->whereYear('tanggal_mulai', '<=', $year)
//                    ->orWhere('hak_akses', '=', 'public')
                    ->whereYear('tanggal_berakhir', '>=', $year)
                    ->orderBy('tanggal_mulai')
                    ->get();
            }
            else{
                $activities = Activity::where('hak_akses', '=', 'public')
                    ->where('status', '=', $request->status)
                    ->whereYear('tanggal_mulai', '<=', $year)
//                    ->orWhere('hak_akses', '=', 'public')
//                    ->where('status', '=', $request->status)
                    ->whereYear('tanggal_berakhir', '>=', $year)
                    ->orderBy('tanggal_mulai')
                    ->get();
            }

//            dd($activities);

            return view('user.timeline.timeline')
                ->with('activities', $activities)
                ->with('month', $month)
                ->with('year', $year)
                ->with('firstYear', date('Y', strtotime($dateFirst)))
                ->with('lastYear', date('Y', strtotime($dateLast)))
                ->with('hak_akses', 'public')
                ->with('status', $request->status);
//                ->with('numAllListToDo', $numAllListToDo)
//                ->with('numAllListToDoDone', $numAllListToDoDone);
        }
        return view('index')
            ->with('activities', null);
    }
}
