@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Activity</li>
        </ol>
    </section>
@endsection


@section('content')

    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Create New Activity</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="{{url("/data/activity/save/")}}" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label>User</label>
                    <select class="form-control" name="user_id">
                        @foreach(App\User::all() as $user)
                            @if($user['group'] != '')
                                <option value="{{$user['id']}}">{{$user['group']->nama_group}} - {{$user['name']}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <!-- text input -->
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" class="form-control" name="judul" placeholder="Enter ...">
                </div>

                <!-- textarea -->
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="3" name="deskripsi" placeholder="Enter ..."></textarea>
                </div>

                <!-- select -->
                <div class="form-group">
                    <label>Hak Akses</label>
                    <select class="form-control" name="hak_akses">
                        <option value="private">Private</option>
                        <option value="team">Team</option>
                        <option value="public">Public</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Range Waktu:</label><br/>
                    <label>Tanggal Mulai:</label>
                    <div class="input-group date" >
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker-1" name="tanggal_mulai">
                    </div>

                    <label>Tanggal Berakhir:</label>
                    <div class="input-group date" >
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker-2" name="tanggal_berakhir">
                    </div>
                    <!-- /.input group -->
                </div>

                <!--Waktu Selesai-->
                <label>Waktu Selesai:</label>
                <div class="input-group date" >
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right" id="datepicker-3" name="waktu_selesai" >
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="plan">Plan</option>
                        <option value="ongoing">On Going</option>
                        <option value="late">Late</option>
                        <option value="pending">Pending</option>
                        <option value="done">Done</option>
                    </select>
                </div>

                <button class="btn btn-primary" name="create" value="create">Create Activity</button>
            </form>
        </div>
        <!-- /.box-body -->
    </div>

    <script type="text/javascript">
        $(function () {
            //Date range picker
            $('#reservation').daterangepicker();
            //Date picker
            $('#datepicker-1').datepicker({
                autoclose: true
            }).val();

            $('#datepicker-2').datepicker({
                autoclose: true
            });

            $('#datepicker-3').datepicker({
                autoclose: true
            });

            //Colorpicker
            $(".my-colorpicker1").colorpicker();
            //color picker with addon
            $(".my-colorpicker2").colorpicker();

            //Timepicker
            $(".timepicker").timepicker({
                showInputs: false
            });
        });
    </script>
@endsection
