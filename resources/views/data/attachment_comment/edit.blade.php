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
            <h3 class="box-title">Update New Attachment Comment {{$attachment_comment->id}}</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/attachment_comment/".$attachment_comment."/update")}}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label>Comment</label>
                    <select class="form-control" name="comment_id">
                        @foreach(App\Comment::all() as $comment)
                            <option value="{{$comment['id']}}">{{$comment->id}} - {{$comment->activity->judul}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Lampiran</label>
                    <input type="file" class="form-control" name="lampiran" placeholder="Enter ..." value="{{$attachment_comment->lampiran}}">
                </div>

                <button class="btn btn-primary" name="create" value="create">Update Attachment Comment</button>
                <input type="hidden" name="_method" value="put">
            </form>
        </div>
        <!-- /.box-body -->
    </div>


@endsection
