<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LogActivity;
use Illuminate\Support\Facades\Auth;

class MenuNotificationController extends Controller
{
    public function notificationPage(){
//        dd(Auth::user()->notifications);

        return view('user.notification.notification');
    }

    public function readNotification(){
        foreach (Auth::user()->unreadNotifications as $notification){
            $notification->markAsRead();
        }
    }

    public function notificationTask(){
//        dd(Auth::user()->notifications);

        return view('user.notification.task');
    }
}
