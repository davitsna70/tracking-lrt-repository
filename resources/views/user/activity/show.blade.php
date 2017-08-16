@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Activity</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
            @if(count($errors)>0)
                <div class="callout callout-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Judul : {{$activity->judul}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-xs-12">
                        {{--<div class="container">--}}
                        <div class="post">
                            <br>
                            <strong>Dibuat Oleh : </strong>
                            <div class="user-block inline">
                                <img class="img-circle img-bordered-sm" title="{{\App\Activity::find($activity->id)->user->name}}" src="{{url("/profile/photo/".
                                                basename(\App\Activity::find($activity->id)->user->profile->foto_profil))}}" alt="user image">
                                <span class="username">
                                              <a href="#">{{\App\Activity::find($activity->id)->user->name}}</a>
                                    {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                            </span>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>Dikirim pada  </td>
                                            <td>: {{$activity->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>Batas Waktu  </td>
                                            <td>: {{$activity->tanggal_mulai}} s/d {{$activity->tanggal_berakhir}}</td>
                                        </tr>
                                        <tr>
                                            <td>Hak Akses </td>
                                            <td>: {{$activity->hak_akses}}</td>
                                        </tr>
                                        <tr>
                                            <td>Status </td>
                                            <td>: {{$activity->status}}</td>
                                        </tr>
                                        <tr>
                                            <td>Waktu Selesai  </td>
                                            <td>: {{$activity->waktu_selesai}}</td>
                                        </tr>
                                        <tr>
                                            <td>Deskripsi </td>
                                            <td>: {{$activity->deskripsi}}</td>
                                        </tr>
                                        @if($activity->attachment_activities!=null)
                                            @foreach($activity->attachment_activities as $lampiran)
                                                <tr>
                                                    <td>Lampiran Aktivitas </td>
                                                    <td>: <a href="/activity/file/{{basename($lampiran->lampiran)}}">{{$lampiran->nama_asli_lampiran}}</a></td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </table>
                                </div>
                                <div class="col-sm-12">
                                    <h4>Progress</h4>
                                    <div class="progress progress-sm active" title="{{$progress}}%">
                                        <div class="progress-bar progress-bar-{{($activity->status=='plan')?'default':(($activity->status=='ongoing')?'primary':(($activity->status=='late')?'danger':(($activity->status=='pending')?'warning':'success')))}}  progress-bar-striped" role="progressbar" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$progress}}%">
                                            <span class="sr-only">{{$progress}}% Complete</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <strong><p>Checklist : </p></strong>
                            <ul>
                                @foreach($activity->list_to_dos as $list_to_do)
                                    <li>{{$list_to_do->judul}}<br>
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
                            </ul>

                            <strong><p>Member : </p></strong>
                            <div class="user-block">
                                @foreach(\App\UserActivity::all()->where('activity_id', '=', $activity->id) as $member)
                                    <img class="img-circle img-bordered-sm" title="{{$member->user->name}}" src="{{url("/profile/photo/".basename($member->user->profile->foto_profil))}}"
                                         alt="image not found">
                                @endforeach
                            </div>
                            @if($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                <a href="{{url('/activity/'.$activity->id.'/edit')}}"><button type="button" class="btn btn-warning" data-target="#detailActivity" >Edit</button></a>
                            @endif
                        </div>
                        {{--</div>--}}

                        <div class="box container">
                            <br>
                            <strong><p>Comments</p></strong>
                            <hr>
                            @forelse($comments as $comment)

                                <div class="box-footer box-comments">
                                    <div class="box-comment">
                                        <!-- User image -->
                                        <img class="img-circle img-sm" src="{{url("/profile/photo/".
                                                basename($comment->user->profile->foto_profil))}}" alt="user image">

                                        <div class="comment-text">
                      <span class="username">
                        {{$comment->user->name}}
                          <span class="text-muted pull-right">Dibuat Pada : {{$comment->created_at}}</span>
                      </span><!-- /.username -->
                                            {{$comment->isi}}<br>
                                            @forelse($comment->attachment_comments as $lampiran)
                                                <p>lampiran : <a href="/comment/file/{{basename($lampiran->lampiran)}}">{{$lampiran->nama_asli_lampiran}}</a></p>
                                            @empty
                                            @endforelse
                                        </div>
                                        <!-- /.comment-text -->
                                    </div>
                                    <!-- /.box-comment -->

                                </div>
                            @empty
                                Belum Ada Komentar
                                <hr>
                            @endforelse

                            <form action="/activity/comment/{{$activity->id}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group {{$errors->has('komentar')?'has-error':''}}">
                                    <label for="komentar">Komentar</label>
                                    <textarea name="komentar" id="komentar" cols="3" rows="3" class="form-control" placeholder="Berikan komentar..."></textarea>
                                </div>
                                <p onclick="$('#comment-text').toggle('fast');$('#comment-lampiran').toggle('fast');" id="comment-text"><span class="fa fa-plus"></span>Tambah Lampiran</p>
                                <div class="form-group" id="comment-lampiran" style="display: none;">
                                    <label for="lampiran">Lampiran</label>
                                    <input type="file" class="form-control" name="lampiran">
                                </div>
                                <button class="btn btn-primary">Kirim</button>
                            </form>
                            <br>
                        </div>
                    </div>

                    <!-- /.col -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
