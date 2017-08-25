@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Attachment Comment</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Attachment Comment</li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Attachment Comment</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/attachment_comment/save/")}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label>Comment</label>
                    <select class="form-control" name="comment_id">
                        @foreach(App\Comment::all() as $comment)
                            <option value="{{$comment['id']}}">{{$comment->activity->judul}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Lampiran</label>
                    <input type="file" class="form-control" name="lampiran" placeholder="Enter ...">
                </div>

                <button class="btn btn-primary" name="create" value="create">Create Attachment Comment</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
