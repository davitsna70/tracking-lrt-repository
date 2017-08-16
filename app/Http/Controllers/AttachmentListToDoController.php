<?php

namespace App\Http\Controllers;

use App\AttachmentListToDo;
use App\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttachmentListToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
            Auth::user()->hasRole(['super_admin']);
        else
            redirect('/login');

        $attachmentListToDos = AttachmentListToDo::paginate(10);

        return view('data.attachment_list_to_do.index')
            ->with('attachment_list_to_dos', $attachmentListToDos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check())
            Auth::user()->hasRole(['super_admin']);
        else
            redirect('/login');

        return view('data.attachment_list_to_do.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::check())
            Auth::user()->hasRole(['super_admin']);
        else
            redirect('/login');

        $attachment_list_to_do = new AttachmentListToDo();
        $attachment_list_to_do->list_to_do_id = $request->list_to_do;
        //$attachment_list_to_do->lampiran = $request->lampiran;
        if($request->hasFile('lampiran')){
            $attachment_list_to_do->nama_asli_lampiran = $request->file('lampiran')->getClientOriginalName();
            $attachment_list_to_do->lampiran = $request->file('lampiran')->store('public/list_to_do');
        }
        $attachment_list_to_do->waktu_pembuatan = date("Y-m-d h:i:s");
        $attachment_list_to_do->save();

        (new LogActivity())->saveLog('telah menambahkan lampiran list to do baru');

        return redirect('/data/attachment_list_to_do/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check())
            Auth::user()->hasRole(['super_admin']);
        else
            redirect('/login');

        $attachment_list_to_do = AttachmentListToDo::find($id);

        return view('data.attachmet_list_to_do.show')
            ->with('attachment_list_to_do', $attachment_list_to_do);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::check())
            Auth::user()->hasRole(['super_admin']);
        else
            redirect('/login');

        $attachment_list_to_do = AttachmentListToDo::find($id);

        return view('data.attachmet_list_to_do.edit')
            ->with('attachment_list_to_do', $attachment_list_to_do);
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
        if(Auth::check())
            Auth::user()->hasRole(['super_admin']);
        else
            redirect('/login');

        $attachment_list_to_do = AttachmentListToDo::find($id);
        $attachment_list_to_do->list_to_do_id = $request->list_to_do;
        //$attachment_list_to_do->lampiran = $request->lampiran;
        if($request->hasFile('lampiran')){
            $attachment_list_to_do->nama_asli_lampiran = $request->file('lampiran')->getClientOriginalName();
            $attachment_list_to_do->lampiran = $request->file('lampiran')->store('public/list_to_do');
        }
        $attachment_list_to_do->save();

        (new LogActivity())->saveLog('telah melakukan update lampiran list to do '.$id);

        return redirect('/data/attachment_list_to_do/'.$id.'/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AttachmentListToDo::destroy($id);

        (new LogActivity())->saveLog('telah menghapus lampiran list to do '.$id);

        return redirect('/data/attachment_list_to_do');
    }
}
