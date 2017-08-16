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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Activity {{$activity->id}}</h3>
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
                                <td>{{$activity->id}}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>{{$activity->user->group->nama_group}} - {{$activity->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Judul</td>
                                <td>{{$activity->judul}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>{{$activity->deskripsi}}</td>
                            </tr>
                            <tr>
                                <td>Hak Akses</td>
                                <td>{{$activity->hak_akses}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{$activity->status}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Mulai</td>
                                <td>{{$activity->tanggal_mulai}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Berakhir</td>
                                <td>{{$activity->tanggal_berakhir}}</td>
                            </tr>
                            <tr>
                                <td>ID</td>
                                <td>{{$activity->id}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Selesai</td>
                                <td>{{$activity->waktu_selesai}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Pembuatan</td>
                                <td>{{$activity->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Update</td>
                                <td>{{$activity->updated_at}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="/data/activity/{{$activity->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="/data/activity/{{$activity->id}}/delete" method="post" style="display:inline-block;">
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
