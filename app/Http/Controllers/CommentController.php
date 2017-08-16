<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $comments = Comment::paginate(10);

        return view('data.comment.index')
            ->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.comment.create');
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

        $comment = new Comment();
        $comment->user_id = $request->user_id;
        $comment->activity_id = $request->activity_id;
        $comment->isi = $request->isi;
        $comment->save();

        (new LogActivity())->saveLog('telah membuat comment baru');

        return redirect('/data/comment/');
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

        $comment = Comment::find($id);

        return view('data.comment.show')
            ->with('comment', $comment);
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

        $comment = Comment::find($id);

        (new LogActivity())->saveLog('telah melakukan edit comment '.$id);

        return view('data.comment.edit')
            ->with('comment', $comment);
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

        $comment = Comment::find($id);
        $comment->user_id = $request->user_id;
        $comment->activity_id = $request->activity_id;
        $comment->isi = $request->isi;
        $comment->save();

        return redirect('/data/comment/'.$id.'/show');
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

        Comment::find($id)->delete();

//        Comment::destroy($id);
        (new LogActivity())->saveLog('telah menghapus comment '.$id);

        return redirect('/data/comment');
    }
}
