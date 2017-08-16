<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;use App\LogActivity;

class MenuMemberGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin', 'group_admin']);

        $users = User::where('role','=','member_group')->where('group_id','=',Auth::user()->group_id)->paginate(10);

        return view('user.member_group.index')
            ->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin', 'group_admin']);

        return view('user.member_group.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Auth::user()->hasRole(['super_admin', 'group_admin']);

        $this->validate($request,
            [
                'nama'=>'required',
                'email'=>'required|unique:users',
                'password'=>'required',
                'confirm_password'=>'required|same:password'
            ]
            );

        $user = new User();
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'member_group';

        if (Auth::user()->role=='super_admin'){
            $user->group_id = $request->group_id;
        }else{
            $user->group_id = Auth::user()->group->id;
        }

        $user->save();

        $user = User::where('email', '=', $request->email)->first();
        $profile = new Profile();
        $profile->user_id = $user->id;
        $profile->foto_profil = 'na.png';
        $profile->nama_asli_foto = 'na.png';
        $profile->waktu_update = date("Y-m-d h:i:s");
        $profile->save();

        (new LogActivity())->saveLog('telah menambahkan member grup baru');

        return redirect('/member_group/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        Auth::user()->hasRole(['super_admin', 'group_admin']);

        $user = User::find($id);

        return view('user.member_group.show')
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
        Auth::user()->hasRole(['super_admin', 'group_admin']);

        $user = User::find($id);

        return view('user.member_group.edit')
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
        Auth::user()->hasRole(['super_admin', 'group_admin']);

        $this->validate($request,
            [
                'nama'=>'required',
                'email'=>'required|unique:users'
            ]);

        $user = User::find($id);
        $user->name = $request->nama;
        $user->email = $request->email;
//        $user->role = $request->role;
        if (Auth::user()->role=='super_admin'){
            $user->group_id = $request->group_id;
        }
        $user->save();

        (new LogActivity())->saveLog('telah melakukan edit member grup '.$id);

        return redirect('/member_group/'.$id.'/show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Auth::user()->hasRole(['super_admin', 'group_admin']);

        User::destroy($id);

        (new LogActivity())->saveLog('telah menghapus grup admin '.$id);

        return redirect('/member_group/');
    }
}
