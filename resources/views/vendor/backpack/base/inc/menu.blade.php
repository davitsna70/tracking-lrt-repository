<div class="navbar-custom-menu pull-left">
    <ul class="nav navbar-nav">
        <!-- =================================================== -->
        <!-- ========== Top menu items (ordered left) ========== -->
        <!-- =================================================== -->

    <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        <!-- ========== End of top menu left items ========== -->
    </ul>
</div>


<div class="navbar-custom-menu">
    <ul class="nav navbar-nav" style="font-size: 16px">
        <!-- ========================================================= -->
        <!-- ========== Top menu right items (ordered left) ========== -->
        <!-- ========================================================= -->

    <!-- <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> <span>Home</span></a></li> -->

        @if (\Illuminate\Support\Facades\Auth::guest())
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/login') }}"><span class="fa fa-sign-in"></span> {{ trans('backpack::base.login') }}</a></li>
            @if (config('backpack.base.registration_open'))
                {{--                <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/register') }}">{{ trans('backpack::base.register') }}</a></li>--}}
            @endif
        @else
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu" id="notification-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning" id="notification-span">{{count(Auth::user()->unreadNotifications)}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header" id="notification-text">You have {{count(Auth::user()->unreadNotifications)}} notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                    <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                        @foreach(Auth::user()->unreadNotifications as $notification)
                                            <li>
                                                @include ('notification.'.snake_case(basename($notification->type)))
                                            </li>
                                        @endforeach
                                    </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
                            </li>
                            <li class="footer"><a href="{{url('/notification/')}}">View all</a></li>
                        </ul>
                    </li>
                    <!-- Tasks: style can be found in dropdown.less -->
                    <li class="dropdown tasks-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-flag-o"></i>
                            <span class="label label-danger">{{count(\App\UserActivity::where('user_id', '=' , Auth::user()->id)->get()) + count(\App\Activity::where('user_id', '=', Auth::user()->id)->get())}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have {{count(\App\UserActivity::where('user_id', '=' , Auth::user()->id)->get()) + count(\App\Activity::where('user_id', '=', Auth::user()->id)->get())}} activities</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                        @foreach(\App\Activity::where('user_id', '=', Auth::user()->id)->get() as $activity)
                                        <li><!-- Task item -->
                                            <a href="{{url('/activity/'.$activity->id.'/show')}}">
                                                <h3>
                                                    {{$activity->judul}}
                                                    <small class="pull-right">{{$activity->getPersentageProgress()}}%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: {{$activity->getPersentageProgress()}}%" role="progressbar" aria-valuenow="{{$activity->getPersentageProgress()}}" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">{{$activity->getPersentageProgress()}}% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                            @foreach(\App\UserActivity::where('user_id', '=' , Auth::user()->id)->get() as $userActivity)
                                                <li><!-- Task item -->
                                                    <a href="{{url('/activity/'.$userActivity->activity->id.'/show')}}">
                                                        <h3>
                                                            {{$userActivity->activity->judul}}
                                                            <small class="pull-right">{{$userActivity->activity->getPersentageProgress()}}%</small>
                                                        </h3>
                                                        <div class="progress xs">
                                                            <div class="progress-bar progress-bar-aqua" style="width: {{$userActivity->activity->getPersentageProgress()}}%" role="progressbar" aria-valuenow="{{$userActivity->activity->getPersentageProgress()}}" aria-valuemin="0" aria-valuemax="100">
                                                                <span class="sr-only">{{$userActivity->activity->getPersentageProgress()}}% Complete</span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                        @endforeach
                                        <!-- end task item -->
                                    </ul>
                                    <div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">

                                    </div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">

                                    </div>
                                </div>
                            </li>
                            <li class="footer">
                                <a href="/notification/task">View all activities</a>
                            </li>
                        </ul>
                    </li>
                    <!-- UProfileount: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            @if(\Illuminate\Support\Facades\Auth::user()->profile != null)
                                @if(Auth::user()->profile->foto_profil!=null)
                                    <img src="{{ url("/profile/photo/".basename(\Illuminate\Support\Facades\Auth::user()->profile->foto_profil)) }}"
                                         class="user-image" alt="User Image">
                                @else
                                    <img src="{{ url("/profile/photo/na.png")}}" class="user-image" alt="N/A">
                                @endif
                            @else
                                <img src="{{ url("/profile/photo/na.png")}}" class="user-image" alt="N/A">
                            @endif
                            <span class="hidden-xs">{{\Illuminate\Support\Facades\Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                @if(\Illuminate\Support\Facades\Auth::user()->profile != null)
                                    @if(Auth::user()->profile->foto_profil!=null)
                                        <img src="{{ url("/profile/photo/".basename(\Illuminate\Support\Facades\Auth::user()->profile->foto_profil)) }}"
                                             class="img-circle" alt="User Image">
                                    @else
                                        <img src="{{ url("/profile/photo/na.png")}}" class="img-circle" alt="N/A">
                                    @endif
                                @else
                                    <img src="{{ url("/profile/photo/na.png")}}" class="img-circle" alt="N/A">
                                @endif

                                <p>
                                    {{\Illuminate\Support\Facades\Auth::user()->name}} - {{\Illuminate\Support\Facades\Auth::user()->group->nama_group}}
                                    <small>Member since {{\Illuminate\Support\Facades\Auth::user()->created_at}}</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="row">
                                    <div class="col-xs-6 text-center">
                                        <a href="{{url("/profile/team")}}">Team</a>
                                    </div>
                                    <div class="col-xs-6 text-center">
                                        <a href="{{url("/profile/reset_password")}}">Reset Password</a>
                                    </div>
                                    {{--<div class="col-xs-4 text-center">--}}
                                    {{--<a href="#">Friends</a>--}}
                                    {{--</div>--}}
                                </div>
                                <!-- /.row -->
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{url("/profile/")}}" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}" class="btn btn-default btn-flat">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    {{--<li>--}}
                    {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-btn fa-sign-out"></i> {{ trans('backpack::base.logout') }}</a></li>--}}
    @endif

    <!-- ========== End of top menu right items ========== -->
    </ul>
</div>
