<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use function Symfony\Component\VarDumper\Tests\Caster\reflectionParameterFixture;
use Illuminate\Support\Facades\Auth;use App\LogActivity;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->hasRole(['super_admin']);

        $messages = Message::paginate(10);

        return view('data.message.index')
            ->with('messages', $messages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Auth::user()->hasRole(['super_admin']);

        return view('data.message.create');
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

        $message = new Message();
        $message->user_id = $request->user_id;
        $message->tujuan = $request->tujuan;
        $message->isi = $request->isi;
        $message->lampiran = $request->lampiran;
        $message->status_baca = $request->status_baca;
        $message->waktu_pengiriman = date("Y-m-d h:i:s");
        $message->save();

        (new LogActivity())->saveLog('telah membuat message baru');

        return redirect('/data/message/');
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

        $message = Message::find($id);

        return view('data.message.show')
            ->with('message', $message);
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

        $message = Message::find($id);

        return view('data.message.edit')
            ->with('message', $message);
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

        $message = Message::find($id);
        $message->user_id = $request->user_id;
        $message->tujuan = $request->tujuan;
        $message->isi = $request->isi;
        $message->lampiran = $request->lampiran;
        $message->status_baca = $request->status_baca;
        $message->save();

        (new LogActivity())->saveLog('telah melakukan update message '.$id);

        return redirect('/data/message/'.$id.'/show');
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

        Message::destroy($id);

        (new LogActivity())->saveLog('telah menghapus message '.$id);

        return redirect('/data/message/');
    }
}
