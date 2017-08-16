@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Profile<small>Show</small>
        </h1>
        <ol class="breadcrumb">
            <li>Profile</li>
            <li class="active">Show</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Profile Personal</div>
                    @if(Auth::user()->id == $user->id)
                        <a href="/profile/update/person" class="btn btn-primary pull-right"> Change Profile</a>
                    @endif
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4 class="center-margin"><strong>Profil {{$user->name}}</strong></h4>
                        </div>
                        <div class="col-sm-3">
                            <img src="{{url('/profile/photo/'.basename($user->profile->foto_profil))}}" alt="Image User" style="border-radius: 8px;" width="200em" height="150em">
                        </div>
                        <div class="col-sm-9">
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>Nama</td>
                                            <td>{{$user->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$user->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Team/Grup</td>
                                            <td>{{$user->group->nama_group}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Bergabung</td>
                                            <td>{{$user->created_at}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tempat Lahir</td>
                                            <td>{{$user->profile->tempat_lahir}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Lahir</td>
                                            <td>{{$user->profile->tanggal_lahir}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>{{$user->profile->alamat_tinggal}}</td>
                                        </tr>
                                        <tr>
                                            <td>Jenis Kelamin</td>
                                            <td>{{$user->profile->jenis_kelamin}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Telepon</td>
                                            <td>{{$user->profile->nomor_telepon}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h5><strong>List Kegiatan</strong></h5>
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-bordered table-striped">
                                        @foreach(\App\Activity::where('user_id', '=', $user->id)->get() as $activity)
                                            <tr>
                                                <td><a href="{{url('/activity/'.$activity->id).'/show'}}">{{$activity->judul}}</a></td>
                                            </tr>
                                        @endforeach
                                        @foreach(\App\UserActivity::where('user_id', '=', $user->id)->get() as $userActivity)
                                            <tr>
                                                <td><a href="{{url('/activity/'.$userActivity->activity->id).'/show'}}">{{$userActivity->activity->judul}}</a></td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
