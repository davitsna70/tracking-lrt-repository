@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Help<small>Information</small>
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
                    <div class="box-title">Informations</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Information</h3>
                                    <h4><strong>Jakarta LRT</strong></h4>
                                    <p>Jakarta Light Rail Transit atau disingkat Jakarta LRT adalah sebuah sistem MassTransit dengan kereta api ringan (LRT) yang direncanakan akan dibangun di Jakarta, Indonesia dan menghubungkan Jakarta dengan kota-kota disekitarnya seperti Bekasi dan Bogor. Ada 2 penggagas LRT di Jakarta, Pemprov DKI yang akan membangun LRT dalam kota dan PT Adhi Karya yang akan membangun penghubung Jakarta ke kota sekitarnya.</p>
                                    <br>
                                    <h5><strong>Sejarah</strong></h5>
                                    <p>Gagasan LRT Jakarta mulai muncul ketika Proyek Monorel Jakarta yang sempat diaktifkan kembali pada Oktober 2013 oleh Gubernur DKI saat itu, Joko Widodo tersendat pengerjaannya. Tersendatnya pekerjaan tersebut karena Pemprov DKI dan Gubernur DKI penerus Joko Widodo, Basuki Tjahaja Purnama (Ahok) tidak akan mengabulkan permintaan yang diajukan oleh PT Jakarta Monorail untuk membangun depo di atas Waduk Setiabudi, Jakarta Selatan dan Tanah Abang, Jakarta Pusat. Sebab, hasil kajian Kementerian Pekerjaan Umum dan Perumahan Rakyat (Kementerian PU-Pera) menyatakan bahwa jika depo dibangun di atas Waduk Setiabudi, dikhawatirkan peristiwa jebolnya tanggul Latuharhari terulang kembali.</p>
                                    <p>Ahok, sapaan Basuki, lebih memilih untuk membangun Light Rail Transit (LRT) dibandingkan monorel. Bahkan, Basuki telah mengungkapkan rencana pembangunan ini kepada Presiden Joko Widodo.</p>
                                    <p>Adhi Karya yang semula berniat membangun jalur monorel Cibubur-Cawang-Grogol dan Bekasi-Cawang, mendapat perintah dari Presiden Joko Widodo untuk mengubah konsep monorel menjadi LRT juga. Adapun alasan dibangunnya LRT karena lebih mudah terintegrasi dengan moda lainnya (MRT dan KRL) daripada monorel yang populasinya sedikit karena teknologinya tertutup.</p>
                                    <p>Sumber dari:</p>
                                    <a href="https://id.wikipedia.org/wiki/Jakarta_LRT">Wikipedia : Jakarta LRT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
