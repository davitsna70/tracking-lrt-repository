<?php

namespace App\Http\Controllers;

use App\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $logActivities = LogActivity::paginate(10);

        return view('data.log_activity.index')
            ->with('log_activities', $logActivities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.log_activity.create');
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

        $log_activity = new LogActivity();
        $log_activity->user_id = $request->user_id;
        $log_activity->deskripsi = $request->deskripsi;
        $log_activity->waktu_kegiatan = date("Y-m-d h:i:s");
        $log_activity->save();

        (new LogActivity())->saveLog('telah membuat log activity baru');

        return redirect('/data/log_activity/');
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

        $log_activity = LogActivity::find($id);

        return view('data.log_activity.show')
            ->with('log_activity', $log_activity);
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

        $log_activity = LogActivity::find($id);

        return view('data.log_activity.edit')
            ->with('log_activity', $log_activity);
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

        $log_activity = LogActivity::find($id);
        $log_activity->user_id = $request->user_id;
        $log_activity->deskripsi = $request->deskripsi;
        $log_activity->waktu_kegiatan = date("Y-m-d h:i:s");
        $log_activity->save();

        (new LogActivity())->saveLog('telah melakukan update log activity '.$id);

        return redirect('/data/log_activity/'.$id.'/show');
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

        LogActivity::destroy($id);

        (new LogActivity())->saveLog('telah menghapus log activity '.$id);

        return redirect('/data/log_activity');
    }
}
