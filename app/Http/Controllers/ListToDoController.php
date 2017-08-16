<?php

namespace App\Http\Controllers;

use App\ListToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class ListToDoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $listToDos = ListToDo::paginate(10);

        return view('data.list_to_do.index')
            ->with('list_to_dos',$listToDos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.list_to_do.create');
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

        $list_to_do = new ListToDo();
        $list_to_do->user_id = $request->user_id;
        $list_to_do->activity_id = $request->activity_id;
        $list_to_do->judul = $request->judul;
        $list_to_do->deskripsi = $request->deskripsi;
        $list_to_do->status = $request->status;
        $list_to_do->save();

        (new LogActivity())->saveLog('telah menambahkan list to do baru');

        return redirect('/data/list_to_do/');
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

        $list_to_do = ListToDo::find($id);

        return view('data.list_to_do.show')
            ->with('list_to_do', $list_to_do);
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

        $list_to_do = ListToDo::find($id);

        return view('data.list_to_do.edit')
            ->with('list_to_do', $list_to_do);
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

        $list_to_do = ListToDo::find($id);
        $list_to_do->user_id = $request->user_id;
        $list_to_do->activity_id = $request->activity_id;
        $list_to_do->judul = $request->judul;
        $list_to_do->deskripsi = $request->deskripsi;
        $list_to_do->status = $request->status;
        $list_to_do->save();

        (new LogActivity())->saveLog('telah melakukan update list to do '.$id);

        return redirect('/data/list_to_do/'.$id.'/show');
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

        ListToDo::find($id)->delete();

//        ListToDo::destroy($id);

        (new LogActivity())->saveLog('telah menghapus list to do '.$id);

        return redirect('/data/list_to_do/');
    }
}
