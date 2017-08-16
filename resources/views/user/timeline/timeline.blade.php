@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Timeline<small>Activity</small>
        </h1>
        <ol class="breadcrumb">
            <li>Timeline</li>
            <li class="active">Activity</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Timeline</div>
                    <button class="pull-right btn btn-default" title="print" onclick="window.print()"><i class="fa fa-print"></i> Print Page</button>
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h5><strong>Activity :</strong></h5>
                            <form action="{{url('/timeline/specific/')}}" method="get">
                                <div class="form-group">
                                    <label for="bulan">Bulan</label>
                                    <select name="bulan" id="bulan">
                                        @for($i=1; $i<=12;$i++)
                                            <option value="{{$i}}" {{($month==$i)?'selected':''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <label for="tahun">Tahun</label>
                                    <select name="tahun" id="tahun">
                                        @for($i=2000; $i<=2040;$i++)
                                            <option value="{{$i}}" {{($year==$i)?'selected':''}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <label for="status">Status</label>
                                    <select name="status" id="status">
                                        <option value="all" {{($status=='all')?'selected':''}}>All</option>
                                        <option value="plan" {{($status=='plan')?'selected':''}}>Plan</option>
                                        <option value="ongoing" {{($status=='ongoing')?'selected':''}}>On Going (Process)</option>
                                        <option value="pending" {{($status=='pending')?'selected':''}}>Pending</option>
                                        <option value="late" {{($status=='late')?'selected':''}}>Late</option>
                                        <option value="done" {{($status=='done')?'selected':''}}>Done</option>
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm">Show</button>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-sm-12">
                                    Activities : status '{{$status}}' in {{date('F', mktime(0,0,0,$month,10))}}-{{$year}}
                                    <div class="row">
                                        <div class="col-xs-12 table-responsive">
                                            <table class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th rowspan="2">#</th>
                                                    <th rowspan="2">Activity</th>
                                                    <th colspan="{{$days}}" style="text-align: center;">{{date('F', mktime(0,0,0,$month,10))}}</th>
                                                </tr>
                                                <tr>
                                                    @for($i=1;$i<=$days;$i++)
                                                        <th>{{$i}}</th>
                                                    @endfor
                                                </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($activities as $activity)
                                                    <tr>
                                                        <td>
                                                            {{$loop->iteration}}
                                                        </td>
                                                        <td title="{{$activity->user->name.' dari '.$activity->tanggal_mulai.' s/d '.$activity->tanggal_berakhir}}">
                                                            {{$activity->judul}}<br>
                                                        </td>
                                                        @for($i=1;$i<=$days;$i++)
                                                            <td
                                                                    style="background-color: {{(strtotime($year.'-'.$month.'-'.$i)>= strtotime($activity->tanggal_mulai) && strtotime($year.'-'.$month.'-'.$i)<= strtotime($activity->tanggal_berakhir))?
                                                                    (($activity->status=='plan')?'bisque':(($activity->status=='ongoing')?'aqua':(($activity->status=='late')?'crimson':(($activity->status=='pending')?'gold':'greenyellow')))):
                                                                    ''}};">
                                                                @if($activity->status=='done')
                                                                    @if(strtotime($year.'-'.$month.'-'.$i)==strtotime(date('Y-m-d', strtotime($activity->waktu_selesai))))
                                                                        <span class="fa fa-check"></span>
                                                                    @endif
                                                                @endif
                                                                {{--{{($activity->status=='done')?((strtotime($year.'-'.$month.'-'.$i)==strtotime(date('Y-m-d', strtotime($activity->waktu_selesai))))?'<span class="fa fa-check"></span>':''):''}}--}}
                                                                {{--{{(strtotime($year.'-'.$month.'-'.$i)>= strtotime($activity->tanggal_mulai) && strtotime($year.'-'.$month.'-'.$i)<= strtotime($activity->tanggal_berakhir))?'red':''}}--}}
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                                </tbody>

                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Activity</th>
                                                    @for($i=1;$i<=$days;$i++)
                                                        <th>{{$i}}</th>
                                                    @endfor
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <div class="col-sm-4"><br>
                                            <h5><strong>Keterangan : </strong></h5>
                                            <table class="table">
                                                <tr>
                                                    <td>Warna</td>
                                                    <td>Status</td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: bisque;"></td>
                                                    <td>Plan</td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: aqua;"></td>
                                                    <td>On Going</td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: crimson;"></td>
                                                    <td>Late</td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: gold;"></td>
                                                    <td>Pending</td>
                                                </tr>
                                                <tr>
                                                    <td style="background-color: greenyellow;"></td>
                                                    <td>Done</td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: center"><span class="fa fa-check"></span></td>
                                                    <td>Aktivitas/Kegiatan Selesai</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
