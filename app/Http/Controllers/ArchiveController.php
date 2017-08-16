<?php

namespace App\Http\Controllers;

use App\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class ArchiveController extends Controller
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

        $archives = Archive::paginate(10);

        return view('data.archive.index')
            ->with('archives', $archives);
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

        return view('data.archive.create');
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

        $archive = new Archive();
        $archive->user_id = $request->user_id;
        $archive->activity_id = $request->activity_id;
        $archive->waktu_pembuatan = date("Y-m-d h:i:s");
        $archive->save();

        (new LogActivity())->saveLog('telah membuat archive baru');

        return redirect('/data/archive/');
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

        $archive = Archive::find($id);

        return view('data.archive.show')
            ->with('archive',$archive);
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

        $archive = Archive::find($id);

        return view('data.archive.edit')
            ->with('archive',$archive);
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

        $archive = Archive::find($id);
        $archive->user_id = $request->user_id;
        $archive->activity_id = $request->activity_id;
        $archive->save();

        (new LogActivity())->saveLog('telah melakukan update archive '.$id);

        return redirect('/data/archive/'.$id.'/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::check())
            Auth::user()->hasRole(['super_admin']);
        else
            redirect('/login');

        Archive::destroy($id);

        (new LogActivity())->saveLog('telah menghapus archive '.$id);

        return redirect('/data/archive/');
    }
}
