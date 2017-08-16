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
            <h3 class="box-title">Create New User</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            @if(count($errors)>0)
                <div class="callout callout-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" action="{{url('/member_group/save/')}}" method="post">
                {{csrf_field()}}

                <div class="form-group {{$errors->has('nama')?'has-error':''}}">
                    <label>Nama</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="nama" value="{{Request::old('nama')}}">
                </div>

                <div class="form-group {{$errors->has('email')?'has-error':''}}">
                    <label>Email</label>
                    <input type="email" class="form-control" placeholder="Enter ..." name="email" value="{{Request::old('email')}}">
                </div>

                <div class="form-group {{$errors->has('password')?'has-error':''}}">
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="Enter ..." name="password" value="{{Request::old('password')}}">
                </div>

                <div class="form-group {{$errors->has('confirm_password')?'has-error':''}}">
                    <label>Konfirmasi Password</label>
                    <input type="password" class="form-control" placeholder="Enter ..." name="confirm_password" value="{{Request::old('confirm_password')}}">
                </div>

                @if(Auth::user()->role=='super_admin')
                    <div class="form-group">
                        <label>Group</label>
                        <select class="form-control" name="group_id">
                            @foreach(App\Group::all() as $group)
                                <option value="{{$group['id']}}">{{$group->id}} - {{$group->nama_group}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <button class="btn btn-primary" name="create" value="create">Create User</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
