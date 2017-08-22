@if (Auth::check())
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar" style="background-image:url('{{url('/storage/batik-texture-background.jpg')}}')">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://placehold.it/160x160/00a65a/ffffff/&text={{ mb_substr(Auth::user()->name, 0, 1) }}" class="img-circle" alt="User Image">
          </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        @if(\Illuminate\Support\Facades\Auth::user()->role == 'super_admin')
          <li class="header">SUPER ADMINISTRATOR</li>
          <!-- ================================================ -->
          <!-- ==== Recommended place for admin menu items ==== -->
          <!-- ================================================ -->
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li><a href="{{ url("/timeline")}}"><i class="fa fa-flag-checkered"></i><span>Time Line</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Data</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('data/user/')}}"><i class="fa fa-book"></i> Users</a></li>
              <li><a href="{{url('data/profile/')}}"><i class="fa fa-book"></i> Profiles</a></li>
              <li><a href="{{url('data/user_activity')}}"><i class="fa fa-book"></i> User Activities</a></li>
              <li><a href="{{url('data/activity/')}}"><i class="fa fa-book"></i> Activities</a></li>
              <li><a href="{{url('data/attachment_activity/')}}"><i class="fa fa-book"></i> Attachment Activities</a></li>
              <li><a href="{{url('data/comment/')}}"><i class="fa fa-book"></i> Comments</a></li>
              <li><a href="{{url('data/attachment_comment/')}}"><i class="fa fa-book"></i> Attachment Comments</a></li>
              <li><a href="{{url('data/list_to_do/')}}"><i class="fa fa-book"></i> Lists To Do</a></li>
              <li><a href="{{url('data/attachment_list_to_do/')}}"><i class="fa fa-book"></i> Attachment Lists To Do</a></li>
              <li><a href="{{url('data/archive/')}}"><i class="fa fa-book"></i> Archives</a></li>
              <li><a href="{{url('data/group/')}}"><i class="fa fa-book"></i> Groups</a></li>
              {{--<li><a href="{{url('data/message/')}}"><i class="fa fa-circle-o"></i> Messages</a></li>--}}
              {{--<li><a href="{{url('data/notification/')}}"><i class="fa fa-circle-o"></i> Notifications</a></li>--}}
              <li><a href="{{url('data/log_activity')}}"><i class="fa fa-book"></i> Log Activities</a></li>
            </ul>
          <li><a href="{{url('data/group')}}"><i class="fa fa-cubes"></i> <span>Groups</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Member</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url("/group_admin")}}"><i class="fa fa-group"></i><span>Group Admin</span></a></li>
              <li><a href="{{url("/member_group")}}"><i class="fa fa-group"></i><span>Member Group</span></a></li>
              {{--<li><a href="{{url("/viewer")}}"><i class="fa fa-group"></i><span>Viewer</span></a></li>--}}
            </ul>
          </li>
          <li><a href="{{ url("/activity") }}"><i class="fa fa-book"></i><span>Activities</span></a></li>
          <li><a href="/log_activity"><i class="fa fa-history"></i><span>Log Activity</span></a></li>
          <li><a href="/archive"><i class="fa fa-archive"></i><span>Archive</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Help</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('/help/how_to_use')}}"><i class="fa fa-question-circle"></i> How To Use</a></li>
              <li><a href="{{url('/help/information')}}"><i class="fa fa-question-circle"></i> Information</a></li>
              <li><a href="{{url('/help/about')}}"><i class="fa fa-question-circle"></i> About</a></li>
              <li><a href="{{url('/help/contact')}}"><i class="fa fa-question-circle"></i> Contact</a></li>
            </ul>
          </li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/log') }}"><i class="fa fa-terminal"></i> <span>Logs</span></a></li>
{{--          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}"><i class="fa fa-hdd-o"></i> <span>Backups</span></a></li>--}}
          </li>

        @elseif(\Illuminate\Support\Facades\Auth::user()->role == 'member_group')
        <!-- =====================MEMBER GROUP================== -->
          <li class="header">MEMBER GROUP</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li><a href="{{ url("/timeline")}}"><i class="fa fa-flag-checkered"></i><span>Time Line</span></a></li>
          <li><a href="{{ url("/list_to_do") }}"><i class="fa fa-calendar"></i> <span>To Do List</span></a></li>
          <li><a href="{{ url("/activity") }}"><i class="fa fa-book"></i><span>Activities</span></a></li>
          <li><a href="{{ url("/log_activity") }}"><i class="fa fa-history"></i><span>Log Activity</span></a></li>
          <li><a href="{{ url("/archive") }}"><i class="fa fa-archive"></i><span>Archive</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Help</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('/help/how_to_use')}}"><i class="fa fa-question-circle"></i> How To Use</a></li>
              <li><a href="{{url('/help/information')}}"><i class="fa fa-question-circle"></i> Information</a></li>
              <li><a href="{{url('/help/about')}}"><i class="fa fa-question-circle"></i> About</a></li>
              <li><a href="{{url('/help/contact')}}"><i class="fa fa-question-circle"></i> Contact</a></li>
            </ul>
          </li>

        @elseif(\Illuminate\Support\Facades\Auth::user()->role == 'group_admin')
        <!-- ===================Group Admin==================== -->
          <li class="header">GROUP ADMINISTRATOR</li>
          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
          <li><a href="{{ url("/timeline") }}"><i class="fa fa-flag-checkered"></i><span>Time Line</span></a></li>
          <li><a href="{{ url("/list_to_do") }}"><i class="fa fa-calendar"></i> <span>To Do List</span></a></li>
          <li><a href="{{ url("/activity") }}"><i class="fa fa-book"></i><span>Activities</span></a></li>
          <li><a href="{{ url("/log_activity") }}"><i class="fa fa-history"></i><span>Log Activity</span></a></li>
          <li><a href="{{ url("/archive") }}"><i class="fa fa-archive"></i><span>Archive</span></a></li>
          <li><a href="{{ url("/member_group") }}"><i class="fa fa-group"></i><span>Member Group</span></a></li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-share"></i> <span>Help</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="{{url('/help/how_to_use')}}"><i class="fa fa-question-circle"></i> How To Use</a></li>
              <li><a href="{{url('/help/information')}}"><i class="fa fa-question-circle"></i> Information</a></li>
              <li><a href="{{url('/help/about')}}"><i class="fa fa-question-circle"></i> About</a></li>
              <li><a href="{{url('/help/contact')}}"><i class="fa fa-question-circle"></i> Contact</a></li>
            </ul>
          </li>

        {{--@elseif(\Illuminate\Support\Facades\Auth::user()->role == 'viewer')--}}
        {{--<!-- ====================Viewer=================== -->--}}
          {{--<li class="header">VIEWER</li>--}}
          {{--<li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>--}}
          {{--<li><a href="{{ url("/timeline") }}"><i class="fa fa-flag-checkered"></i><span>Time Line</span></a></li>--}}
          {{--<li><a href="{{ url("/list_to_do") }}"><i class="fa fa-calendar"></i> <span>To Do List</span></a></li>--}}
          {{--<li><a href="{{ url("/activity") }}"><i class="fa fa-book"></i><span>Activities</span></a></li>--}}
          {{--<li><a href="{{ url("/log_activity") }}"><i class="fa fa-history"></i><span>Log Activity</span></a></li>--}}
          {{--<li><a href="{{ url("archive") }}"><i class="fa fa-archive"></i><span>Archive</span></a></li>--}}
          {{--<li class="treeview">--}}
            {{--<a href="#">--}}
              {{--<i class="fa fa-share"></i> <span>Help</span>--}}
              {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
            {{--</a>--}}
            {{--<ul class="treeview-menu">--}}
              {{--<li><a href="{{url('/help/how_to_use')}}"><i class="fa fa-circle-o"></i> How To Use</a></li>--}}
              {{--<li><a href="{{url('/help/information')}}"><i class="fa fa-circle-o"></i> Information</a></li>--}}
              {{--<li><a href="{{url('/help/about')}}"><i class="fa fa-circle-o"></i> About</a></li>--}}
              {{--<li><a href="{{url('/help/contact')}}"><i class="fa fa-circle-o"></i> Contact</a></li>--}}
            {{--</ul>--}}
          {{--</li>--}}

        @endif
        {{--          <li><a href="{{ url(config('backpack.base.route_prefix', 'admin').'/logout') }}"><i class="fa fa-sign-out"></i> <span>{{ trans('backpack::base.logout') }}</span></a></li>--}}
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
@endif
