@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Archives</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Archive</li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Update Archive</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/archive/".$archive->id."/update/")}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>User</label>
                    <select class="form-control" name="user_id">
                        @foreach(App\User::all() as $user)
                            @if($user['group'] != '')
                                <option value="{{$user['id']}}">{{$user['group']->nama_group}} - {{$user['name']}}</option>
                            @endif
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

                <button class="btn btn-primary" name="create" value="create">Update Archive</button>
                <input type="hidden" name="_method" value="put">
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
