@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Comment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Comment</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Comment {{$comment->id}}</h3>
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
                                <td>{{$comment->id}}</td>
                            </tr>
                            <tr>
                                <td>User</td>
                                <td>{{$comment->user->group->nama_group}} - {{$comment->user->name}}</td>
                            </tr>
                            <tr>
                                <td>Activity</td>
                                <td>{{$comment->activity->judul}}</td>
                            </tr>
                            <tr>
                                <td>Isi</td>
                                <td>{{$comment->isi}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Pembuatan</td>
                                <td>{{$comment->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Update</td>
                                <td>{{$comment->updated_at}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="/data/comment/{{$comment->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="/data/comment/{{$comment->id}}/delete" method="post" style="display:inline-block;">
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
