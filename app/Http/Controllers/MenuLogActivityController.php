<?php

namespace App\Http\Controllers;

use App\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuLogActivityController extends Controller
{
    public function logActivity(){
//        dd(date('Y-m-d'));
//        dd(Auth::user()->unreadNotifications[0]->data['activity']['id']);
        $logActivities = LogActivity::where('user_id', '=', Auth::user()->id)->orderBy('waktu_kegiatan', 'desc')->get();

        return view('user.log_activity.log_activity')
            ->with('logActivities', $logActivities);
    }
}
