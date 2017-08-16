@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            List To Dos<small>List To Do</small>
        </h1>
        <ol class="breadcrumb">
            <li>List To Dos</li>
            <li class="active">List To Do</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">List To Do</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    @foreach($activities as $activity)
                                        @foreach($activity->list_to_dos as $list_to_do)
                                            <li title="{{$activity->judul.' dari '.$activity->tanggal_mulai.'s/d'.$activity->tanggal_berakhir}}">{{$list_to_do->judul}}<br>
                                                <a href="{{url('/activity/'.$activity->id.'/show')}}">{{$activity->judul}}</a><br>
                                                @if($list_to_do->deskripsi!=null)
                                                    <p>Deskripsi : {{$list_to_do->deskripsi}}</p>
                                                @endif
                                                @if($list_to_do->attachment_list_to_dos!=null)
                                                    @foreach($list_to_do->attachment_list_to_dos as $lampiran)
                                                        <a href="/list_to_do/file/{{basename($lampiran->lampiran)}}">{{$lampiran->nama_asli_lampiran}}</a>
                                                        <br>
                                                    @endforeach
                                                @endif
                                                @if($activity->user->id == Auth::user()->id || count(\App\UserActivity::where('activity_id', '=',$activity->id)->where('user_id', '=', Auth::user()->id)->get())>0)
                                                    @if($list_to_do->status=='undone')
                                                        <a href="{{url('/activity/list_to_do/done/'.$list_to_do->id)}}" class="btn btn-success btn-xs">Done</a>
                                                        @if($list_to_do->user!=null)<p class="inline">Undone by: {{$list_to_do->user->name}}</p>@endif
                                                    @else
                                                        <a href="{{url('/activity/list_to_do/undone/'.$list_to_do->id)}}" class="btn btn-warning btn-xs">Undone</a>
                                                        @if($list_to_do->user!=null)<p class="inline">Done by: {{$list_to_do->user->name}}</p>@endif
                                                    @endif
                                                @endif
                                            </li>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
