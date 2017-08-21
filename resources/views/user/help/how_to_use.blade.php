@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Help<small>How To Use</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">Help</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">How To Use</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>How To Use</h3>
                                    <h4>Register</h4>
                                    <p>
                                        ...
                                    </p>
                                    <h4>Login</h4>
                                    <p>
                                        ...
                                    </p>
                                    <h4>Role</h4>
                                    <p>
                                        ...
                                    </p>
                                    <h4>Membuat Activity</h4>
                                    <p>
                                        ...
                                    </p>
                                    <h4>Melihat Timeline</h4>
                                    <p>
                                        ...
                                    </p>
                                    <h4>Melihat Notifikasi</h4>
                                    <p>
                                        ...
                                    </p>
                                    <h4>Melihat Seluruh Activity</h4>
                                    <p>
                                        ...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
