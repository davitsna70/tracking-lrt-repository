@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Notification</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Notification</li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Notification</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/notification/save/")}}" method="post">
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
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="deskripsi"></textarea>
                </div>

                <div class="form-group">
                    <label>Link Notifikasi</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="link_notifikasi">
                </div>

                <!-- select -->
                <div class="form-group">
                    <label>Status Baca</label>
                    <select class="form-control" name="status_baca">
                        <option value="unread">Unread</option>
                        <option value="read">Read</option>
                    </select>
                </div>

                <button class="btn btn-primary" name="create" value="create">Create Notification</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
