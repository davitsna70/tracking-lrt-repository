@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Notifications<small>All</small>
        </h1>
        <ol class="breadcrumb">
            <li>Notifications</li>
            <li class="active">All</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Notifications</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <ul>
                                        @foreach(Auth::user()->notifications as $notification)
                                            <li>
                                                @include ('notification.'.snake_case(basename($notification->type)))
                                            </li>
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
