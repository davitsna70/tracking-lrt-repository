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
        <div class="box-header with-border">
            <h3 class="box-title">Update Group {{$group->id}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/group/".$group->id."/update/")}}" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label>Nama Group</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="nama_group" value="{{$group->nama_group}}">
                </div>

                <div class="form-group">
                    <label>Alamat Kantor</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat_kantor">{{$group->alamat_kantor}}</textarea>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="nomor telepon" value="{{$group->nomor_telepon}}">
                </div>

                <div class="form-group">
                    <label>Fax</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="fax" value="{{$group->fax}}">
                </div>

                <div class="form-group">
                    <label>email</label>
                    <input type="email" class="form-control" placeholder="Enter ..." name="email" value="{{$group->email}}">
                </div>

                <button class="btn btn-primary" name="create" value="create">Update Group</button>
                <input type="hidden" name="_method" value="put">
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
