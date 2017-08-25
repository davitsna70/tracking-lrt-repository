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
        <div class="box-header with-border">
            <h3 class="box-title">Create New Message</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/message/save/")}}" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label>User</label>
                    <select class="form-control" name="user_id">
                        @foreach(App\User::all() as $user)
                            <option value="{{$user['id']}}">{{$user->group->nama_group}} - {{$user->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Tujuan</label>
                    <select class="form-control" name="tujuan">
                        @foreach(App\User::all() as $user)
                            <option value="{{$user['id']}}">{{$user->group->nama_group}} - {{$user->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Isi</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="isi"></textarea>
                </div>

                <div class="form-group">
                    <label>Lampiran</label>
                    <input type="file" class="form-control" placeholder="Enter ..." name="lampiran">
                </div>

                <!-- select -->
                <div class="form-group">
                    <label>Status Baca</label>
                    <select class="form-control" name="status_baca">
                        <option value="unread">Unread</option>
                        <option value="read">Read</option>
                    </select>
                </div>

                <button class="btn btn-primary" name="create" value="create">Create Message</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
