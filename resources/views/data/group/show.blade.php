@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Group</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Group</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box box-default">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Group {{$group->id}}</h3>
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
                                <td>{{$group->id}}</td>
                            </tr>
                            <tr>
                                <td>Nama Group</td>
                                <td>{{$group->nama_group}}</td>
                            </tr>
                            <tr>
                                <td>Alamat Kantor</td>
                                <td>{{$group->alamat_kantor}}</td>
                            </tr>
                            <tr>
                                <td>Nomor Telepon</td>
                                <td>{{$group->nomor_telepon}}</td>
                            </tr>
                            <tr>
                                <td>Fax</td>
                                <td>{{$group->fax}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{$group->email}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Pembuatan</td>
                                <td>{{$group->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Waktu Update</td>
                                <td>{{$group->updated_at}}</td>
                            </tr>
                            <tr>
                                <td>Action</td>
                                <td>
                                    <a href="/data/group/{{$group->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                    <form action="/data/group/{{$group->id}}/delete" method="post" style="display:inline-block;">
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
