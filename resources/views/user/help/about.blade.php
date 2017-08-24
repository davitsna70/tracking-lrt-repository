@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Help<small>About</small>
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
                    <div class="box-title">About</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>About</h3>
                                    <p>
                                        Sistem ini di bangun untuk keperluan pembangunan LRT. Mengatur koordinasi antar bagian bidang yang terkait untuk mencapai suatu keselarasan pekerjaan dengan timeline yang di aturkan sebelumnya, agar setiap pekerjaan yang terkait daat di lihat oleh public dan dapat di track secara baik.
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
