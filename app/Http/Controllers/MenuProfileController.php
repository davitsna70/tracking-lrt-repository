<?php

namespace App\Http\Controllers;

use App\Group;
use App\Profile;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;use App\LogActivity;

class MenuProfileController extends Controller
{
    public function selfProfile(){
        $user = Auth::user();
        return view('user.profile.profile_private')
            ->with('user', $user);
    }

    public function otherProfile($id){
        $user = User::find($id);
        return view('user.profile.profile_private')
            ->with('user', $user);
    }

    public function selfTeamProfile(){
        $team = Auth::user()->group;
        return view('user.profile.profile_team')
            ->with('team', $team);
    }

    public function otherTeamProfile($id){
        $team = Group::find($id);
        return view('user.profile.profile_team')
            ->with('team', $team);
    }

    public function resetPassword(){
        return view('user.profile.reset_password')
            ->with('err', null)
            ->with('succ', null);
    }

    public function saveResetPassword(Request $request){
        $this->validate($request,
            [
                'password_lama'=>'required',
                'password_baru'=>'required',
                'konfirmasi_password'=>'required|same:password_baru'
            ]);

        if(!Hash::check($request->password_lama, Auth::user()->getAuthPassword())){
            return view('user.profile.reset_password')
                ->with('err', 'The password lama not match from table')
                ->with('succ', null);
        }

        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password_baru);
        $user->save();

        (new LogActivity())->saveLog('telah melakukan reset password');

        return view('user.profile.reset_password')
            ->with('err', null)
            ->with('succ', 'password has been changed...');
    }

    public function changeProfilePerson(){
        $user = Auth::user();
        return view('user.profile.profile_private_edit')
            ->with('user', $user);
    }

    public function updateProfilePerson(Request $request){
        $this->validate($request,
            [
                'email'=>'email|required'
            ]);
        $user = User::find(Auth::user()->id);
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->save();

        $profile = Profile::find(Auth::user()->profile->id);
        $profile->tempat_lahir = $request->tempat_lahir;
        $profile->tanggal_lahir = date("Y-m-d", strtotime($request->tanggal_lahir));
        $profile->alamat_tinggal = $request->alamat_tinggal;
        $profile->jenis_kelamin = $request->jenis_kelamin;
        $profile->nomor_telepon = $request->nomor_telepon;
        $profile->waktu_update = date("Y-m-d h:i:s");
        if ($request->hasFile('foto_profil')){
            $profile->nama_asli_foto = $request->file('foto_profil')->getClientOriginalName();
            $profile = $request->file('foto_profil')->store('public/profile');
        }
        $profile->save();

        (new LogActivity())->saveLog('telah melakukan perubahan pada profile');

        return redirect('/profile/');
    }

    public function changeProfileTeam(){
        Auth::user()->hasRole(['group_admin']);
        $team = Auth::user()->group;
        return view('user.profile.profile_team_edit')
            ->with('team', $team);
    }

    public function updateProfileTeam(Request $request){
        Auth::user()->hasRole(['group_admin']);
        $this->validate($request,
            [
                'nama_group'=>'required',
                'alamat_kantor'=>'required',
                'nomor_telepon'=>'required',
                'fax'=>'required',
                'email'=>'email|required'
            ]);

        $team = Group::find(Auth::user()->group->id);
        $team->nama_group = $request->nama_group;
        $team->alamat_kantor = $request->alamat_kantor;
        $team->nomor_telepon = $request->nomor_telepon;
        $team->fax = $request->fax;
        $team->email = $request->email;
        $team->save();

        (new LogActivity())->saveLog('telah melakuann perubahan pada profile team '.$team->nama_group);

        return redirect('/profile/team/');
    }
}
