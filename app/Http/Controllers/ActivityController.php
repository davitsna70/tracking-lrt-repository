<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $activities = Activity::paginate(10);

        return view('data.activity.index')
            ->with('activities', $activities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.activity.create');
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

        $activity = new Activity();
        $activity->user_id = $request->user_id;
        $activity->judul = $request->judul;
        $activity->deskripsi = $request->deskripsi;
        $activity->hak_akses = $request->hak_akses;
        $activity->tanggal_mulai = date("Y-m-d", strtotime($request->tanggal_mulai));
        $activity->tanggal_berakhir = date("Y-m-d", strtotime($request->tanggal_berakhir));
        $activity->status = $request->status;
        $activity->waktu_selesai = date("Y-m-d h:m:s", strtotime($request->waktu_selesai));

        $activity->save();

        (new LogActivity())->saveLog('telah membuat activity baru');

        return redirect('/data/activity');
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

        $activity = Activity::find($id);
        return view('data.activity.show')
            ->with('activity', $activity);
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

        $activity = Activity::find($id);
        return view('data.activity.edit')
            ->with('activity', $activity);
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

        $activity = Activity::find($id);
        $activity->user_id = $request->user_id;
        $activity->judul = $request->judul;
        $activity->deskripsi = $request->deskripsi;
        $activity->hak_akses = $request->hak_akses;
        $activity->tanggal_mulai = date("Y-m-d", strtotime($request->tanggal_mulai));
        $activity->tanggal_berakhir = date("Y-m-d", strtotime($request->tanggal_berakhir));
        $activity->status = $request->status;
        $activity->waktu_selesai = date("Y-m-d h:m:s", strtotime($request->waktu_selesai));

        $activity->save();

        (new LogActivity())->saveLog('telah melakukan update activity '.$id);

        return redirect('/data/activity/'.$id.'/show')
            ->with('activity', $activity);
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

        Activity::find($id)->delete();

//        Activity::destroy($id);
        (new LogActivity())->saveLog('telah menghapus activity '.$id);

        return redirect('/data/activity/');
    }
}
