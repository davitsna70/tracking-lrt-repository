@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Tasks<small>All</small>
        </h1>
        <ol class="breadcrumb">
            <li>Tasks</li>
            <li class="active">All</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Tasks</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul><u><strong>Aktifitas yang di buat oleh Anda</strong></u>
                                        @foreach(\App\Activity::where('user_id', '=', Auth::user()->id)->orderBy('id', 'desc')->get() as $activity)
                                            <li><!-- Task item -->
                                                <a href="{{url('/activity/'.$activity->id.'/show')}}">
                                                    <h5>
                                                        <strong>{{$activity->judul}}</strong><br>
                                                        <div style="color: darkslategray; font-size: 10px">{{$activity->tanggal_mulai}} s/d {{$activity->tanggal_berakhir}} oleh {{$activity->user->name}} | {{$activity->hak_akses}}</div>
                                                        <small class="pull-right">{{$activity->getPersentageProgress()}}%</small>
                                                    </h5>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: {{$activity->getPersentageProgress()}}%" role="progressbar" aria-valuenow="{{$activity->getPersentageProgress()}}" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">{{$activity->getPersentageProgress()}}% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                        <u><strong>Aktifitas Yang di buat oleh pihak lain</strong></u>
                                        @foreach(\App\UserActivity::where('user_id', '=' , Auth::user()->id)->orderBy('id', 'desc')->get() as $userActivity)
                                            <li><!-- Task item -->
                                                <a href="{{url('/activity/'.$userActivity->activity->id.'/show')}}">
                                                    <h5>
                                                        <strong>{{$userActivity->activity->judul}}</strong><br>
                                                        <div style="color: darkslategray; font-size: 10px">{{$userActivity->activity->tanggal_mulai}} s/d {{$userActivity->activity->tanggal_berakhir}} oleh {{$userActivity->activity->user->name}} | {{$userActivity->activity->hak_akses}}</div>
                                                        <small class="pull-right">{{$userActivity->activity->getPersentageProgress()}}%</small>
                                                    </h5>
                                                    <div class="progress xs">
                                                        <div class="progress-bar progress-bar-aqua" style="width: {{$userActivity->activity->getPersentageProgress()}}%" role="progressbar" aria-valuenow="{{$userActivity->activity->getPersentageProgress()}}" aria-valuemin="0" aria-valuemax="100">
                                                            <span class="sr-only">{{$userActivity->activity->getPersentageProgress()}}% Complete</span>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
