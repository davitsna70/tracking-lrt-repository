@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>Notification</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">Notification</li>
        </ol>
    </section>
@endsection


@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table Notifications</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                <div class="row">
                    <div class="col-sm-10">
                        <div id="example1_filter" class="dataTables_filter">
                            <label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <a href="/data/notification/create">
                            <button class="btn btn-primary btn-sm"><span class="fa fa-plus-square"></span> &nbsp; Add New Notification </button>
                        </a>
                    </div>
                </div>
                <div class="row"><div class="col-sm-12 table-responsive"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                                    #
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">
                                    ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending" >
                                    User ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column ascending" >
                                    Deskripsi
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Engine version: activate to sort column ascending" >
                                    Link Notifikasi
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
                                    Status Baca
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
                                    Waktu Pembuatan
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
                                    Action
                                </th>
                            </tr>
                            </thead>
                            @forelse($notifications as $notification)
                                <tbody>
                                <tr role="row" class="odd">
                                    <td class="">{{ $loop->iteration }}</td>
                                    <td class="">{{ $notification['id'] }}</td>
                                    <td class="">{{ $notification['user_id']}}</td>
                                    <td class="">{{ $notification['deskripsi'] }}</td>
                                    <td class="">{{ $notification['link_notifikasi'] }}</td>
                                    <td class="">{{ $notification['status_baca'] }}</td>
                                    <td class="">{{ $notification['waktu_pembuatan'] }}</td>
                                    <td class="">
                                        <a href="/data/notification/{{$notification->id}}/show" style="display:inline-block;"><button class="btn btn-sm btn-primary"><span class="fa fa-eye"></span> Show</button></a>
                                        <a href="/data/notification/{{$notification->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                        <form action="/data/notification/{{$notification->id}}/delete" method="post" style="display:inline-block;">
                                            {{csrf_field()}}
                                            <button class="btn btn-sm btn-danger"><span class="fa fa-close"></span> Delete</button>
                                            <input type="hidden" name="_method" value="DELETE">
                                        </form>
                                    </td>
                                </tr>
                                </tbody>
                            @empty
                                <tbody>
                                <tr>
                                    <td colspan="10">
                                        No Data in Notification Table
                                    </td>
                                </tr>
                                </tbody>
                            @endforelse

                            <tfoot>
                            <tr>
                                <th rowspan="1" colspan="1">
                                    #
                                </th>
                                <th rowspan="1" colspan="1">
                                    ID
                                </th>
                                <th rowspan="1" colspan="1">
                                    User ID
                                </th>
                                <th rowspan="1" colspan="1">
                                    Deskripsi
                                </th>
                                <th rowspan="1" colspan="1">
                                    Link Notifikasi
                                </th>
                                <th rowspan="1" colspan="1">
                                    Status Baca
                                </th>
                                <th rowspan="1" colspan="1">
                                    Waktu Pembuatan
                                </th>
                                <th rowspan="1" colspan="1">
                                    Action
                                </th>
                            </tr>
                            </tfoot>
                        </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing {{$notifications->currentPage()}} to {{$notifications->lastPage()}} of {{\App\Notification::all()->count()}} entries</div></div><div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {{$notifications->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection
