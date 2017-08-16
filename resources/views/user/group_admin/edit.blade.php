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
        <div class="box-header with-border">
            <h3 class="box-title">Update User {{$user->id}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url('/group_admin/'.$user->id.'/update')}}" method="post">
                {{csrf_field()}}

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="nama" value="{{$user->name}}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter ..." name="email" value="{{$user->email}}">
                </div>

                {{--<div class="form-group">--}}
                    {{--<label>Role</label>--}}
                    {{--<select class="form-control" name="role">--}}
                        {{--<option value="viewer">Viewer</option>--}}
                        {{--<option value="group_admin">Group Administrator</option>--}}
                        {{--<option value="member_group">Member</option>--}}
                        {{--<option value="super_admin">Super Administrator</option>--}}
                    {{--</select>--}}
                {{--</div>--}}

                <div class="form-group">
                    <label>Group</label>
                    <select class="form-control" name="group_id">
                        @foreach(App\Group::all() as $group)
                            <option value="{{$group['id']}}">{{$group->id}} - {{$group->nama_group}}</option>
                        @endforeach
                    </select>
                </div>

                <button class="btn btn-primary" name="create" value="create">Update User</button>
                <input type="hidden" name="_method" value="PUT">
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
