<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $notifications = Notification::paginate(10);

        return view('data.notification.index')
            ->with('notifications', $notifications);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->hasRole(['super_admin']);

        $notification = new Notification();
        $notification->user_id = $request->user_id;
        $notification->deskripsi = $request->deskripsi;
        $notification->link_notifikasi = $request->link_notifikasi;
        $notification->status_baca = $request->status_baca;
        $notification->waktu_pembuatan = date("Y-m-d h:i:s");
        $notification->save();

        (new LogActivity())->saveLog('telah membuat notifikasi baru');

        return redirect('/data/notification/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::user()->hasRole(['super_admin']);

        $notification = Notification::find($id);

        return view('data.notification.show')
            ->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Auth::user()->hasRole(['super_admin']);

        $notification = Notification::find($id);

        return view('data.notification.edit')
            ->with('notification', $notification);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Auth::user()->hasRole(['super_admin']);

        $notification = Notification::find($id);
        $notification->user_id = $request->user_id;
        $notification->deskripsi = $request->deskripsi;
        $notification->link_notifikasi = $request->link_notifikasi;
        $notification->status_baca = $request->status_baca;
        $notification->save();

        (new LogActivity())->saveLog('telah melakukan update notifikasi'.$id);

        return redirect('/data/notification/'.$id.'/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->hasRole(['super_admin']);

        Notification::destroy($id);

        (new LogActivity())->saveLog('telah menghapus notifikasi '.$id);

        return redirect('/data/notification/');
    }
}
