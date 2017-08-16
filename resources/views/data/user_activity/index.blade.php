@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Data<small>User Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="">Data</li>
            <li class="active">User Activity</li>
        </ol>
    </section>
@endsection


@section('content')


    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table User Activities</h3>
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
                        <a href="/data/user_activity/create">
                            <button class="btn btn-primary btn-sm"><span class="fa fa-plus-square"></span> &nbsp; Add New User-Activity </button>
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
                                    Activity ID
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="CSS grade: activate to sort column ascending" >
                                    Action
                                </th>
                            </tr>
                            </thead>
                            @forelse($user_activities as $user_activity)
                                <tbody>
                                <tr role="row" class="odd">
                                    <td class="">{{ $loop->iteration }}</td>
                                    <td class="">{{ $user_activity['id'] }}</td>
                                    <td class="">{{ $user_activity['user_id']}}</td>
                                    <td class="">{{ $user_activity['activity_id'] }}</td>
                                    <td class="">
                                        <a href="/data/user_activity/{{$user_activity->id}}/show" style="display:inline-block;"><button class="btn btn-sm btn-primary"><span class="fa fa-eye"></span> Show</button></a>
                                        <a href="/data/user_activity/{{$user_activity->id}}/edit" style="display:inline-block;"><button class="btn btn-sm btn-warning"><span class="fa fa-edit"></span> Edit</button></a>
                                        <form action="/data/user_activity/{{$user_activity->id}}/delete" method="post" style="display:inline-block;">
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
                                    <td colspan="6">
                                        No Data in User Activity Table
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
                                    Activity ID
                                </th>
                                <th rowspan="1" colspan="1">
                                    Action
                                </th>
                            </tr>
                            </tfoot>
                        </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing {{$user_activities->currentPage()}} to {{$user_activities->lastPage()}} of {{\App\UserActivity::all()->count()}} entries</div></div><div class="col-sm-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                            {{$user_activities->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

@endsection
