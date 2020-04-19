<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
    {{--<div class="user-panel">
        <div class="pull-left image">
            <img src="{{asset('backend/images/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p>Alexander Pierce</p>
            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
    </div>--}}
    <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            @role('superadministrator|administrator')
            <li class="header">WEBSITE NAVIGATION</li>

            <li>
                <a href="{{route('backend.dashboard')}}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-leaf"></i>
                    <span>Category Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('backend.primary-category')}}"><i class="fa fa-circle-o"></i> Primary Category</a>
                    </li>
                    <li><a href="{{route('backend.secondary-category')}}"><i class="fa fa-circle-o"></i> Secondary
                            Category</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i>
                    <span>Product Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('backend.product.add')}}"><i class="fa fa-circle-o"></i> Add Product</a></li>
                    <li><a href="#"><i class="fa fa-circle-o"></i> Search Product</a></li>
                    <li><a href="{{route('backend.product')}}"><i class="fa fa-circle-o"></i> View Product</a></li>
                </ul>
            </li>
            <li><a href="{{route('backend.homeslider')}}"><i class="fa fa-image"></i> <span> Home Slider</span></a></li>
            @endrole
            <li class="header">SALES TRACKING SYSTEM (STS)</li>
            <li>
                <a href="{{route('backend.dashboard.sts')}}">
                    <i class="fa fa-dashboard"></i> <span>STS Dashboard</span>
                </a>
            </li>
            @role('superadministrator|administrator')
            <li>
                <a href="{{route('backend.report')}}">
                    <i class="fa fa-dashboard"></i> <span>Report</span>
                </a>
            </li>
            @endrole
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-calendar"></i>
                    <span>Schedule</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('backend.schedule')}}"><i class="fa fa-edit"></i> Today's Task</a></li>
                    <li><a href="{{route('backend.schedule.all')}}"><i class="fa fa-edit"></i> All Task</a></li>
                </ul>
            </li>
            @permission('track-employee-schedules')
            <li><a href="{{route('backend.track-employee')}}"><i class="fa fa-users"></i>
                    <span>Track Employees</span></a></li>
            @endpermission
            @role('superadministrator|administrator')
            <li><a href="{{route('backend.branches')}}"><i class="fa fa-code-fork"></i> <span>Branches</span></a></li>
            <li><a href="{{route('backend.client')}}"><i class="fa fa-users"></i> <span>Clients</span></a></li>
            <li><a href="{{route('backend.response-keyword')}}"><i class="fa fa-microphone"></i>
                    <span>Response Keyword</span></a>
            </li>
            @endrole
            @role('superadministrator|administrator|sales-person')
            <li class="header">SETTINGS</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>User Management</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @permission('create-users|read-users|update-users')
                    <li><a href="{{route("backend.users")}}"><i class="fa fa-users"></i> Manage Users</a></li>
                    @endpermission
                    @permission('create-roles|read-roles|update-roles')
                    <li><a href="{{route("backend.roles")}}"><i class="fa fa-lock"></i>Manage Roles</a>@endpermission
                        @permission('create-permissions')
                    <li><a href="{{route("backend.permissions")}}"><i class="fa fa-lock"></i>Manage Permissions</a>@endpermission
                    </li>
                </ul>
            </li>
            @endrole
            @role('superadministrator|administrator')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bell"></i>
                    <span>Push Notifications</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route("backend.push-notification")}}"><i class="fa fa-paper-plane"></i> Send Push
                            Notification</a></li>
                    <li><a href="{{route("backend.device")}}"><i class="fa fa-mobile"></i> Registered Device</a></li>
                </ul>
            </li>
            @endrole
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>