<!-- resources/views/layouts/sidebar.blade.php -->
<div class="bg-light p-3">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                Users
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->is('roles*') ? 'active' : '' }}" href="{{ route('roles.index') }}">
                Roles
            </a>
        </li>
    </ul>
</div>
