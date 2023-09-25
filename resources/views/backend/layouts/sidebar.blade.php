<div class="sidebar-menu">
    <ul class="menu">
        
        <li
            class="sidebar-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class='sidebar-link'>
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
        </li>
        
        <li
            class="sidebar-item {{ request()->routeIs('admin-user.*') ? 'active' : '' }}">
            <a href="{{ route('admin-user.index') }}" class='sidebar-link'>
                <i class="fas fa-users-cog"></i>
                <span>Admin Users</span>
            </a>
        </li> 

        <li
            class="sidebar-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <a href="{{ route('users.index') }}" class='sidebar-link'>
                <i class="far fa-user"></i>
                <span>Users</span>
            </a>
        </li> 

    </ul>
</div>