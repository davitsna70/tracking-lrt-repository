@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            {{ trans('backpack::base.dashboard') }}<small>{{ trans('backpack::base.first_page_you_see') }}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">{{ trans('backpack::base.dashboard') }}</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Notification {{$notification->id}}</h3>
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
                                <td>{{$notification->id}}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>{{$notification->user->group->nama_group}} - {{$notification->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>{{$notification->deskripsi}}</td>
                            </tr>
                            <tr>
                                <td>Link Notifikasi</td>
                                <td>{{$notification->link_notifikasi}}</td>
                            </tr>
                            <tr>
                                <td>Status Baca</td>
                                <td>{{$notification->status_baca}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Pembuatan</td>
                                <td>{{$notification->waktu_pembuatan}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="/data/notification/{{$notification->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="/data/notification/{{$notification->id}}/delete" method="post" style="display:inline-block;">
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
