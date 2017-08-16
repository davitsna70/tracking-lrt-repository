@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Log Activities<small>Log Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li>Log Activities</li>
            <li class="active">Log Activity</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Log Activity</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul>
                                    @foreach($logActivities as $logActivity)
                                        <li>{{$logActivity->waktu_kegiatan}} - {{$logActivity->user->name}} {{$logActivity->deskripsi}}</li>
                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
