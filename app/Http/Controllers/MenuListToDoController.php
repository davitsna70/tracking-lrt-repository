<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LogActivity;

class MenuListToDoController extends Controller
{
    public function listToDo(){
        $activities = $this->getPrivateActivities();
//        dd($activities);
        return view('user.list_to_do.list_to_do')
            ->with('activities', $activities);
    }

    private function getPrivateActivities(){
        $data = Activity::leftJoin('user_activities', 'activities.id', '=', 'user_activities.activity_id')
            ->where('user_activities.user_id', '=', Auth::user()->id)
//            ->where('activities.hak_akses', '=', 'private')
            ->orWhere('activities.user_id', '=', Auth::user()->id)
//            ->where('activities.hak_akses', '=', 'private')
            ->select('activities.*')
            ->distinct()
            ->orderBy('activities.tanggal_mulai')
            ->get();
//        $data = Activity::where('hak_akses','=','private')->first();
//        dd($data);
        return $data;
    }
}
