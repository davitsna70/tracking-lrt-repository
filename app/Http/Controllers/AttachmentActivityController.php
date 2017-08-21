<?php

namespace App\Http\Controllers;

use App\AttachmentActivity;
use App\AttachmentComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class AttachmentActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $attachmentActivities = AttachmentActivity::paginate(10);

        return view('data.attachment_activity.index')
            ->with('attachment_activities', $attachmentActivities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.attachment_activity.create');
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

        $attachment_activity = new AttachmentActivity();
        $attachment_activity->activity_id = $request->activity_id;
        //$attachment_activity->lampiran = $request->lampiran;
        if($request->hasFile('lampiran')){
            $attachment_activity->nama_asli_lampiran = $request->file('lampiran')->getClientOriginalName();
            $attachment_activity->lampiran = $request->file('lampiran')->store('public/activity');
        }
        $attachment_activity->waktu_pembuatan = date("Y-m-d h:i:s");
        $attachment_activity->save();

        (new LogActivity())->saveLog('telah menambahkan lampiran activity baru');

        return redirect('/data/attachment_activity/');
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

        $attachment_activity = AttachmentActivity::find($id);

        return view('data.attachment_activity.show')
            ->with('attachment_activity',$attachment_activity);
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

        $attachment_activity = AttachmentActivity::find($id);

        return view('data.attachment_activity.edit')
            ->with('attachment_activity', $attachment_activity);
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

        $attachment_activity = AttachmentActivity::find($id);
        $attachment_activity->activity_id = $request->activity_id;
        //$attachment_activity->lampiran = $request->lampiran;
        if($request->hasFile('lampiran')){
            $attachment_activity->nama_asli_lampiran = $request->file('lampiran')->getClientOriginalName();
            $attachment_activity->lampiran = $request->file('lampiran')->store('public/activity');
        }
        $attachment_activity->save();

        (new LogActivity())->saveLog('telah melakukan update lampiran activity '.$id);

        return redirect('/data/attachment_activity/'.$id.'/show');
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

        AttachmentActivity::destroy($id);

        (new LogActivity())->saveLog('telah menghapus lampiran activity '.$id);

        return redirect('/data/attachment_activity');
    }
}
