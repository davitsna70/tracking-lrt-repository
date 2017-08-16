<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;use App\LogActivity;

class MenuViewerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $users = User::where('role','=','viewer')->paginate(10);

        return view('user.viewer.index')
            ->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('user.viewer.create');
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

        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'viewer';
        $user->group_id = $request->group_id;
        $user->save();

        $user = User::where('email', '=', $request->email)->first();
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->foto_profil = 'na.png';
        $profile->nama_asli_foto = 'na.png';
        $profile->save();

        (new LogActivity())->saveLog('telah menyimpan user viewer baru');

        return redirect('/viewer/');
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

        $user = User::find($id);

        return view('user.viewer.show')
            ->with('user', $user);
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

        $user = User::find($id);

        return view('user.viewer.edit')
            ->with('user', $user);
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

        if(Auth::check())
            Auth::user()->hasRole(['super_admin']);
        else
            redirect('/login');

        $user = User::find($id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->role = 'viewer';
        $user->group_id = $request->group_id;
        $user->save();

        (new LogActivity())->saveLog('telah melakukan update viewer '.id);

        return redirect('/viewer/'.$id.'/show');
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

        User::destroy($id);

        (new LogActivity())->saveLog('telah menghapus viewer '.$id);

        return redirect('/viewer/');
    }
}
