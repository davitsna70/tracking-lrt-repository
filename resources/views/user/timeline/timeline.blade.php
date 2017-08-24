@extends('backpack::layout')

@section('header')
    <?php
    function weekOn($date){
        $day = date('d', strtotime($date));
        return ceil($day/7);
    }

    function limitWeekInMonth($date){
        $month = date('m', strtotime($date));
        $year = date('Y', strtotime($date));
        $limitDayInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        return ceil($limitDayInMonth/7);
    }

    function limitWeekInYear($date){
        $day = 1;
        $months = 12;
        $year = date('Y', strtotime($date));

        $sumWeeks = 0;

        for ($month = 1; $month<=$months; $month++){
            $sumWeeks+=limitWeekInMonth(date('Y-m-d', strtotime($year.'-'.$month.'-'.$day)));
        }

        return $sumWeeks;
    }

    function isInRangeDate($date, $dateStart, $dateEnd){
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day = (cal_days_in_month(CAL_GREGORIAN,$month,$year)>= 6+(int)date('d', strtotime($date)))?6+(int)date('d', strtotime($date)):date('d', strtotime($date));
        $dateFirst = $year.'-'.$month.'-'.$day;
        return ((strtotime($dateFirst)>=strtotime($dateStart)) && (strtotime($date)<=strtotime($dateEnd)));
    }

    function getNumWeekBetweenMonth($monthStart, $monthEnd, $year){
        $numWeeks = 0;
        for ($i=$monthStart; $i<=$monthEnd;$i++){
            $numWeeks+=limitWeekInMonth(date($year.'-'.$i.'-01'));
        }
        return $numWeeks;
    }

    ?>
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
                    {{--<button class="pull-right btn btn-default" title="print" onclick="window.print()"><i class="fa fa-print"></i> Print Page</button>--}}
                </div>

                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            @if($activities!=null)
                                <h5><strong>Activity :</strong></h5>
                                <form action="{{url('/timeline/specific/')}}" method="get">
                                    {{--{{csrf_field()}}--}}
                                    <div class="form-group">
                                        {{--<label for="bulan">Bulan</label>--}}
                                        {{--<select name="bulan" id="bulan">--}}
                                        {{--@for($i=1; $i<=12;$i++)--}}
                                        {{--<option value="{{$i}}" {{($month==$i)?'selected':''}}>{{$i}}</option>--}}
                                        {{--@endfor--}}
                                        {{--</select>--}}
                                        <label for="tahun">Tahun</label>
                                        <select name="tahun" id="tahun">
                                            @for($i=$firstYear; $i<=$lastYear;$i++)
                                                <option value="{{$i}}" {{($year==$i)?'selected':''}}>{{$i}}</option>
                                            @endfor
                                        </select>
                                        <label for="status">Status</label>
                                        <select name="status" id="status">
                                            <option value="all" {{($status=='all')?'selected':''}}>All</option>
                                            <option value="plan" {{($status=='plan')?'selected':''}}>Plan</option>
                                            <option value="ongoing" {{($status=='ongoing')?'selected':''}}>On Going (Process)</option>
                                            {{--<option value="pending" {{($status=='pending')?'selected':''}}>Pending</option>--}}
                                            <option value="late" {{($status=='late')?'selected':''}}>Late</option>
                                            <option value="done" {{($status=='done')?'selected':''}}>Done</option>
                                        </select>
                                        <button type="submit" class="btn btn-primary btn-sm">Show</button>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-sm-12">
                                        Activities : status '{{$status}}' in {{$year}}
                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table id="example1" class="table table-bordered table-striped dataTable " role="grid" aria-describedby="example1_info">
                                                    <thead>
                                                    <tr role="row">
                                                        <th rowspan="3">#</th>
                                                        <th rowspan="3">Activity</th>
                                                        <th colspan="{{getNumWeekBetweenMonth((int)$month, 12, $year)}}" style="text-align: center;">{{$year}}</th>
                                                    </tr>
                                                    <tr>
                                                        @for($it=$month;$it<=12;$it++)
                                                            <th colspan="{{limitWeekInMonth(date('Y-m-d', strtotime($year.'-'.$it.'-01')))}}" style="text-align: center;">
                                                                {{date('F', strtotime($year.'-'.$it.'-01'))}}
                                                            </th>
                                                        @endfor
                                                    </tr>
                                                    <tr>
                                                        @for($it=$month;$it<=12;$it++)
                                                            @for($i=1;$i<=limitWeekInMonth(date('Y-m-d', strtotime($year.'-'.$it.'-01'))); $i++)
                                                                <th style="text-align: center;">
                                                                    {{$i}}
                                                                </th>
                                                            @endfor
                                                        @endfor
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    @foreach($activities as $activity)
                                                        <tr>
                                                            <td rowspan="3">
                                                                {{$loop->iteration}}
                                                            </td>
                                                            <td rowspan="3">
                                                                <strong>{{$activity->judul}}</strong>
                                                                @if($activity->status=='done')
                                                                    @if(strtotime(date('Y-m-d', strtotime($activity->waktu_selesai))) > strtotime($activity->tanggal_berakhir))
                                                                        <span class="label label-danger">Done After Time</span>
                                                                    @elseif(strtotime(date('Y-m-d', strtotime($activity->waktu_selesai))) == strtotime($activity->tanggal_berakhir))
                                                                        <span class="label label-info">Done In Time</span>
                                                                    @elseif(strtotime(date('Y-m-d', strtotime($activity->waktu_selesai))) < strtotime($activity->tanggal_berakhir))
                                                                        <span class="label label-success">Done Before Time</span>
                                                                    @endif
                                                                @endif

                                                                <br>
                                                                <div style="font-size: 10px">{{$activity->tanggal_mulai}} s/d {{$activity->tanggal_berakhir}}</div>
                                                                <div style="font-size: 13px">Member : </div>
                                                                @foreach(\App\UserActivity::where('activity_id', '=', $activity->id)->get() as $userAct)
                                                                    <li style="font-size: 12px">{{$userAct->user->name}}</li>
                                                                @endforeach
                                                            </td>
                                                            <?php $sumDateAll = 0;?>
                                                            @for($it=$month;$it<=12;$it++)
                                                                @for($i=1;$i<=limitWeekInMonth(date('Y-m-d', strtotime($year.'-'.$it.'-01'))); $i++)
                                                                    @if( isInRangeDate(date('Y-m-d', strtotime($year.'-'.$it.'-'.((($i-1)*7)+1))), $activity->tanggal_mulai, $activity->tanggal_berakhir))
                                                                        <?php $sumDateAll++; ?>
                                                                        @if($activity->status == 'plan')
                                                                            <td style="background-color: bisque;"></td>
                                                                        @elseif($activity->status =='ongoing')
                                                                            @if($it == date('m') && $i<=weekOn(date('Y-m-d')))
                                                                                <td style="background-color: aqua;"></td>
                                                                            @else
                                                                                <td style="background-color: bisque;"></td>
                                                                            @endif
                                                                        @elseif($activity->status == 'late')
                                                                            <td style="background-color: crimson;"></td>
                                                                        @else
                                                                            {{--                                                                                {{$activity->waktu_selesai}}--}}
                                                                            @if($activity->waktu_selesai!=null)
                                                                                @if($i<=weekOn($activity->waktu_selesai) && $it<=date('m',strtotime($activity->waktu_selesai)))
                                                                                    <td style="background-color: greenyellow;">
                                                                                @else
                                                                                    <td style="background-color: bisque;"></td>
                                                                                @endif
                                                                                @if($it==date('m',strtotime($activity->waktu_selesai)))
                                                                                    @if($i==weekOn($activity->waktu_selesai))
                                                                                        <span class="fa fa-check"></span>
                                                                                        @endif
                                                                                        @endif
                                                                                        @endif
                                                                                        </td>
                                                                                    @endif
                                                                                @else
                                                                                    <td style="text-align: center; background-color: white;">
                                                                                        @if($activity->waktu_selesai!=null)
                                                                                            @if($it==date('m',strtotime($activity->waktu_selesai)))
                                                                                                @if($i==weekOn($activity->waktu_selesai))
                                                                                                    <span class="fa fa-check"></span>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endif
                                                                                    </td>
                                                                                @endif
                                                                                @endfor
                                                                                @endfor
                                                                                <?php $sumDateToday=0;?>
                                                                                @if(strtotime(date('Y-m-d'))>=strtotime($activity->tanggal_berakhir))
                                                                                    <?php $sumDateToday=$sumDateAll;?>
                                                                                @elseif(strtotime(date('Y-m-d'))<=strtotime($activity->tanggal_mulai))
                                                                                    <?php $sumDateToday=0;?>
                                                                                @else
                                                                                    @for($it=$month;$it<=12;$it++)
                                                                                        @for($i=1;$i<=limitWeekInMonth(date('Y-m-d', strtotime($year.'-'.$it.'-01'))); $i++)
                                                                                            @if( isInRangeDate(date('Y-m-d', strtotime($year.'-'.$it.'-'.((($i-1)*7)+1))), $activity->tanggal_mulai, $activity->tanggal_berakhir))
                                                                                                @if(strtotime($year.'-'.$it.'-'.((($i-1)*7)+1))<=strtotime(date('Y-m-d')))
                                                                                                    <?php $sumDateToday++; ?>
                                                                                                @endif
                                                                                            @endif
                                                                                        @endfor
                                                                                    @endfor
                                                                                @endif
                                                        </tr>
                                                        <tr>
                                                            <td colspan="{{getNumWeekBetweenMonth((int)$month, 12, $year)}}">
                                                                {{--{{$sumDateToday}}<br>--}}
                                                                {{--{{$sumDateAll}}--}}
                                                                Time Progress : {{round(100*$sumDateToday/$sumDateAll)}}%
                                                                <div class="progress xs">
                                                                    <div class="progress-bar progress-bar-aqua" style="width: {{100*$sumDateToday/$sumDateAll}}%" role="progressbar" aria-valuenow="{{100*$sumDateToday/$sumDateAll}}" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">{{100*$sumDateToday/$sumDateAll}}% Complete</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="{{getNumWeekBetweenMonth((int)$month, 12, $year)}}">
                                                                Activity Progress : {{round($activity->getPersentageProgress())}}%
                                                                <div class="progress xs">
                                                                    <div class="progress-bar progress-bar-aqua" style="width: {{$activity->getPersentageProgress()}}%" role="progressbar" aria-valuenow="{{$activity->getPersentageProgress()}}" aria-valuemin="0" aria-valuemax="100">
                                                                        <span class="sr-only">{{$activity->getPersentageProgress()}}% Complete</span>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>

                                                    <tfoot>
                                                    <tr>
                                                        <th rowspan="2">#</th>
                                                        <th rowspan="2">Activity</th>
                                                        @for($it=$month;$it<=12;$it++)
                                                            @for($i=1;$i<=limitWeekInMonth(date('Y-m-d', strtotime($year.'-'.$it.'-01'))); $i++)
                                                                <th style="text-align: center;">
                                                                    {{$i}}
                                                                </th>
                                                            @endfor
                                                        @endfor
                                                    </tr>
                                                    <tr>
                                                        @for($it=$month;$it<=12;$it++)
                                                            <th colspan="{{limitWeekInMonth(date('Y-m-d', strtotime($year.'-'.$it.'-01')))}}" style="text-align: center;">
                                                                {{date('F', strtotime($year.'-'.$it.'-01'))}}
                                                            </th>
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
                                                    {{--<tr>--}}
                                                    {{--<td style="background-color: gold;"></td>--}}
                                                    {{--<td>Pending</td>--}}
                                                    {{--</tr>--}}
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
                            @else
                                <h3>None Activities Right Now</h3>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
