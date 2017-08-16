<?php

namespace App\Http\Controllers;

use App\Group;
use App\LogActivity;
use App\Profile;
use App\User;
use App\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        Auth::user()->hasRole(['super_admin']);

        $users = User::paginate(10);

        return view('data.user.index')
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

        return view('data.user.create');
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
        $user->role = $request->role;
        $user->group_id = $request->group_id;
        $user->save();

        (new LogActivity())->saveLog('telah membuat user baru');

        return redirect('/data/user/');
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

        return view('data.user.show')
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

        return view('data.user.edit')
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
        $user->role = $request->role;
        $user->group_id = $request->group_id;
        $user->save();

        (new LogActivity())->saveLog('telah melakukan update user '.$user->id);

        return redirect('/data/user/'.$id.'/show');
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

        User::find($id)->delete();

//        User::destroy($id);
        (new LogActivity())->saveLog('telah menghapus user '.$id);

        return redirect('/data/user/');
    }

    public function add()
    {
//        Auth::user()->hasRole(['super_admin']);
        if(count(User::where('email', '=', 'maritim@maritim.go.id')->get())==0){
            $group = new Group();
            $group->nama_group = 'maritim';
            $group->save();

            $user = new User();
            $user->name = 'maritim';
            $user->email = 'maritim@maritim.go.id';
            $user->password = Hash::make('jayamaritim');
            $user->role = 'super_admin';
            $user->group_id = Group::where('nama_group', $group->nama_group)->first()->id;
            $user->save();

            $user = User::where('email', '=', 'maritim@maritim.go.id')->first();
            $profile = new Profile();
            $profile->user_id = $user->id;
            $profile->jenis_kelamin = 'pria';
            $profile->waktu_update = date("Y-m-d h:i:s");
            $profile->save();
        }

        return redirect('/login');

//        (new LogActivity())->saveLog('telah membuat user baru');

//        return redirect('/data/user/');
    }
}
