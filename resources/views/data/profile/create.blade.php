@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Profile</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Profile</li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Profile</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="/data/profile/save/" method="post" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label>User</label>
                    <select class="form-control" name="user_id">
                        @foreach(App\User::all() as $user)
                            <option value="{{$user['id']}}">{{$user->group->nama_group}} - {{$user->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Foto Profil</label>
                    <input type="file" class="form-control" placeholder="Enter ..." name="foto_profil">
                </div>

                <div class="form-group">
                    <label>Tempat Lahir</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="tempat_lahir">
                </div>

                <div class="form-group">
                    <label>Tanggal Lahir:</label>
                    <div class="input-group date" >
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker-1" name="tanggal_lahir">
                    </div>
                    <!-- /.input group -->
                </div>

                <div class="form-group">
                    <label>Alamat Tinggal</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..." name="alamat_tinggal"></textarea>
                </div>

                <!-- select -->
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select class="form-control" name="jenis_kelamin">
                        <option value="pria">Pria</option>
                        <option value="wanita">Wanita</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Nomor Telepon</label>
                    <input type="text" class="form-control" placeholder="Enter ..." name="nomor_telepon">
                </div>

                <button class="btn btn-primary" name="create" value="create">Create Profile</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>

    <script type="text/javascript">
        $(function () {
            //Date range picker
//            $('#reservation').daterangepicker();
            //Date picker
            $('#datepicker-1').datepicker({
                autoclose: true
            });

            $('#datepicker-2').datepicker({
                autoclose: true
            });

            //Colorpicker
//            $(".my-colorpicker1").colorpicker();
            //color picker with addon
//            $(".my-colorpicker2").colorpicker();

            //Timepicker
//            $(".timepicker").timepicker({
//                showInputs: false
//            });
        });
    </script>
@endsection
