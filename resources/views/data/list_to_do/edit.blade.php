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
        <div class="box-header with-border">
            <h3 class="box-title">Update List To Do {{$list_to_do->id}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/list_to_do/". $list_to_do->id."/update/")}}" method="post">
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
                    <label>Activity</label>
                    <select class="form-control" name="activity_id">
                        @foreach(App\Activity::all() as $activity)
                            <option value="{{$activity['id']}}">{{$activity->judul}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="judul" value="{{$list_to_do->judul}}">
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="deskripsi">{{$list_to_do->deskripsi}}</textarea>
                </div>

                <div class="form-group">
                    <label>Select</label>
                    <select class="form-control" name="status">
                        <option value="undone">Undone</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <button class="btn btn-primary" name="create" value="create">Update List To Do</button>
                <input type="hidden" name="_method" value="put">
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
