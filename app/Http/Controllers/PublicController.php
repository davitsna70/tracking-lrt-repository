<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ListToDo;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $act = Activity::where('hak_akses', '=', 'public')
            ->orderBy('tanggal_mulai');
//        dd($act);
        if($act->first() != null) {
            $date = $act->first()->tanggal_mulai;
            $dateFirst = $act->first()->tanggal_mulai;
//            $act = Activity::where('hak_akses', '=', 'public')
//                ->orderBy('tanggal_mulai', 'desc');
            $dateLast = Activity::where('hak_akses', '=', 'public')->orderBy('tanggal_berakhir', 'desc')->first()->tanggal_berakhir;

            $year = date('Y', strtotime($date));
            $month = date('m', strtotime($date));

            $activities = Activity::where('hak_akses', '=', 'public')
                ->whereYear('tanggal_mulai', '=', $year)
                ->orWhere('hak_akses', '=', 'public')
                ->whereYear('tanggal_berakhir', '=', $year)
                ->orderBy('tanggal_mulai')
                ->get();

            $allProgressActivityPublic = Activity::where('hak_akses', '=', 'public')->get();
            $numAllListToDo = 0;
            $numAllListToDoDone = 0;

            foreach ($allProgressActivityPublic as $activityPublic) {
                $list = ListToDo::where('activity_id', '=', $activityPublic->id)->get();
                $numAllListToDo += count($list);
                $list = ListToDo::where('activity_id', '=', $activityPublic->id)
                    ->where('status', '=', 'done')
                    ->get();
                $numAllListToDoDone += count($list);
            }

            return view('index')
                ->with('activities', $activities)
                ->with('month', $month)
                ->with('year', $year)
                ->with('firstYear', date('Y', strtotime($dateFirst)))
                ->with('lastYear', date('Y', strtotime($dateLast)))
                ->with('hak_akses', 'public')
                ->with('status', 'all')
                ->with('numAllListToDo', $numAllListToDo)
                ->with('numAllListToDoDone', $numAllListToDoDone);
        }
        return view('index')
            ->with('activities', null);
    }

    public function indexWithData(Request $request)
    {
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

            $allProgressActivityPublic = Activity::where('hak_akses','=','public')->get();
            $numAllListToDo = 0;
            $numAllListToDoDone = 0;

            foreach ($allProgressActivityPublic as $activityPublic){
                $list = ListToDo::where('activity_id', '=', $activityPublic->id)->get();
                $numAllListToDo+=count($list);
                $list = ListToDo::where('activity_id', '=', $activityPublic->id)
                    ->where('status', '=','done')
                    ->get();
                $numAllListToDoDone +=count($list);
            }

//            dd($activities);

            return view('index')
                ->with('activities', $activities)
                ->with('month', $month)
                ->with('year', $year)
                ->with('firstYear', date('Y', strtotime($dateFirst)))
                ->with('lastYear', date('Y', strtotime($dateLast)))
                ->with('hak_akses', 'public')
                ->with('status', $request->status)
                ->with('numAllListToDo', $numAllListToDo)
                ->with('numAllListToDoDone', $numAllListToDoDone);
        }
        return view('index')
            ->with('activities', null);
    }

    public function timeline()
    {
        $act = Activity::where('hak_akses', '=', 'public')
            ->orderBy('tanggal_mulai');
        $date = $act->first()->tanggal_mulai;
        $dateFirst = $act->first()->tanggal_mulai;
        $act = Activity::where('hak_akses', '=', 'public')
            ->orderBy('tanggal_mulai', 'desc');
        $dateLast = $act->first()->tanggal_mulai;

        $year = date('Y',strtotime($date));
        $month = date('m',strtotime($date));

        $activities = Activity::where('hak_akses', '=', 'public')
            ->whereYear('tanggal_mulai', '=', $year)
            ->orWhere('hak_akses', '=', 'public')
            ->whereYear('tanggal_berakhir', '=', $year)
            ->orderBy('tanggal_mulai')
            ->get();

        return view('home')
            ->with('activities', $activities)
            ->with('month', $month)
            ->with('year', $year)
            ->with('firstYear', date('Y', strtotime($dateFirst)))
            ->with('lastYear', date('Y', strtotime($dateLast)))
            ->with('hak_akses', 'public')
            ->with('status', 'all');
    }

    public function timelineWithData(Request $request)
    {
        $act = Activity::where('hak_akses', '=', 'public')
            ->whereYear('tanggal_mulai', '=', $request->tahun)
            ->orWhere('hak_akses', '=', 'public')
            ->whereYear('tanggal_berakhir', '=', $request->tahun)
            ->orderBy('tanggal_mulai');
        $date = $act->first()->tanggal_mulai;
        $act = Activity::where('hak_akses', '=', 'public')
            ->orderBy('tanggal_mulai');
        $dateFirst = $act->first()->tanggal_mulai;
        $act = Activity::where('hak_akses', '=', 'public')
            ->orderBy('tanggal_mulai', 'desc');
        $dateLast = $act->first()->tanggal_mulai;

        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));

        if($request->status == 'all'){
            $activities = Activity::where('hak_akses', '=', 'public')
                ->whereYear('tanggal_mulai', '=', $year)
                ->orWhere('hak_akses', '=', 'public')
                ->whereYear('tanggal_berakhir', '=', $year)
                ->get();
        }
        else{
            $activities = Activity::where('hak_akses', '=', 'public')
                ->where('status', '=', $request->status)
                ->whereYear('tanggal_mulai', '=', $year)
                ->orWhere('hak_akses', '=', 'public')
                ->where('status', '=', $request->status)
                ->whereYear('tanggal_berakhir', '=', $year)
                ->get();
        }


        return view('home')
            ->with('activities', $activities)
            ->with('month', $month)
            ->with('year', $year)
            ->with('firstYear', date('Y', strtotime($dateFirst)))
            ->with('lastYear', date('Y', strtotime($dateLast)))
            ->with('hak_akses', 'public')
            ->with('status', $request->status);
    }

}
