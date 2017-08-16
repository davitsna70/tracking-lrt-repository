@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Log Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Log Activity</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Log Activity {{$log_activity->id}}</h3>
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
                                <td>{{$log_activity->id}}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>{{$log_activity->user->group->nama_group}} - {{$log_activity->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>{{$log_activity->deskripsi}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Kegiatan</td>
                                <td>{{$log_activity->waktu_kegiatan}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="/data/log_activity/{{$log_activity->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="/data/log_activity/{{$log_activity->id}}/delete" method="post" style="display:inline-block;">
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
