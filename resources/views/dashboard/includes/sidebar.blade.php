<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::user()->present()->avatar }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->present()->nameOrEmail }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> @lang('app.online')</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="{{ Ekko::isActiveRoute('dashboard') }}">
                <a href="{{ route('dashboard') }}">
                    <i class="fa fa-dashboard fa-fw"></i> <span>@lang('app.dashboard')</span>
                </a>
            </li>
            <li class="{{ Ekko::isActiveRoute('dashboard') }}">
                <a href="{{ route('channel.index') }}">
                    <i class="fa fa-dashboard fa-fw"></i> <span>Channel</span>
                </a>
            </li>
            @if(isset($channel) && $channel != NULL)
            <li class="{{ Ekko::isActiveRoute('dashboard') }}">
                <a href="{{ route('channel.event.index') }}">
                    <i class="fa fa-dashboard fa-fw"></i> <span>Event</span>
                </a>
            </li>
            <li class="{{ Ekko::isActiveRoute('dashboard') }}">
                <a href="{{ route('channel.product.index') }}">
                    <i class="fa fa-dashboard fa-fw"></i> <span>Products</span>
                </a>
            </li>
            <li class="{{ Ekko::isActiveRoute('dashboard') }}">
                <a href="{{ route('channel.schedule.index') }}">
                    <i class="fa fa-dashboard fa-fw"></i> <span>Live Schedule</span>
                </a>
            </li>
            @endif
            @permission('users.manage')
                <li class="{{ Ekko::isActiveRoute('user.list') }}">
                    <a href="{{ route('user.list') }}">
                        <i class="fa fa-users fa-fw"></i> <span>@lang('app.users')</span>
                    </a>
                </li>
            @endpermission

            @permission('users.activity')
                <li class="{{ Ekko::isActiveRoute('activity.index') }}">
                    <a href="{{ route('activity.index') }}">
                        <i class="fa fa-list-alt fa-fw"></i> <span>@lang('app.activity_log')</span>
                    </a>
                </li>
            @endpermission

            @permission(['roles.manage', 'permissions.manage'])
                <li class="{{ Ekko::areActiveRoutes(['role.index', 'dashboard.permission.index']) }} treeview">
                    <a href="#">
                        <i class="fa fa-user fa-fw"></i>
                        <span>@lang('app.roles_and_permissions')</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        @permission('roles.manage')
                            <li class="{{ Ekko::isActiveRoute('role.index') }}">
                                <a href="{{ route('role.index') }}">
                                    <i class="fa fa-circle-o"></i>
                                    @lang('app.roles')
                                </a>
                            </li>
                        @endpermission
                        @permission('permissions.manage')
                            <li class="{{ Ekko::isActiveRoute('dashboard.permission.index') }}">
                                <a href="{{ route('dashboard.permission.index') }}">
                                   <i class="fa fa-circle-o"></i>
                                   @lang('app.permissions')</a>
                            </li>
                        @endpermission
                    </ul>
                </li>
            @endpermission

            @role('Admin')
            <li class="{{ Ekko::isActiveRoute('category.list') }}">
                <a href="{{ route('category.list') }}">
                    <i class="fa fa-users fa-fw"></i> <span>Categories management</span>
                </a>
            </li>
            <li class="{{ Ekko::isActiveRoute('channel.list') }}">
                <a href="{{ route('adminchannel.channel.list') }}">
                    <i class="fa fa-users fa-fw"></i> <span>Channels management</span>
                </a>
            </li>
            <li class="{{ Ekko::isActiveMatch('log-viewer') }} treeview">
                <a href="#">
                	<i class="fa fa-file-text-o fa-fw"></i>
                    <span>Log Viewer</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Ekko::isActiveRoute('log-viewer::dashboard') }}">
                        <a href="{!! url('dashboard/log-viewer') !!}">Dashboard</a>
                    </li>
                    <li class="{{ Ekko::isActiveRoute('log-viewer::logs.list') }}">
                        <a href="{!! url('dashboard/log-viewer/logs') !!}">Logs</a>
                    </li>
                </ul>
            </li>
            @endrole

            @permission(['settings.general', 'settings.auth', 'settings.notifications'])
            <li class="{{ Ekko::areActiveRoutes(['settings.general', 'settings.auth', 'settings.notifications']) }} treeview">
                <a href="#">
                    <i class="fa fa-gear fa-fw"></i>
                    <span>@lang('app.settings')</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    @permission('settings.general')
                        <li class="{{ Ekko::isActiveRoute('settings.general') }}">
                            <a href="{{ route('settings.general') }}">
                               <i class="fa fa-circle-o"></i>
                                @lang('app.general')
                            </a>
                        </li>
                    @endpermission
                    @permission('settings.auth')
                        <li class="{{ Ekko::isActiveRoute('settings.auth') }}">
                            <a href="{{ route('settings.auth') }}">
                               <i class="fa fa-circle-o"></i>
                                @lang('app.auth_and_registration')
                            </a>
                        </li>
                    @endpermission
                    @permission('settings.notifications')
                        <li class="{{ Ekko::isActiveRoute('settings.notifications') }}">
                            <a href="{{ route('settings.notifications') }}">
                               <i class="fa fa-circle-o"></i>
                                @lang('app.notifications')
                            </a>
                        </li>
                    @endpermission
                </ul>
            </li>
            @endpermission

        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>