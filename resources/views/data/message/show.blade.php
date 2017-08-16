@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Message</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Message</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Message {{$message->id}}</h3>
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
                                <td>{{$message->id}}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>{{$message->user->group->nama_group}} - {{$message->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Tujuan</td>
                                <td>{{$message->user_tujuan->group->nama_group}} - {{$message->user_tujuan->name}}</td>
                            </tr>
                            <tr>
                                <td>Isi</td>
                                <td>{{$message->isi}}</td>
                            </tr>
                            <tr>
                                <td>Lampiran</td>
                                <td>{{$message->lampiran}}</td>
                            </tr>
                            <tr>
                                <td>Status Baca</td>
                                <td>{{$message->status_baca}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Pengiriman</td>
                                <td>{{$message->waktu_pengiriman}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="/data/message/{{$message->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="/data/message/{{$message->id}}/delete" method="post" style="display:inline-block;">
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
