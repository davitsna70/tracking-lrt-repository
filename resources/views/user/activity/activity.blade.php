@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Activities<small>Board</small>
        </h1>
        <ol class="breadcrumb">
            <li>TrackingLRT</li>
            <li class="active">Activity</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Activities Boards</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-9">
                        <div id="example1_filter" class="dataTables_filter">
                            <label>Activity in access right :
                                <form action="{{url("/activity/access_right")}}" method="get" style="display: inline-block">
                                    {{--{{csrf_field()}}--}}
                                    <div class="form-group">
                                        <select class="form-control" name="hak_akses">
                                            @if(Auth::user()->role=='super_admin')
                                                <option value="public">Public</option>
                                                <option value="team">Team</option>
                                                <option value="private">Private</option>
                                                @elseif(Auth::user()->role=='group_admin')
                                                <option value="public">Public</option>
                                                <option value="team">Team</option>
                                                @else
                                                <option value="public">Public</option>
                                                <option value="team">Team</option>
                                            @endif

                                        </select>
                                        <button class="btn btn-default"><span class="fa fa-search"></span> Look</button>
                                    </div>
                                </form>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        {{--<a href="/data/activity/create">--}}
                        <a href="{{url("/activity/create")}}"><button type="button" class="btn btn-primary "><span class="fa fa-plus-square"></span> Create Activity </button></a>
                        {{--</a>--}}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="pull-left header"><i class="fa fa-th"></i> Board</li>
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Plan</a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">On Going (Process)</a></li>
                            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Late</a></li>
                            {{--<li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Pending</a></li>--}}
                            <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Done</a></li>
                            {{--<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>--}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_1">
                                @forelse($activities as $activity)
                                    @if($activity->status === "plan")
                                        <h3><b>Activity : {{$activity->judul}}</b></h3>
                                    @if(count(\App\Archive::where('user_id', '=', Auth::user()->id)->where('activity_id', '=', $activity->id)->get())>0)
                                            <a href="{{url('/archive/delete/'.$activity->id)}}" class="btn btn-danger btn-sm pull-right">Delete from Archive</a>
                                        @else
                                            <a href="{{url('/archive/add/'.$activity->id)}}" class="btn btn-primary btn-sm pull-right">Add to Archive</a>
                                        @endif
                                        <div class="post row">
                                            <div class="col-sm-5">
                                                Created By
                                                <div class="user-block">
                                                    <img title="{{\App\Activity::find($activity->id)->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".
                                                basename(\App\Activity::find($activity->id)->user->profile->foto_profil))}}" alt="user image">
                                                    <span class="username">
                                              <a href="#">{{\App\Activity::find($activity->id)->user->name}}</a>
                                                        {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                            </span>
                                                    <span class="description">
                                                Shared publicly - {{$activity->created_at}}<br/>
                                                Due Time : from {{$activity->tanggal_mulai}} until {{$activity->tanggal_berakhir}}
                                            </span>
                                                    @if($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                        <a href="{{url('/activity/'.$activity->id.'/edit')}}"><button type="button" class="btn btn-warning btn-sm" data-target="#detailActivity" >Edit</button></a>
                                                    @endif
                                                    <a href="{{url('/activity/'.$activity->id.'/show')}}"><button type="button" class="btn btn-primary btn-sm" data-target="#detailActivity" >Detail</button></a>
                                                </div>
                                            </div>
                                            {{--<p>--}}
                                            {{--{{$user_activity->activity->deskripsi}}--}}
                                            {{--</p>--}}
                                            <div class="col-sm-7">
                                                <p>Member : </p>
                                                <div class="user-block">
                                                    @foreach(\App\UserActivity::all()->where('activity_id', '=', $activity->id) as $member)
                                                        <img title="{{$member->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".basename($member->user->profile->foto_profil))}}"
                                                             alt="image not found">
                                                    @endforeach
                                                </div>
                                                <!-- /.user-block -->
                                                {{--<a href="#" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>--}}
                                                {{--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detailActivity" data-whatever="@getbootstrap"><span class="fa fa-eye"></span> Detail</button>--}}
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    Tidak ada activity yang tersedia...
                                @endforelse
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_2">
                                @forelse($activities as $activity)
                                    @if($activity->status === "ongoing")
                                        <h3><b>Activity : {{$activity->judul}}</b></h3>
                                        @if(count(\App\Archive::where('user_id', '=', Auth::user()->id)->where('activity_id', '=', $activity->id)->get())>0)
                                            <a href="{{url('/archive/delete/'.$activity->id)}}" class="btn btn-danger btn-sm pull-right">Delete from Archive</a>
                                        @else
                                            <a href="{{url('/archive/add/'.$activity->id)}}" class="btn btn-primary btn-sm pull-right">Add to Archive</a>
                                        @endif
                                        <div class="post row">
                                            <div class="col-sm-5">
                                                Created By
                                                <div class="user-block">
                                                    <img title="{{\App\Activity::find($activity->id)->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".
                                                basename(\App\Activity::find($activity->id)->user->profile->foto_profil))}}" alt="user image">
                                                    <span class="username">
                                              <a href="#">{{\App\Activity::find($activity->id)->user->name}}</a>
                                                        {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                            </span>
                                                    <span class="description">
                                                Shared publicly - {{$activity->created_at}}<br/>
                                                Due Time : from {{$activity->tanggal_mulai}} until {{$activity->tanggal_berakhir}}
                                            </span>
                                                    @if($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                        <a href="{{url('/activity/'.$activity->id.'/edit')}}"><button type="button" class="btn btn-warning btn-sm" data-target="#detailActivity" >Edit</button></a>
                                                    @endif
                                                    <a href="{{url('/activity/'.$activity->id.'/show')}}"><button type="button" class="btn btn-primary btn-sm" data-target="#detailActivity" >Detail</button></a>
                                                </div>
                                            </div>
                                            {{--<p>--}}
                                            {{--{{$user_activity->activity->deskripsi}}--}}
                                            {{--</p>--}}
                                            <div class="col-sm-7">
                                                <p>Member : </p>
                                                <div class="user-block">
                                                    @foreach(\App\UserActivity::all()->where('activity_id', '=', $activity->id) as $member)
                                                        <img  title="{{$member->user->name}}"class="img-circle img-bordered-sm" src="{{url("/profile/photo/".basename($member->user->profile->foto_profil))}}"
                                                              alt="image not found">
                                                    @endforeach
                                                </div>
                                                <!-- /.user-block -->
                                                {{--<a href="#" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>--}}
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    Tidak ada activity yang tersedia...
                                @endforelse
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_3">
                                @forelse($activities as $activity)
                                    @if($activity->status === "late")
                                        <h3><b>Activity : {{$activity->judul}}</b></h3>
                                        @if(count(\App\Archive::where('user_id', '=', Auth::user()->id)->where('activity_id', '=', $activity->id)->get())>0)
                                            <a href="{{url('/archive/delete/'.$activity->id)}}" class="btn btn-danger btn-sm pull-right">Delete from Archive</a>
                                        @else
                                            <a href="{{url('/archive/add/'.$activity->id)}}" class="btn btn-primary btn-sm pull-right">Add to Archive</a>
                                        @endif
                                        <div class="post row">
                                            <div class="col-sm-5">
                                                Created By
                                                <div class="user-block">
                                                    <img title="{{\App\Activity::find($activity->id)->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".
                                                basename(\App\Activity::find($activity->id)->user->profile->foto_profil))}}" alt="user image">
                                                    <span class="username">
                                              <a href="#">{{\App\Activity::find($activity->id)->user->name}}</a>
                                                        {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                            </span>
                                                    <span class="description">
                                                Shared publicly - {{$activity->created_at}}<br/>
                                                Due Time : from {{$activity->tanggal_mulai}} until {{$activity->tanggal_berakhir}}
                                            </span>
                                                    @if($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                        <a href="{{url('/activity/'.$activity->id.'/edit')}}"><button type="button" class="btn btn-warning btn-sm" data-target="#detailActivity" >Edit</button></a>
                                                    @endif
                                                    <a href="{{url('/activity/'.$activity->id.'/show')}}"><button type="button" class="btn btn-primary btn-sm" data-target="#detailActivity" >Detail</button></a>

                                                </div>
                                            </div>
                                            {{--<p>--}}
                                            {{--{{$user_activity->activity->deskripsi}}--}}
                                            {{--</p>--}}
                                            <div class="col-sm-7">
                                                <p>Member : </p>
                                                <div class="user-block">
                                                    @foreach(\App\UserActivity::all()->where('activity_id', '=', $activity->id) as $member)
                                                        <img title="{{$member->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".basename($member->user->profile->foto_profil))}}"
                                                             alt="image not found">
                                                    @endforeach
                                                </div>
                                                <!-- /.user-block -->
                                                {{--<a href="#" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>--}}
                                            </div>
                                        </div>
                                    @endif
                                @empty
                                    Tidak ada activity yang tersedia...
                                @endforelse
                            </div>
                            <!-- /.tab-pane -->
                            {{--<div class="tab-pane" id="tab_4">--}}
                                {{--@forelse($activities as $activity)--}}
                                    {{--@if($activity->status === "pending")--}}
                                        {{--<h3><b>Activities : {{$activity->judul}}</b></h3>--}}
                                        {{--@if(count(\App\Archive::where('user_id', '=', Auth::user()->id)->where('activity_id', '=', $activity->id)->get())>0)--}}
                                            {{--<a href="/archive/delete/{{$activity->id}}" class="btn btn-danger btn-sm pull-right">Delete from Archive</a>--}}
                                        {{--@else--}}
                                            {{--<a href="/archive/add/{{$activity->id}}" class="btn btn-primary btn-sm pull-right">Add to Archive</a>--}}
                                        {{--@endif--}}
                                        {{--<div class="post row">--}}
                                            {{--<div class="col-sm-5">--}}
                                                {{--Created By--}}
                                                {{--<div class="user-block">--}}
                                                    {{--<img title="{{\App\Activity::find($activity->id)->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".--}}
                                                {{--basename(\App\Activity::find($activity->id)->user->profile->foto_profil))}}" alt="user image">--}}
                                                    {{--<span class="username">--}}
                                              {{--<a href="#">{{\App\Activity::find($activity->id)->user->name}}</a>--}}
                                                        {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                            {{--</span>--}}
                                                    {{--<span class="description">--}}
                                                {{--Shared publicly - {{$activity->created_at}}<br/>--}}
                                                {{--Due Time : from {{$activity->tanggal_mulai}} until {{$activity->tanggal_berakhir}}--}}
                                            {{--</span>--}}
                                                    {{--@if($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)--}}
                                                        {{--<a href="{{url('/activity/'.$activity->id.'/edit')}}"><button type="button" class="btn btn-warning btn-sm" data-target="#detailActivity" >Edit</button></a>--}}
                                                    {{--@endif--}}
                                                    {{--<a href="{{url('/activity/'.$activity->id.'/show')}}"><button type="button" class="btn btn-primary btn-sm" data-target="#detailActivity" >Detail</button></a>--}}

                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--<p>--}}
                                            {{--{{$user_activity->activity->deskripsi}}--}}
                                            {{--</p>--}}
                                            {{--<div class="col-sm-7">--}}
                                                {{--<p>Member : </p>--}}
                                                {{--<div class="user-block">--}}
                                                    {{--@foreach(\App\UserActivity::all()->where('activity_id', '=', $activity->id) as $member)--}}
                                                        {{--<img title="{{$member->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".basename($member->user->profile->foto_profil))}}"--}}
                                                             {{--alt="image not found">--}}
                                                    {{--@endforeach--}}
                                                {{--</div>--}}
                                                {{--<!-- /.user-block -->--}}
                                                {{--<a href="#" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>--}}
                                            {{--</div></div>--}}
                                    {{--@endif--}}
                                {{--@empty--}}
                                    {{--Tidak ada activity yang tersedia...--}}
                                {{--@endforelse--}}
                            {{--</div>--}}
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_5">
                                @forelse($activities as $activity)
                                    @if($activity->status === "done")
                                        <h3><b>Activity : {{$activity->judul}}</b></h3>
                                        @if(count(\App\Archive::where('user_id', '=', Auth::user()->id)->where('activity_id', '=', $activity->id)->get())>0)
                                            <a href="{{url('/archive/delete/'.$activity->id)}}" class="btn btn-danger btn-sm pull-right">Delete from Archive</a>
                                        @else
                                            <a href="{{url('/archive/add/'.$activity->id)}}" class="btn btn-primary btn-sm pull-right">Add to Archive</a>
                                        @endif
                                        <div class="post row">
                                            <div class="col-sm-5">
                                                Created By
                                                <div class="user-block">
                                                    <img title="{{\App\Activity::find($activity->id)->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".
                                                basename(\App\Activity::find($activity->id)->user->profile->foto_profil))}}" alt="user image">
                                                    <span class="username">
                                              <a href="#">{{\App\Activity::find($activity->id)->user->name}}</a>
                                                        {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                            </span>
                                                    <span class="description">
                                                Shared publicly - {{$activity->created_at}}<br/>
                                                Due Time : from {{$activity->tanggal_mulai}} until {{$activity->tanggal_berakhir}}
                                            </span>
                                                    @if($activity->user_id == \Illuminate\Support\Facades\Auth::user()->id)
                                                        <a href="{{url('/activity/'.$activity->id.'/edit')}}"><button type="button" class="btn btn-warning btn-sm" data-target="#detailActivity" >Edit</button></a>
                                                    @endif
                                                    <a href="{{url('/activity/'.$activity->id.'/show')}}"><button type="button" class="btn btn-primary btn-sm" data-target="#detailActivity" >Detail</button></a>

                                                </div>
                                            </div>
                                            {{--<p>--}}
                                            {{--{{$user_activity->activity->deskripsi}}--}}
                                            {{--</p>--}}
                                            <div class="col-sm-7">
                                                <p>Member : </p>
                                                <div class="user-block">
                                                    @foreach(\App\UserActivity::all()->where('activity_id', '=', $activity->id) as $member)
                                                        <img title="{{$member->user->name}}" class="img-circle img-bordered-sm" src="{{url("/profile/photo/".basename($member->user->profile->foto_profil))}}"
                                                             alt="image not found">
                                                    @endforeach
                                                </div></div>
                                            <!-- /.user-block -->
                                            {{--<a href="#" class="btn btn-primary"><span class="fa fa-eye"></span> Detail</a>--}}
                                        </div>
                                    @endif
                                @empty
                                    Tidak ada activity yang tersedia...
                                @endforelse
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- nav-tabs-custom -->
                </div>
                <!-- /.col -->
                <!-- /.col -->
            </div>
        </div>
    </div>

@endsection
