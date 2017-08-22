<?php

namespace App\Http\Controllers;

use App\Activity;
use App\AttachmentActivity;
use App\AttachmentComment;
use App\AttachmentListToDo;
use App\Comment;
use App\ListToDo;
use App\Notifications\AddMemberActivity;
use App\Notifications\CommentToActivity;
use App\Notifications\DoneChecklist;
use App\Notifications\FinishActivity;
use App\Notifications\LateActivity;
use App\Notifications\OngoingActivity;
use App\Notifications\RangeDateLate;
use App\Notifications\UndoneChecklist;
use App\Notifications\UpdateActivity;
use App\User;
use App\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;use App\LogActivity;

class MenuActivityController extends Controller
{
    private $rules = [
        'judul'=>'required',
//        'hak_akses'=>'required',
        'tanggal_mulai'=>'required',
        'tanggal_berakhir'=>'required',
//        'status'=>'required'
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = $this->getPublicActivities();
//        dd($this->getPrivateActivities());
        return view('user.activity.activity')
            ->with('activities', $activities);
    }

    public function indexWithAccessRight(Request $request){
//        dd($request);
        $activities = ($request->hak_akses=='private')?$this->getPrivateActivities():
            (($request->hak_akses=='public')?$this->getPublicActivities():$this->getTeamActivities());

        return view('user.activity.activity')
            ->with('activities', $activities);
    }

    private function getPrivateActivities(){
        $data = DB::table('activities')
            ->leftJoin('user_activities', 'activities.id', '=', 'user_activities.activity_id')
            ->where('user_activities.user_id', '=', Auth::user()->id)
            ->where('activities.hak_akses', '=', 'private')
            ->orWhere('activities.user_id', '=', Auth::user()->id)
            ->where('activities.hak_akses', '=', 'private')
            ->select('activities.*')
            ->distinct()
            ->orderBy('id','desc')
            ->get();
//        $data = Activity::where('hak_akses','=','private')->first();
//        dd($data);
        return $data;
    }

    private function getPublicActivities(){
        $data = DB::table('activities')
            ->leftJoin('user_activities', 'activities.id', '=', 'user_activities.activity_id')
            ->where('activities.hak_akses', '=', 'public')
            ->select('activities.*')
            ->distinct()
            ->orderBy('id','desc')
            ->get();
        return $data;
    }

    private function getTeamActivities(){
        $data = DB::table('activities')
            ->leftJoin('user_activities', 'activities.id', '=', 'user_activities.activity_id')
            ->join('users', 'users.id', '=', 'activities.user_id')
            ->join('groups', 'groups.id', '=', 'users.group_id')
            ->where('activities.hak_akses', '=', 'team')
            ->where('groups.id', '=', Auth::user()->group_id)
            ->select('activities.*')
            ->distinct()
            ->orderBy('id','desc')
            ->get();
        return $data;
    }

    public function save(Request $request){
//        dd(date("Y-m-d", strtotime($request->tanggal_mulai))<date("Y-m-d", strtotime($request->tanggal_berakhir)));
        $this->validate($request,
            $this->rules
        );
//        dd($request['checklist-judul'][0]);
//        dd($request['checklist-deskripsi-input'][0]);
        $activity = new Activity();

        $activity->user_id = Auth::user()->id;
        $activity->judul = $request->judul;
        $activity->deskripsi = ($request->deskripsi==null || $request->deskripsi=="")? null : $request->deskripsi;
        if (Auth::user()->role=='super_admin') {
            $activity->hak_akses = $request->hak_akses;
        }else{
            $activity->hak_akses = 'team';
        }
        $activity->tanggal_mulai = date("Y-m-d", strtotime($request->tanggal_mulai));
        $activity->tanggal_berakhir = date("Y-m-d", strtotime($request->tanggal_berakhir));
        if(date('Y-m-d')<date('Y-m-d', strtotime($activity->tanggal_mulai))){
            $activity->status = 'plan';
        }
        else if (date('Y-m-d')>=date('Y-m-d', strtotime($activity->tanggal_mulai)) && date('Y-m-d')<=date('Y-m-d', strtotime($activity->tanggal_berakhir))){
            $activity->status = 'ongoing';
        }
        else{
            $activity->status = 'late';
        }
        $activity->save();

        $activity = Activity::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('judul', '=', $activity->judul)
            ->first();

        if($request->hasFile('attachment_activity')){
            $attachmentActivity = new AttachmentActivity();
            $attachmentActivity->activity_id = $activity->id;
            $attachmentActivity->nama_asli_lampiran = $request->file('attachment_activity')->getClientOriginalName();
            $attachmentActivity->lampiran = $request->file('attachment_activity')->store('public/activity');
            $attachmentActivity->waktu_pembuatan = date("Y-m-d h:i:s");
            $attachmentActivity->save();
        }

        $iterator = 0;
        if ($request['checklist-judul'][0] == null){
            $listToDo = new ListToDo();
            $listToDo->judul = $activity->judul;
            $listToDo->user_id = Auth::user()->id;
            $listToDo->activity_id = $activity->id;
            $listToDo->save();
        }
        foreach ($request['checklist-judul'] as $checklist) {
            if ($checklist != null || $checklist != "") {
                $listToDo = new ListToDo();
                $listToDo->judul = $checklist;
                $listToDo->user_id = Auth::user()->id;
                $listToDo->activity_id = $activity->id;
                if ($request['checklist-deskripsi-input'][$iterator] != null || $request['checklist-deskripsi-input'][$iterator] != "") {
                    $listToDo->deskripsi = $request['checklist-deskripsi-input'][$iterator];
                }

                $listToDo->status = "undone";
                $listToDo->save();

                $listToDo = ListToDo::all()
                    ->where('activity_id', '=', $activity->id)
                    ->where('judul', '=', $checklist)
                    ->where('user_id', '=', Auth::user()->id)
                    ->first();
                if ($request->hasFile('checklist-attachment-input')) {
                    $files_key = array_keys($request->file(['checklist-attachment-input']));
                    if (in_array($iterator, $files_key)) {
                        $attachmentListToDo = new AttachmentListToDo();
                        $attachmentListToDo->list_to_do_id = $listToDo->id;
                        $attachmentListToDo->nama_asli_lampiran = $request->file(['checklist-attachment-input'])[$iterator]->getClientOriginalName();
                        $attachmentListToDo->lampiran = $request->file(['checklist-attachment-input'])[$iterator]->store('public/list_to_do');
                        $attachmentListToDo->waktu_pembuatan = date("Y-m-d h:i:s");
                        $attachmentListToDo->save();
                    }
                }
                $iterator++;
            }
        }

        if($request->memberName != null){
            foreach ($request->memberName as $member){
                $user = User::all()
                    ->where('name', '=', $member)
                    ->first();
                if(count(UserActivity::where('activity_id', '=', $activity->id)->where('user_id', '=', $user->id)->get())>0){
                    continue;
                }
                if($user!=null){
                    $userActivity = new UserActivity();
                    $userActivity->user_id = $user->id;
                    $userActivity->activity_id = $activity->id;
                    $userActivity->save();
                    $user->notify(new AddMemberActivity($activity));
                }

            }
        }

        (new LogActivity())->saveLog('telah menambahkan activity baru');

        return redirect('/activity');
    }

    public function searchByName(Request $request){
        $term = $request->term;


        if(Auth::user()->role == 'member_group'){
            $items = User::where('name', 'like', '%'.$term.'%')
                ->where('role','=','member_group')
                ->where('group_id', '=', Auth::user()->group->id)
                ->get();
        }
        elseif (Auth::user()->role == 'group_admin'){
            $items = User::where('role','=','group_admin')
                ->where('name', 'like', '%'.$term.'%')
                ->where('group_id', '=', Auth::user()->group->id)
//                ->orWhere('role','=', 'viewer')
//                ->where('name', 'like', '%'.$term.'%')
                ->orWhere('role','=','member_group')
                ->where('name', 'like', '%'.$term.'%')
                ->where('group_id', '=', Auth::user()->group->id)
                ->get();
        }
        else{
            $items = User::where('role','=','group_admin')
                ->where('name', 'like', '%'.$term.'%')
                ->orWhere('role','=','member_group')
                ->where('name', 'like', '%'.$term.'%')
//                ->orWhere('role','=', 'viewer')
//                ->where('name', 'like', '%'.$term.'%')
                ->get();
        }

        if(count($items)==0){
            $data[]= 'No Data Found';
        }
        else{
            foreach ($items as $key=>$value) {
                $data[] = $value->name;
            }
        }

        return $data;
    }

    public function create(){
        return view("user/activity/create");
    }

    public function edit($id){
        $activity = Activity::find($id);
        $userActivity = UserActivity::where('activity_id','=',$activity->id)->get();
        return view("user.activity.edit")
            ->with('activity', $activity)
            ->with('user_activity',$userActivity);
    }

    public function update(Request $request, $id){
        $this->validate($request,
            $this->rules
        );

//        dd($request['checklist-deskripsi-input'][0]);
        $activity = Activity::find($id);

        $activity->user_id = Auth::user()->id;
        $activity->judul = $request->judul;
        $activity->deskripsi = ($request->deskripsi==null || $request->deskripsi=="")? null : $request->deskripsi;
        if (Auth::user()->role == 'super_admin') {
            $activity->hak_akses = $request->hak_akses;
        }
        else{
            $activity->hak_akses = 'team';
        }
        $activity->tanggal_mulai = date("Y-m-d", strtotime($request->tanggal_mulai));
        $activity->tanggal_berakhir = date("Y-m-d", strtotime($request->tanggal_berakhir));
        if(date('Y-m-d')<date('Y-m-d', strtotime($activity->tanggal_mulai))){
            $activity->status = 'plan';
        }
        else if (date('Y-m-d')>=date('Y-m-d', strtotime($activity->tanggal_mulai)) && date('Y-m-d')<=date('Y-m-d', strtotime($activity->tanggal_berakhir))){
            $activity->status = 'ongoing';
        }
        else{
            $activity->status = 'late';
        }
//        $activity->status = $request->status;
        $activity->save();

        $activity = Activity::all()
            ->where('user_id', '=', Auth::user()->id)
            ->where('judul', '=', $activity->judul)
            ->first();

        if($request->hasFile('attachment_activity')){
            $attachmentActivity = new AttachmentActivity();
            $attachmentActivity->activity_id = $activity->id;
            $attachmentActivity->nama_asli_lampiran = $request->file('attachment_activity')->getClientOriginalName();
            $attachmentActivity->lampiran = $request->file('attachment_activity')->store('public/activity');
            $attachmentActivity->waktu_pembuatan = date("Y-m-d h:i:s");
            $attachmentActivity->save();
        }

        $iterator = 0;
        if(count($activity->list_to_dos)==0 && $request['checklist-judul'][0]==null){
            $listToDo = new ListToDo();
            $listToDo->judul = $activity->judul;
            $listToDo->user_id = Auth::user()->id;
            $listToDo->activity_id = $activity->id;
            $listToDo->save();
        }
        foreach ($request['checklist-judul'] as $checklist) {
            if ($checklist != null || $checklist != "") {
                $listToDo = new ListToDo();
                $listToDo->judul = $checklist;
                $listToDo->user_id = Auth::user()->id;
                $listToDo->activity_id = $activity->id;
                if ($request['checklist-deskripsi-input'][$iterator] != null || $request['checklist-deskripsi-input'][$iterator] != "") {
                    $listToDo->deskripsi = $request['checklist-deskripsi-input'][$iterator];
                }

                $listToDo->status = "undone";
                $listToDo->save();

                $listToDo = ListToDo::all()
                    ->where('activity_id', '=', $activity->id)
                    ->where('judul', '=', $checklist)
                    ->where('user_id', '=', Auth::user()->id)
                    ->first();
                if ($request->hasFile('checklist-attachment-input')) {
                    $files_key = array_keys($request->file(['checklist-attachment-input']));
                    if (in_array($iterator, $files_key)) {
                        $attachmentListToDo = new AttachmentListToDo();
                        $attachmentListToDo->list_to_do_id = $listToDo->id;
                        $attachmentListToDo->nama_asli_lampiran = $request->file(['checklist-attachment-input'])[$iterator]->getClientOriginalName();
                        $attachmentListToDo->lampiran = $request->file(['checklist-attachment-input'])[$iterator]->store('public/list_to_do');
                        $attachmentListToDo->waktu_pembuatan = date("Y-m-d h:i:s");
                        $attachmentListToDo->save();
                    }
                }
                $iterator++;
            }
        }

        if($request->memberName != null){
            foreach ($request->memberName as $member){
                $user = User::all()
                    ->where('name', '=', $member)
                    ->first();
                if(count(UserActivity::where('activity_id', '=', $activity->id)->where('user_id', '=', $user->id)->get())>0){
                    continue;
                }
                if($user!=null){
                    $userActivity = new UserActivity();
                    $userActivity->user_id = $user->id;
                    $userActivity->activity_id = $activity->id;
                    $userActivity->save();
                    $user->notify(new AddMemberActivity($activity));
                }

            }
        }

        $userActivities = UserActivity::where('activity_id', '=', $activity->id)->get();
        foreach($userActivities as $userActivity){
            $userActivity->user->notify(new UpdateActivity(Auth::user(), $activity));
        }

        (new LogActivity())->saveLog('telah melakukan update activity '.$id);

        return redirect('/activity/'.$id.'/show');
    }

    public function show($id)
    {
        Auth::user()->hasRole(['super_admin', 'group_admin', 'member_group']);

        $activity = Activity::find($id);
        $comments = Comment::where('activity_id', '=', $id)->get();

        $progress = $activity->getPersentageProgress();
//        if(count($activity->list_to_dos)>0){
//            $done = count(ListToDo::where('activity_id', '=', $activity->id)
//                ->where('status', '=', 'done')
//                ->get());
//            $all = count(ListToDo::where('activity_id', '=', $activity->id)
//                ->get());
//            $progress = ($done/$all) * 100;
//        }

        return view('user.activity.show')
            ->with('activity', $activity)
            ->with('comments', $comments)
            ->with('progress', $progress);
    }

    public function comment(Request $request, $id){
        $this->validate($request,
            [
                'komentar'=>'required'
            ]);
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->activity_id = $id;
        $comment->isi = $request->komentar;
        $comment->save();

        if ($request->hasFile('lampiran')){
            $comment = Comment::where('user_id', '=', Auth::user()->id)
                ->where('activity_id','=',$id)
                ->where('isi','=',$request->komentar)
                ->first();
            $attachmentComment = new AttachmentComment();
            $attachmentComment->comment_id = $comment->id;
            $attachmentComment->nama_asli_lampiran = $request->file('lampiran')->getClientOriginalName();
            $attachmentComment->lampiran = $request->file('lampiran')->store('public/comment');
            $attachmentComment->waktu_pembuatan = date("Y-m-d h:i:s");
            $attachmentComment->save();
        }

        $user = Auth::user();

        $members = UserActivity::where('activity_id', '=', $id)->get();
        foreach($members as $member){
            $member->user->notify(new CommentToActivity($id, $comment, $user));
        }
        Activity::find($id)->user->notify(new CommentToActivity($id, $comment, $user));

        (new LogActivity())->saveLog('telah menambakan comment pada activity '.$id);

        return redirect('/activity/'.$id.'/show');
    }

    public function doneListToDo($id){
        $listToDo = ListToDo::find($id);
        $listToDo->status = 'done';
        $listToDo->user_id = Auth::user()->id;
        $listToDo->save();

        $done = count(ListToDo::where('activity_id', '=', $listToDo->activity->id)
            ->where('status', '=', 'done')
            ->get());
        $all = count(ListToDo::where('activity_id', '=', $listToDo->activity->id)
            ->get());

        Activity::find($listToDo->activity->id)->user->notify(new DoneChecklist(Auth::user(), Activity::find($listToDo->activity->id)));

        if($done == $all){
            $activity = Activity::find($listToDo->activity->id);
            $activity->status = 'done';
            $activity->waktu_selesai = date("Y-m-d h:i:s");
            $activity->save();

            $userActivities = UserActivity::where('activity_id', '=', $activity->id);
            foreach ($userActivities as $userActivity){
                $userActivity->user->notify(new FinishActivity($activity));
            }
            $activity->user->notify(new FinishActivity($activity));
        }

        (new LogActivity())->saveLog('telah mengubah status done pada list to do '.$id);

        return redirect('/activity/'.$listToDo->activity->id.'/show');
    }

    public function undoneListToDo($id){
        $listToDo = ListToDo::find($id);
        $listToDo->status = 'undone';
        $listToDo->user_id = Auth::user()->id;
        $listToDo->save();

        Activity::find($listToDo->activity->id)->user->notify(new UndoneChecklist(Auth::user(), Activity::find($listToDo->activity->id)));

        if($listToDo->activity->status == 'done'){
            $activity = Activity::find($listToDo->activity->id);
            if(date('Y-m-d')<date('Y-m-d', strtotime($activity->tanggal_mulai))){
                $activity->status = 'plan';
            }
            else if (date('Y-m-d')>=date('Y-m-d', strtotime($activity->tanggal_mulai)) && date('Y-m-d')<=date('Y-m-d', strtotime($activity->tanggal_berakhir))){
                $activity->status = 'ongoing';
            }
            else{
                $activity->status = 'late';
            }
//            $activity->status = 'ongoing';
            $activity->waktu_selesai = null;
            $activity->save();
        }

        (new LogActivity())->saveLog('telah mengubah status undone pada list to do '.$id);

        return redirect('/activity/'.$listToDo->activity->id.'/show');
    }

    public function listToDoDelete($id,$id2){
        ListToDo::find($id)->delete();

        (new LogActivity())->saveLog('telah menghapus list to do '.$id);

        return redirect('/activity/'.$id2.'/edit');
    }


    public function memberDelete($id,$id2){
        UserActivity::find($id)->delete();

        (new LogActivity())->saveLog('telah menghapus member '.$id);

        return redirect('/activity/'.$id2.'/edit');
    }

    public function lateActivity(){
        $activities = Activity::where('status', '=', 'ongoing')
            ->where('tanggal_berakhir', '<', date('Y-m-d'))
            ->get();

        foreach ($activities as $activity){
            $activity->user->notify(new LateActivity($activity));
            $userActivities = UserActivity::where('activity_id', '=', $activity->id);

            $activity->status = 'late';
            $activity->save();

            foreach ($userActivities as $userActivity){
                $userActivity->user->notify(new LateActivity($activity));
            }
        }
    }

    public function ongoingActivity(){
        $activities = Activity::where('status', '=', 'plan')
            ->where('tanggal_mulai', '<=', date('Y-m-d'))
            ->where('tanggal_berakhir','>=', date('Y-m-d'))
            ->get();
//        if($activities == null){
//            echo 'null';
//        }
//        else{
//            echo 'not null';
//            dd($activities);
//        }

        foreach ($activities as $activity){
            echo $activity->id.'shgdahgdsa';
            $activity->user->notify(new OngoingActivity($activity));
            $userActivities = UserActivity::where('activity_id', '=', $activity->id);

            $activity->status = 'ongoing';
            $activity->save();

            foreach ($userActivities as $userActivity){
                $userActivity->user->notify(new OngoingActivity($activity));
            }
        }
    }

    public function rangeTimeActivity(){
        $activities = Activity::where('status', '=', 'ongoing')
            ->get();

        foreach ($activities as $activity){
            $rangeTime = ceil(abs((strtotime($activity->tanggal_berakhir)-strtotime(date('Y-m-d')))/86400));
            if($rangeTime<=5) {
                $activity->user->notify(new RangeDateLate($activity, $rangeTime));
                $userActivities = UserActivity::where('activity_id', '=', $activity->id);

                foreach ($userActivities as $userActivity) {
                    $userActivity->user->notify(new RangeDateLate($activity, $rangeTime));
                }
            }
        }
    }
}
