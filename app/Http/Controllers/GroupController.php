<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $groups = Group::paginate(10);

        return view('data.group.index')
            ->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.group.create');
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

        $group = new Group();
        $group->nama_group = $request->nama_group;
        $group->alamat_kantor = $request->alamat_kantor;
        $group->nomor_telepon = $request->nomor_telepon;
        $group->fax = $request->fax;
        $group->email = $request->email;
        $group->save();

        (new LogActivity())->saveLog('telah menambahkan grup baru');

        return redirect('/data/group');
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

        $group = Group::find($id);

        return view('data.group.show')
            ->with('group', $group);
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

        $group = Group::find($id);

        return view('data.group.edit')
            ->with('group', $group);
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

        $group = Group::find($id);
        $group->nama_group = $request->nama_group;
        $group->alamat_kantor = $request->alamat_kantor;
        $group->nomor_telepon = $request->nomor_telepon;
        $group->fax = $request->fax;
        $group->email = $request->email;
        $group->save();

        (new LogActivity())->saveLog('telah melakukan update grup '.$id);

        return redirect('/data/group/'.$id.'/show');
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

        Group::find($id)->delete();
//        Group::destroy($id);
        (new LogActivity())->saveLog('telah menghapus grup '.$id);

        return redirect('/data/group/');
    }
}
