<?php

namespace App\Http\Controllers;

use App\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\LogActivity;

class MenuArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function archive()
    {
        $archives = Archive::where('user_id', '=', Auth::user()->id)->get();
//        dd($archives);
        return view('user.archive.archive')
            ->with('archives', $archives);
    }

    public function addToArchive($id){
        $archive = new Archive();
        $archive->user_id = Auth::user()->id;
        $archive->activity_id = $id;
        $archive->waktu_pembuatan = date("Y-m-d h:i:s");
        $archive->save();

        (new LogActivity())->saveLog('telah menambahkan arsip baru');

        return redirect('/archive/');
    }

    public function deleteFromArchive($id){
        $archive = Archive::find($id);
        $archive->delete();

        (new LogActivity())->saveLog('telah menghapus archive '.$id);

        return redirect('/archive/');
    }
}
