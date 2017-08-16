@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Profile<small>Reset Password</small>
        </h1>
        <ol class="breadcrumb">
            <li>Profile</li>
            <li class="active">Reset Password</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Reset Password</div>
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
                        </div>
                        <div class="col-sm-12">
                            @if(count($err)>0)
                                <div class="callout callout-danger">
                                    <ul>
                                        <li>{{$err}}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            @if(count($succ)>0)
                                <div class="callout callout-success">
                                    <ul>
                                        <li>{{$succ}}</li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                        <div class="col-sm-12">
                            {{--<h5><strong>Reset Password</strong></h5>--}}
                            <form action="{{url('profile/reset_password')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group {{$errors->has('password_lama')?'has-error':''}}">
                                    <label for="password_lama"> Password Lama</label>
                                    <input type="password" class="form-control" name="password_lama" value="{{Request::old('password_lama')}}">
                                </div>
                                <div class="form-group {{$errors->has('password_baru')?'has-error':''}}">
                                    <label for="password_baru"> Password Baru</label>
                                    <input type="password" class="form-control" name="password_baru" value="{{Request::old('password_baru')}}">
                                </div>
                                <div class="form-group {{$errors->has('konfirmasi_password')?'has-error':''}}">
                                    <label for="konfirmasi_passeord"> Konfirmasi Password</label>
                                    <input type="password" name="konfirmasi_password" class="form-control" value="{{Request::old('konfirmasi_password')}}">
                                </div>
                                <button type="submit" class="btn btn-primary"> Reset Password</button>
                                <input type="hidden" name="_method" value="PUT">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
