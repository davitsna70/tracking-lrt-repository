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
        <!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" />
    <link rel="icon" href="{{ asset('images/LRT.png') }}">
    <title>Light Rail Transit</title>
    <link rel="stylesheet" href="{{ asset('onepage') }}/css/components.css">
    <link rel="stylesheet" href="{{ asset('onepage') }}/css/responsee.css">
    <link rel="stylesheet" href="{{ asset('onepage') }}/owl-carousel/owl.carousel.css">
    <link rel="stylesheet" href="{{ asset('onepage') }}/owl-carousel/owl.theme.css">
    <!-- CUSTOM STYLE -->
    <link rel="stylesheet" href="{{ asset('onepage') }}/css/template-style.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="{{ asset('onepage') }}/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="{{ asset('onepage') }}/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{{ asset('onepage') }}/js/modernizr.js"></script>
    <script type="text/javascript" src="{{ asset('onepage') }}/js/responsee.js"></script>
    <script type="text/javascript" src="{{ asset('onepage') }}/js/template-scripts.js"></script>

    <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <![endif]-->

{{--ADMIN CSS--}}
<!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/pace/pace.min.css">
    <link rel="stylesheet" href="{{ asset('vendor/backpack/pnotify/pnotify.custom.min.css') }}">

    <!-- BackPack Base CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/backpack/backpack.base.css') }}">


    <!-- It's Adding -->
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/datepicker/datepicker3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/iCheck/all.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/plugins/select2/select2.min.css">
    {{--ADMIN CSS--}}
</head>
<body class="size-1140">
<!-- TOP NAV WITH LOGO -->
<header>
    <div id="topbar" style="background-color: white;">
        <div class="line" >
            <div class="s-12 m-6 l-6">
                <p style="color: Crimson;">CONTACT US: <strong>+62-21-23951100</strong> | <strong>https://maritim.go.id/</strong></p>
            </div>
            <div class="s-12 m-6 l-6">
                <div class="social right" >
                    <a href="https://facebook.com/KemenkoMaritim/"><i class="fa fa-facebook" style="color: Crimson;"></i></a> <a href="https://twitter.com/kemaritiman"><i class="fa fa-twitter" style="color: Crimson;"></i></a> <a href="https://www.youtube.com/channel/UCZ_VMsksfnH9ts_0QNNa06w"><i class="fa fa-youtube-play" style="color: Crimson;"></i></a> <a href="https://www.instagram.com/kemenkomaritim/"><i class="fa fa-instagram" style="color: Crimson;"></i></a> <a href="https://maritim.go.id/feed/rss/"><i class="fa fa-feed" style="color: Crimson;"></i></a>
                </div>
            </div>
        </div>
    </div>
    <nav style="background-color: midnightblue; opacity: 10;">
        <div class="line">
            <div class="s-12 l-2">
                <a href="{{url("/home")}}">
                    <img src="{{ asset('images/LRT.png') }}" alt="Logo" style="height: 50px; width: 50px;" class="img-circle inline">
                    <p class="logo inline" style="font-size: 16px">
                        Light Rail Transit
                    </p>
                </a>
            </div>
            <div class="top-nav s-12 l-10">
                <p class="nav-text">Custom menu text</p>
                <ul class="right">
                    <li class="active-item"><a href="#carousel">Home</a></li>
                    <li><a href="#project-timeline">Timeline</a></li>
                    {{--<li><a href="#features">Features</a></li>--}}
                    {{--<li><a href="#about-us">About Us</a></li>--}}
                    {{--<li><a href="#our-work">Our Work</a></li>--}}
                    {{--<li><a href="#services">Services</a></li>--}}
                    {{--<li><a href="#contact">Contact</a></li>--}}
                    @if(Auth::check())
                        <li class="" id="dashboard"><a href="#">Dashboard</a></li>
                        <li class="" id="logout"><a href="#">Sign Out</a></li>
                    @else
                        <li class="" id="login"><a href="#"> {{ trans('backpack::base.login') }}</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>
<section>
    <!-- CAROUSEL -->
    <div id="carousel">
        <div id="owl-demo" class="owl-carousel owl-theme">
            <div class="item">
                <img src="{{ asset('onepage') }}/img/01.jpg" alt="">
                <div class="line">
                    <div class="text hide-s">
                        <div class="line">
                            <div class="prev-arrow hide-s hide-m">
                                <i class="icon-chevron_left"></i>
                            </div>
                            <div class="next-arrow hide-s hide-m">
                                <i class="icon-chevron_right"></i>
                            </div>
                        </div>
                        {{--<h2>Free Onepage Responsive Template</h2>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>--}}
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('onepage') }}/img/02.jpg" alt="">
                <div class="line">
                    <div class="text hide-s">
                        <div class="line">
                            <div class="prev-arrow hide-s hide-m">
                                <i class="icon-chevron_left"></i>
                            </div>
                            <div class="next-arrow hide-s hide-m">
                                <i class="icon-chevron_right"></i>
                            </div>
                        </div>
                        {{--<h2>Fully Responsive Components</h2>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>--}}
                    </div>
                </div>
            </div>
            <div class="item">
                <img src="{{ asset('onepage') }}/img/03.jpg" alt="">
                <div class="line">
                    <div class="text hide-s">
                        <div class="line">
                            <div class="prev-arrow hide-s hide-m">
                                <i class="icon-chevron_left"></i>
                            </div>
                            <div class="next-arrow hide-s hide-m">
                                <i class="icon-chevron_right"></i>
                            </div>
                        </div>
                        {{--<h2>Build new Layout in 10 minutes!</h2>--}}
                        {{--<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna.</p>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FIRST BLOCK -->
    <div id="first-block">
        <div class="line">
            <h1>Light Rail Transit</h1>
            <p>Jakarta Light Rail Transit atau disingkat Jakarta LRT adalah sebuah sistem MassTransit dengan kereta api ringan (LRT) yang direncanakan akan dibangun di Jakarta, Indonesia dan menghubungkan Jakarta dengan kota-kota disekitarnya seperti Bekasi dan Bogor. Ada 2 penggagas LRT di Jakarta, Pemprov DKI yang akan membangun LRT dalam kota dan PT Adhi Karya yang akan membangun penghubung Jakarta ke kota sekitarnya.</p>
            <p><a href="https://id.wikipedia.org/wiki/Jakarta_LRT">Wikipedia : LRT Jakarta</a></p>
            <div class="s-12 m-4 l-2 center"><a class="white-btn" href="#contact">Contact Us</a></div>
        </div>
    </div>

    <!-- TIMELINE -->
    @if($activities != null)
        <div class="container" id="project-timeline">
            <div class="row">
                <div class="s-12 m-12 l-12">
                    <h2>Process Tracker</h2>
                </div>
                <div class="s-12 m-6 l-6">
                    <div class="project-progress">
                        <h3>Project Progress : {{printf("%.1f",100*$numAllListToDoDone/$numAllListToDo)}}%</h3>
                        @if(100*$numAllListToDoDone/$numAllListToDo==100)
                            <h4 style="background-color: greenyellow">Complete...</h4>
                        @endif
                        <div class="progress ">
                            <div class="progress-bar progress-bar-striped active progress-bar-aqua" style="width: {{100*$numAllListToDoDone/$numAllListToDo}}%" role="progressbar" aria-valuenow="{{100*$numAllListToDoDone/$numAllListToDo}}" aria-valuemin="0" aria-valuemax="100">
                                <span class="sr-only">{{100*$numAllListToDoDone/$numAllListToDo}}% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="s-12 m-6 l-6">
                    <div class="project-time right">
                        <!-- Display the countdown timer in an element -->
                        <h3>Count Down:</h3>
                        <strong><p id="demo" style="font-size: 25px; font-style: oblique;"></p></strong>

                    </div>
                </div>
                <div class="project-table">
                    <div class="col-sm-12" style="background-color: white;">
                        <h5><strong>Activity :</strong></h5>
                        <form action="{{url('/home/date')}}" method="get">
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
                                                <th rowspan="3" style="text-align:center">Activity</th>
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
                                                                <span class="label label-info">Done On Time</span>
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
                                                            <div class="progress-bar progress-bar-striped active  progress-bar-aqua" style="width: {{100*$sumDateToday/$sumDateAll}}%" role="progressbar" aria-valuenow="{{100*$sumDateToday/$sumDateAll}}" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">{{100*$sumDateToday/$sumDateAll}}% Complete</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="{{getNumWeekBetweenMonth((int)$month, 12, $year)}}">
                                                        Activity Progress : {{round($activity->getPersentageProgress())}}%
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-striped active progress-bar-aqua" style="width: {{$activity->getPersentageProgress()}}%" role="progressbar" aria-valuenow="{{$activity->getPersentageProgress()}}" aria-valuemin="0" aria-valuemax="100">
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
                    </div>
                </div>
            </div>
        </div>
    @else
        <h3>None Activities Right Now</h3>
@endif

<!-- MAP -->
    {{--<div id="map-block">--}}
        {{--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1247814.3661917313!2d16.569872019090596!3d48.23131953825178!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x476c8cbf758ecb9f%3A0xddeb1d26bce5eccf!2sGallayova+2150%2F19%2C+841+02+D%C3%BAbravka!5e0!3m2!1ssk!2ssk!4v1440344568394" width="100%" height="450" frameborder="0" style="border:0"></iframe>--}}
    {{--</div>--}}
    <div id="googleMap" style="width:100%;height:400px;"></div>
</section>
<!-- FOOTER -->
<footer style="background-color: #1c2d3f;" id="contact">
    <div class="line">
        <div class="s-12 l-6">
            <div id="text-10" class="widget widget_text">
                <h4>Kontak</h4>
                <div class="textwidget">
                    <h4><a href="https://maritim.go.id/">Kemenko Kemaritiman RI</a></h4>
                    <p><i class="fa fa-map-marker"></i> Jl. M.H. Thamrin No. 8
                        Jakarta Pusat 10340, Indonesia</p>
                    <p><i class="fa fa-phone"></i> +62-21-23951100</p>
                    <p><i class="fa fa-fax"></i> +62-21-3141790</p>
                    <p><a href="https://maritim.go.id/kontak/" style="font-size: 12px"><i class="fa  fa-envelope-o"></i> Hubungi Kami</a></p>
                    {{--<p>All images is purchased from Bigstock. Do not use the images in your website.</p>--}}
                </div>
                <div class="s-12 l-6">

                    {{--<a class="right" href="http://www.myresponsee.com" title="Responsee - lightweight responsive framework">Design and coding<br> by Responsee Team</a>--}}
                </div>
            </div>
        </div>
        <p class="pull-right">Copyright 2015, Vision Design - graphic zoo</p>
    </div>
</footer>
<script type="text/javascript" src="{{ asset('onepage') }}/owl-carousel/owl.carousel.js"></script>

<script>
    function myMap() {
        var mapProp= {
            center:new google.maps.LatLng(-6.184995,106.822756),
            zoom:18,
        };
        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
    }
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCns1RnL_QiTsHqZidgrscpBYzETOerdsU&callback=myMap"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        var theme_slider = $("#owl-demo");
        $("#owl-demo").owlCarousel({
            navigation: false,
            slideSpeed: 300,
            paginationSpeed: 400,
            autoPlay: 6000,
            addClassActive: true,
            // transitionStyle: "fade",
            singleItem: true
        });
        $("#owl-demo2").owlCarousel({
            slideSpeed: 300,
            autoPlay: true,
            navigation: true,
            navigationText: ["&#xf007","&#xf006"],
            pagination: false,
            singleItem: true
        });

        // Custom Navigation Events
        $(".next-arrow").click(function() {
            theme_slider.trigger('owl.next');
        })
        $(".prev-arrow").click(function() {
            theme_slider.trigger('owl.prev');
        })
    });
</script>
{{--COUNTDOWN--}}
<script>
    // Set the date we're counting down to
    var countDownDate = new Date("Jun 30, 2019 00:00:00").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get todays date and time
        var now = new Date().getTime();

        // Find the distance between now an the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = "| "+days + " Day | " + hours + " Hour | "
            + minutes + " Min | " + seconds + " Sec |";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
        }
    }, 1000);
    
    $('#login').on('click',
        function () {
            window.location.href = "{{url('/login')}}";
        }
    );

    $('#dashboard').on('click',
        function () {
            window.location.href = "{{url('/dashboard')}}";
        }
    );

    $('#logout').on('click',
        function () {
            window.location.href = "{{url('/logout')}}";
        }
    );
</script>
</body>
</html>