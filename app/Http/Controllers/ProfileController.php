<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $profiles = Profile::paginate(10);

        return view('data.profile.index')
            ->with('profiles', $profiles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.profile.create');
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

        $profile = new Profile();
        $profile->user_id = $request->user_id;
        if($request->hasFile('foto_profil')){
            $profile->nama_asli_foto = $request->file('foto_profil')->getClientOriginalName();
            $profile->foto_profil = $request->file('foto_profil')->store('public/profile');
        }
        $profile->tempat_lahir = $request->tempat_lahir;
        $profile->tanggal_lahir = date("Y-m-d", strtotime($request->tanggal_lahir));
        $profile->alamat_tinggal = $request->alamat_tinggal;
        $profile->jenis_kelamin = $request->jenis_kelamin;
        $profile->nomor_telepon = $request->nomor_telepon;
        $profile->waktu_update = date("Y-m-d h:i:s");
        $profile->save();

        (new LogActivity())->saveLog('telah membuat profile baru');

        return redirect('/data/profile/');
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

        $profile = Profile::find($id);

        return view('data.profile.show')
            ->with('profile', $profile);
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

        $profile = Profile::find($id);

        return view('data.profile.edit')
            ->with('profile', $profile);
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

        $profile = Profile::find($id);
        $profile->user_id = $request->user_id;
        if($request->hasFile('foto_profil')){
            $profile->nama_asli_foto = $request->file('foto_profil')->getClientOriginalName();
            $profile->foto_profil = $request->file('foto_profil')->store('public/profile');
        }
        $profile->tempat_lahir = $request->tempat_lahir;
        $profile->tanggal_lahir = date("Y-m-d", strtotime($request->tanggal_lahir));
        $profile->alamat_tinggal = $request->alamat_tinggal;
        $profile->jenis_kelamin = $request->jenis_kelamin;
        $profile->nomor_telepon = $request->nomor_telepon;
        $profile->waktu_update = date("Y-m-d h:i:s");
        $profile->save();

        (new LogActivity())->saveLog('telah melakukan update profile '.$id);

        return redirect('/data/profile/'.$id.'/show');
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

        Profile::destroy($id);

        (new LogActivity())->saveLog('telah menghapus profile '.$id);

        return redirect('/data/profile/');
    }
}
