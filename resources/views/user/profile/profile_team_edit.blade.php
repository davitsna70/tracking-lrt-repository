@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Profile<small>Team</small>
        </h1>
        <ol class="breadcrumb">
            <li>Profile</li>
            <li class="">Team</li>
            <li class="active">Edit</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Edit Profile Team</div>
                </div>

                <div class="box-body">
                    <div class="row">
                        @if(count($errors)>0)
                            <div class="callout callout-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-sm-12">
                            <h4><strong>Edit profile</strong></h4>
                            <form action="{{url('/profile/update/team')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label for="nama">Nama</label>
                                    <input type="text" class="form-control" name="nama_group" placeholder="Enter" value="{{$team->nama_group}}">
                                </div>
                                <div class="form-group">
                                    <label for="alamat_kantor">Alamat Kantor</label>
                                    <textarea name="alamat_kantor"  cols="3" class="form-control" placeholder="Enter">{{$team->alamat_kantor}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="nomor_telepon" placeholder="Enter" value="{{$team->nomor_telepon}}">
                                </div>
                                <div class="form-group">
                                    <label for="fax">Fax</label>
                                    <input type="text" class="form-control" name="fax" placeholder="Enter" value="{{$team->fax}}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter" value="{{$team->email}}">
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
@endsection
