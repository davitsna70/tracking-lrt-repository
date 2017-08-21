@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Help<small>Contact</small>
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
                    <div class="box-title">Contact</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Contact</h3>
                                    <strong>Alamat</strong>

                                    <p>
                                        Kementrian Koordinator Bidang Kemaritiman <br>
                                        Gedung BPPT 1 Lantai 4 <br>
                                        Jalan M.H Thamrin No.8 Menteng <br>
                                        RT.2/RW.1, Kebon Sirih <br>
                                        Menteng, Kota Jakarta Pusat <br>
                                        Daerah Khusus Ibukota Jakarta
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
