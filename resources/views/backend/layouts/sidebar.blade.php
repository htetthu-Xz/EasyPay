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
                <span>Admin User</span>
            </a>
        </li> 
    </ul>
</div>