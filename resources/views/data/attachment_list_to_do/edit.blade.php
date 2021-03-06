@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Attachment List To Do</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Attachment List To Do</li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Update Attachment List To Do {{$attachment_list_to_do->id}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/attachment_list_to_do/".$attachment_list_to_do->id."/update"}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label>List To Do</label>
                    <select class="form-control" name="$list_to_do_id">
                        @foreach(App\ListToDo::all() as $list_to_do)
                            <option value="{{$list_to_do['id']}}">{{$list_to_do->id}} - {{$list_to_do->activity->judul}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Lampiran</label>
                    <input type="file" class="form-control" name="lampiran" placeholder="Enter ..." value="{{$attachment_list_to_do->lampiran}}">
                </div>

                <button class="btn btn-primary" name="create" value="create">Update Attachment List To Do</button>
                <input type="hidden" name="_method" value="put">
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
