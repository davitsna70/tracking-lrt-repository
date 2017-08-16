@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>List To Do</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">List To Do</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">List To Do {{$list_to_do->id}}</h3>
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
                                <td>{{$list_to_do->id}}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>{{$list_to_do->user->group->nama_group}} - {{$list_to_do->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Activity</td>
                                <td>{{$list_to_do->activity->id}} - {{$list_to_do->activity->judul}}</td>
                            </tr>
                            <tr>
                                <td>Judul</td>
                                <td>{{$list_to_do->judul}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>{{$list_to_do->deskripsi}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>{{$list_to_do->status}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Pembuatan</td>
                                <td>{{$list_to_do->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Update</td>
                                <td>{{$list_to_do->updated_at}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="/data/list_to_do/{{$list_to_do->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="/data/list_to_do/{{$list_to_do->id}}/delete" method="post" style="display:inline-block;">
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
