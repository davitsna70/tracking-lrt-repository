@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Profile</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Profile {{$profile->id}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Field</th>
                                <th>Deskripsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>ID</td>
                                <td>{{$profile->id}}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>{{$profile->user->group->nama_group}} - {{$profile->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Foto Profil</td>
                                <td>{{basename($profile->foto_profil)}}</td>
                            </tr>
                            <tr>
                                <td>Tempat Lahir</td>
                                <td>{{$profile->tempat_lahir}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Lahir</td>
                                <td>{{$profile->tanggal_lahir}}</td>
                            </tr>
                            <tr>
                                <td>Alamat Tinggal</td>
                                <td>{{$profile->alamat_tinggal}}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>{{$profile->jenis_kelamin}}</td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon</td>
                                <td>{{$profile->nomor_telepon}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Update</td>
                                <td>{{$profile->waktu_update}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="/data/profile/{{$profile->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="/data/profile/{{$profile->id}}/delete" method="post" style="display:inline-block;">
                                        {{csrf_field()}}
                                        <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span> Delete</button>
                                        <input type="hidden" name="_method" value="DELETE">
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.box-body -->
            </div>
        </div>

        <!-- /.box-body -->
    </div>
@endsection
