@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>User</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">User</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">User {{$user->id}}</h3>
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
                                <td>{{$user->id}}</td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>{{$user->role}}</td>
                            </tr>
                            <tr>
                                <td>Group</td>
                                <td>{{$user->group->nama_group}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Pembuatan</td>
                                <td>{{$user->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Update</td>
                                <td>{{$user->updated_at}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="{{url('/viewer/'.$user->id.'/edit')}}" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="{{url('/viewer/'.$user->id.'/delete')}}" method="post" style="display:inline-block;">
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
