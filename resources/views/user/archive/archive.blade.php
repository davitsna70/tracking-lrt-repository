@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Archives<small>Archive</small>
        </h1>
        <ol class="breadcrumb">
            <li>Archives</li>
            <li class="active">Archive</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Archive</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tab-pane" id="tab_5">
                                        @forelse($archives as $archive)
                                                <h3><b>Activities : {{$archive->activity->judul}}</b></h3>
                                                @if(count(\App\Archive::where('user_id', '=', Auth::user()->id)->where('activity_id', '=', $archive->activity->id)->get())>0)
                                                    <a href="{{url('/archive/delete/'.$archive->activity->id)}}" class="btn btn-danger btn-sm pull-right">Delete from Archive</a>
                                                @else
                                                    <a href="{{url('/archive/add/'.$archive->activity->id)}}" class="btn btn-primary btn-sm pull-right">Add to Archive</a>
                                                @endif
                                                <div class="post row">
                                                    <div class="col-sm-5">
                                                        Created By
                                                        <div class="user-block">
                                                            <img title="{{\App\Activity::find($archive->activity->id)->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".
                                                basename(\App\Activity::find($archive->activity->id)->user->profile->foto_profil))}}" alt="user image">
                                                            <span class="username">
                                              <a href="#">{{\App\Activity::find($archive->activity->id)->user->name}}</a>
                                                                {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                            </span>
                                                            <span class="description">
                                                Shared publicly - {{$archive->activity->created_at}}<br/>
                                                Due Time : from {{$archive->activity->tanggal_mulai}} until {{$archive->activity->tanggal_berakhir}}
                                            </span>
                                                            @if($archive->activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                                <a href="{{url('/activity/'.$archive->activity->id.'/edit')}}"><button type="button" class="btn btn-warning btn-sm" data-target="#detailActivity" >Edit</button></a>
                                                            @endif
                                                            <a href="{{url('/activity/'.$archive->activity->id.'/show')}}"><button type="button" class="btn btn-primary btn-sm" data-target="#detailActivity" >Detail</button></a>

                                                        </div>
                                                    </div>
                                                    {{--<p>--}}
                                                    {{--{{$user_activity->activity->deskripsi}}--}}
                                                    {{--</p>--}}
                                                    <div class="col-sm-7">
                                                        <p>Member : </p>
                                                        <div class="user-block">
                                                            @foreach(\App\UserActivity::all()->where('activity_id', '=', $archive->activity->id) as $member)
                                                                <img title="{{$member->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".basename($member->user->profile->foto_profil))}}"
                                                                     alt="image not found">
                                                            @endforeach
                                                        </div></div>
                                                    <!-- /.user-block -->
                                                    {{--<a href="#" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>--}}
                                                </div>
                                        @empty
                                            Tidak ada activity yang tersedia...
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
