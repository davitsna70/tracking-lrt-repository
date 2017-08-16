@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Profile<small>Team</small>
        </h1>
        <ol class="breadcrumb">
            <li>Profile</li>
            <li class="active">Team</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Profile Team</div>
                    @if(Auth::user()->group->id == $team->id && Auth::user()->role == 'group_admin')
                        <a href="/profile/update/team" class="btn btn-primary pull-right"> Change Profile</a>
                    @endif
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4><strong>Profile team/group {{$team->nama_group}}</strong></h4>
                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tr>
                                            <td>Nama Group</td>
                                            <td>{{$team->nama_group}}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat Kantor</td>
                                            <td>{{$team->alamat_kantor}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nomor Telepon</td>
                                            <td>{{$team->nomor_telepon}}</td>
                                        </tr>
                                        <tr>
                                            <td>Fax</td>
                                            <td>{{$team->fax}}</td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>{{$team->email}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tanggal Bergabung</td>
                                            <td>{{$team->created_at}}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <h5><strong>List Anggota</strong></h5>
                        <div class="row">
                            <div class="col-xs-12 table-responsive">
                                <table class="table table-bordered table-striped">
                                    @foreach($team->users as $user)
                                        <tr>
                                            <td><a href="{{url('/profile/person/'.$user->id)}}">{{$user->name}}</a></td>
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
