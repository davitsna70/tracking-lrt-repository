<?php

namespace App\Http\Controllers;

use App\AttachmentActivity;
use App\AttachmentComment;
use App\AttachmentListToDo;
use App\Profile;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function getProfilePhoto($filename){
        $name = Profile::where('foto_profil', 'like', '%'.$filename.'%')->get()->first()->nama_asli_foto;
        return response()->download(Storage_path('app/public/profile/'.$filename),$name,[],'inline');
    }

    public function getListToDoFile($filename){
        $name = AttachmentListToDo::where('lampiran', 'like', '%'.$filename.'%')->get()->first()->nama_asli_lampiran;
        return response()->download(Storage_path('app/public/list_to_do/'.$filename),$name,[],'attachment');
    }

    public function getCommentFile($filename){
        $name = AttachmentComment::where('lampiran', 'like', '%'.$filename.'%')->get()->first()->nama_asli_lampiran;
        return response()->download(Storage_path('app/public/comment/'.$filename),$name,[],'attachment');
    }

    public function getActivityFile($filename){
        $name = AttachmentActivity::where('lampiran', 'like', '%'.$filename.'%')->get()->first()->nama_asli_lampiran;
        return response()->download(Storage_path('app/public/activity/'.$filename),$name,[],'attachment');
    }
}
