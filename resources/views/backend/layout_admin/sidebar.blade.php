<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <img src="/backend/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a href="{{ route('admin.dashboard') }}" class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                @can('list department')
                    <li class="nav-item">
                        <a href="{{ route('department.index') }}">
                            <i class="fas fa-desktop"></i>
                            <p>Department</p>
                            <span class="badge badge-success">4</span>
                        </a>
                    </li>
                @endcan
                @can('list user')
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}">
                            <i class="fas fa-desktop"></i>
                            <p>User</p>
                        </a>
                    </li>
                @endcan
                @can('list customer')
                    <li class="nav-item">
                        <a href="{{ route('customer.index') }}">
                            <i class="fas fa-desktop"></i>
                            <p>Customer</p>
                        </a>
                    </li>
                @endcan
                @can('list supportrequest')
                    <li class="nav-item">
                        <a href="{{ route('support-request.index') }}">
                            <i class="fas fa-desktop"></i>
                            <p>Support request</p>
                        </a>
                    </li>
                @endcan
                @can('list role')
                    <li class="nav-item">
                        <a href="{{ route('role.index') }}">
                            <i class="fas fa-desktop"></i>
                            <p>Role</p>
                        </a>
                    </li>
                @endcan
                @can('list permission')
                    <li class="nav-item">
                        <a href="{{ route('permission.index') }}">
                            <i class="fas fa-desktop"></i>
                            <p>Permission</p>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
