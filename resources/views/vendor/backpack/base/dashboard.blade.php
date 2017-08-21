@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Dashboard<small>Page</small>
        </h1>
        <ol class="breadcrumb">
            <li>Dashboard</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Dashboard</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Tracking LRT</h3>
                                    <p>
                                        Sistem ini di buat untuk melakukan tracking terhadap pembangunan LRT yang membutuhkan banyak tenaga dan dikerjakan oleh beberapa instansi. Diharapkan sistem ini dapat membantu dalam sinkronisasi pembangunan LRT.
                                    </p>
                                    {{--<p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
