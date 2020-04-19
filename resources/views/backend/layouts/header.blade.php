<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Tri</b>Shapta</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Tri</b>Shapta</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if(Auth::check())@if(Auth::user()->unReadNotifications->count() != 0) <span class="label label-warning">{{Auth::user()->unReadNotifications->count()}}</span>@endif @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">@if(Auth::check())You have {{Auth::user()->unReadNotifications->count()}}
                            unread
                            notifications @endif
                        </li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @if(Auth::check())
                                    @foreach(Auth::user()->unReadNotifications as $unReadNotification)
                                        @if($unReadNotification->type == 'App\Notifications\TodayTaskNotification')
                                            <li>
                                                <a href="{{route('backend.markread',['id' => $unReadNotification->id])}}">
                                                    <i class="fa fa-pencil text-red"></i> {{$unReadNotification->data['data']}}
                                                </a>
                                            </li>
                                        @elseif($unReadNotification->type == 'App\Notifications\EndDayNotification')
                                            <li>
                                                <a href="{{route('backend.markread',['id' => $unReadNotification->id])}}">
                                                    <i class="fa fa-moon-o text-red"></i> {{$unReadNotification->data['data']}}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                        {{-- <li class="footer"><a href="#">View all</a></li>--}}
                    </ul>
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('backend/images/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">@if(Auth::check()){{Auth::user()->name}}@endif</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('backend/images/user2-160x160.jpg')}}" class="img-circle"
                                 alt="User Image">

                            <p>
                                @if(Auth::check()) {{Auth::user()->name}}@endif
                                <small>Position</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('backend.users.password-reset')}}" class="btn btn-default btn-flat">Change
                                    Password</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Sign out</a>
                            </div>
                            <form id="logout-form" action="{{ route('backend.dashboard.logout') }}" method="POST"
                                  style="display: none;">
                                {{csrf_field()}}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>