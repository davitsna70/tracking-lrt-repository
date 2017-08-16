<?php

namespace App\Http\Controllers;

use App\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource. perubahan terjadi pada model dan database User terkait role
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $userActivities = UserActivity::paginate(10);

        return view('data.user_activity.index')
            ->with('user_activities', $userActivities);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.user_activity.create');
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

        $user_activity = new UserActivity();
        $user_activity->user_id = $request->user_id;
        $user_activity->activity_id = $request->activity_id;
        $user_activity->save();

        (new LogActivity())->saveLog('telah membuat userActivity baru');

        return redirect('/data/user_activity/');
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

        $user_activity = UserActivity::find($id);

        return view('data.user_activity.show')
            ->with('user_activity', $user_activity);
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

        $user_activity = UserActivity::find($id);

        return view('data.user_activity.edit')
            ->with('user_activity', $user_activity);
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

        $user_activity = UserActivity::find($id);
        $user_activity->user_id = $request->user_id;
        $user_activity->activity_id = $request->activity_id;
        $user_activity->save();
        (new LogActivity())->saveLog('telah melakukan update userActivity '.$id);
        return redirect('/data/user_activity/'.$id.'/show');
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

        UserActivity::destroy($id);

        (new LogActivity())->saveLog('telah menghapus userActivity '.$id);

        return redirect('/data/user_activity/');
    }
}
