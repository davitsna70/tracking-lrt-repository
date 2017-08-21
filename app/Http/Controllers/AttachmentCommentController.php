<?php

namespace App\Http\Controllers;

use App\AttachmentComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class AttachmentCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $attachmentComments = AttachmentComment::paginate(10);

        return view('data.attachment_comment.index')
            ->with('attachment_comments', $attachmentComments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.attachment_comment.create');
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

        $attachment_comment = new AttachmentComment();
        $attachment_comment->comment_id = $request->comment_id;
        //$attachment_comment->lampiran = $request->lampiran;
        if($request->hasFile('lampiran')){
            $attachment_comment->nama_asli_lampiran = $request->file('lampiran')->getClientOriginalName();
            $attachment_comment->lampiran = $request->file('lampiran')->store('public/comment');
        }
        $attachment_comment->waktu_pembuatan = date("Y-m-d h:i:s");
        $attachment_comment->save();

        (new LogActivity())->saveLog('telah menambahkan lampiran comment baru');

        return redirect('/data/attachment_comment');
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

        $attachment_comment = AttachmentComment::find($id);

        return view('data.attachment_comment.show')
            ->with('attachment_comment',$attachment_comment);
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

        $attachment_comment = AttachmentComment::find($id);

        return view('data.attachment_comment.edit')
            ->with('attachment_comment', $attachment_comment);
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

        $attachment_comment = AttachmentComment::find($id);
        $attachment_comment->comment_id = $request->comment_id;
        //$attachment_comment->lampiran = $request->lampiran;
        if($request->hasFile('lampiran')){
            $attachment_comment->nama_asli_lampiran = $request->file('lampiran')->getClientOriginalName();
            $attachment_comment->lampiran = $request->file('lampiran')->store('public/comment');
        }
        $attachment_comment->save();

        (new LogActivity())->saveLog('telah melakukan update lampiran comment '.$id);

        return redirect('/data/attachment_comment/'.$id.'/show');
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

        AttachmentComment::destroy($id);

        (new LogActivity())->saveLog('telah menghapus lampiran comment '.$id);

        return redirect('/data/attachment_comment');
    }
}
