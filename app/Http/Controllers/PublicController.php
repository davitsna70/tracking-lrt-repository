<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function weekOn($date){
        $day = date('d', strtotime($date));
        return (integer)(ceil($day/7));
    }

    public function limitWeekInMonth($date){
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $limitDayInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        return (integer)ceil($limitDayInMonth/7);
    }

    public function limitWeekInYear($date){
        $day = 1;
        $months = 12;
        $year = date('Y', strtotime($date));

        $sumWeeks = 0;

        for ($month = 1; $month<=$months; $month++){
            $sumWeeks+=$this->limitWeekInMonth(date('Y-m-d', strtotime($year.'-'.$month.'-'.$day)));
        }

        return $sumWeeks;
    }

    public function isInRangeDate($date, $dateStart, $dateEnd){
        return strtotime($date)>=strtotime($dateStart) && strtotime($date)<=strtotime($dateEnd);
    }

    public function test($date, $dateStart, $dateEnd){
        if(date('Y',strtotime($date))==date('Y',strtotime($dateStart)) && date('Y',strtotime($date))==date('Y',strtotime($dateEnd))){
            if (date('m', strtotime($date))>date('m', strtotime($dateStart)) && date('m', strtotime($date))<date('m', strtotime($dateEnd))){
                return true;
            }
            else if (date('m', strtotime($date))==date('m', strtotime($dateStart))){
                return $this->weekOn($date)>=$this->weekOn($dateStart);
            }
            else if(date('m', strtotime($date))==date('m', strtotime($dateEnd))){
                return $this->weekOn($date)<=$this->weekOn($dateStart);
            }
            else{
                return false;
            }
        }
        else if (date('Y',strtotime($date))==date('Y',strtotime($dateStart))){
            if (date('m', strtotime($date))==date('m', strtotime($dateStart))){
                return $this->weekOn($date)>=$this->weekOn($dateStart);
            }
            else{
                return date('m', strtotime($date))>date('m', strtotime($dateStart));
            }
        }
        else if (date('Y',strtotime($date))==date('Y',strtotime($dateEnd))){
            if (date('m', strtotime($date))==date('m', strtotime($dateEnd))){
                return $this->weekOn($date)<=$this->weekOn($dateEnd);
            }
            else{
                return date('m', strtotime($date))<date('m', strtotime($dateEnd));
            }
        }

        return false;
    }

    public function getNumWeekBetweenMonth($monthStart, $monthEnd, $year){
        $numWeeks = 0;
        for ($i=$monthStart; $i<=$monthEnd;$i++){
            $numWeeks+=$this->limitWeekInMonth(date($year.'-'.$i.'-01'));
        }
        return $numWeeks;
    }
}
