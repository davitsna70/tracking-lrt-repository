@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Profile<small>Person</small>
        </h1>
        <ol class="breadcrumb">
            <li>Profile</li>
            <li class="">Person</li>
            <li class="active">Edit</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Edit Profile Person</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @if(count($errors)>0)
                                <div class="callout callout-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h4><strong>Edit profile</strong></h4>
                            <form action="{{url('/profile/update/person')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama" placeholder="Enter" value="{{$user->name}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter" value="{{$user->email}}">
                                </div>
                                <div class="form-group">
                                    <label for="foto_profil">Foto Profil</label>
                                    <input type="file" class="form-control" name="foto_profil" placeholder="Enter" value="{{$user->profile->foto_profil}}">
                                </div>
                                <div class="form-group">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input type="text" class="form-control" name="tempat_lahir" placeholder="Enter" value="{{$user->profile->tempat_lahir}}">
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="datepicker" name="tanggal_lahir" placeholder="Enter" value="{{date('m/d/Y',strtotime($user->profile->tanggal_lahir))}}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat_tinggal">Alamat Tinggal</label>
                                    <textarea name="alamat_tinggal" id="" cols="3" class="form-control" placeholder="Enter" >{{$user->profile->alamat_tinggal}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select class="form-control" name="jenis_kelamin">
                                        <option value="pria" {{($user->profile->jenis_kelamin == 'pria')?'selected':''}}>Pria</option>
                                        <option value="wanita" {{($user->profile->jenis_kelamin == 'wanita')?'selected':''}}>Wanita</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="nomor_telepon" placeholder="Enter" value="{{$user->profile->nomor_telepon}}">
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                                <input type="hidden" name="_method" value="put">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" id="script-for-page">

        $(function () {

            $('#datepicker').datepicker({
                autoclose: true
            });
        });
    </script>
@endsection
