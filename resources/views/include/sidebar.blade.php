<div class="app-sidebar colored">
    <div class="sidebar-header">
        <a class="header-brand" href="{{route('dashboard')}}">
            <div class="logo-img">
                <img height="30" src="{{ asset('img/logo_white.png')}}" class="header-brand-img" title="Ergnation">
            </div>
        </a>
        <div class="sidebar-action"><i class="ik ik-arrow-left-circle"></i></div>
        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
    </div>

    @php
        $segment1 = request()->segment(1);
        $segment2 = request()->segment(2);
    @endphp

    <div class="sidebar-content">
        <div class="nav-container">
            <nav id="main-menu-navigation" class="navigation-main">
                <div class="nav-item {{ ($segment1 == 'dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="ik ik-bar-chart-2"></i><span>{{ __('Dashboard')}}</span></a>
                </div>

                    <div class="nav-item {{ request()->is('profile*') ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-info"></i><span>{{ __('Profile')}}</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('common.profile.index') }}" class="menu-item {{ ($segment1 == 'profile') ? 'active' : '' }}"> {{ __('Profile')}}</a>
                        <!-- only those have manage_user permission will get access
                        @can('manage_user')
                        <a href="{{url('users')}}" class="menu-item {{ ($segment1 == 'users') ? 'active' : '' }}">{{ __('Users')}}</a>
                        <a href="{{url('user/create')}}" class="menu-item {{ ($segment1 == 'user' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add User')}}</a>
                        @endcan
                        only those have manage_role permission will get access
                         @can('manage_roles')
                        <a href="{{url('roles')}}" class="menu-item {{ ($segment1 == 'roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                        @endcan
                        only those have manage_permission permission will get access
                        @can('manage_permission')
                        <a href="{{url('permission')}}" class="menu-item {{ ($segment1 == 'permission') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        <a href="{{url('teams')}}" class="menu-item {{ ($segment1 == 'teams') ? 'active' : '' }}">{{ __('Teams')}}</a>
                        <a href="{{url('teams/create')}}" class="menu-item {{ ($segment1 == 'newteam' && $segment2 == 'create') ? 'active' : '' }}">{{ __('Add Team')}}</a>
                        @endcan-->
                    </div>
                </div>
                @if(auth()->user()->hasRole('Super Admin'))
                    <div class="nav-item {{ request()->is('user*') ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-users"></i><span>{{ __('User')}}</span></a>
                        <div class="submenu-content">
                            <a href="{{url('users')}}" class="menu-item {{ request()->is('users') ? 'active' : '' }}">{{ __('Users')}}</a>
                            <a href="{{url('user/create')}}" class="menu-item {{ request()->is('user/create') ? 'active' : '' }}">{{ __('Add User')}}</a>
                        </div>
                    </div>
                @endif
                @if(auth()->user()->hasRole('Super Admin'))
                    <div class="nav-item {{ request()->is('role*') ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-user-check"></i><span>{{ __('Role & Permission')}}</span></a>
                        <div class="submenu-content">
                            <a href="{{url('roles')}}"  class="menu-item {{ request()->is('roles') ? 'active' : '' }}">{{ __('Roles')}}</a>
                            <a href="{{url('permission')}}" class="menu-item {{ request()->is('permission') ? 'active' : '' }}">{{ __('Permission')}}</a>
                        </div>
                    </div>
                @endif
                @if(auth()->user()->hasRole('Super Admin'))
                    <div class="nav-item {{ request()->is('team*') ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-list"></i><span>{{ __('Team')}}</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('teams.index')}}" class="menu-item {{ request()->is('teams') ? 'active' : '' }}">{{ __('Teams')}}</a>
                            <a href="{{ route('teams.create')}}" class="menu-item {{ request()->is('teams/create') ? 'active' : '' }}">{{ __('Add Team')}}</a>
                            <a href="{{url('teamlist')}}" class="menu-item {{ ($segment1 == 'teamlist') ? 'active' : '' }}"> {{ __('All User with Team')}}</a>
                            <a href="{{url('teamlistfliter')}}" class="menu-item {{ ($segment1 == 'teamlistfliter') ? 'active' : '' }}"> {{ __('List of Team with Athetlic')}}</a>
                        </div>
                    </div>
                @endif
                @if(auth()->user()->hasRole('Business Owner'))
                    <div class="nav-item {{ request()->is('team*') ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-list"></i><span>{{ __('Team')}}</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('teams.index')}}" class="menu-item {{ request()->is('teams') ? 'active' : '' }}">{{ __('Teams')}}</a>
                            <a href="{{ route('teams.create')}}" class="menu-item {{ request()->is('teams/create') ? 'active' : '' }}">{{ __('Add Team')}}</a>
                        </div>
                    </div>
                @endif
                @if(auth()->user()->hasRole('Athlete'))
                    <div class="nav-item {{ request()->is('team*') ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-list"></i><span>{{ __('Team')}}</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('teams.index')}}" class="menu-item {{ request()->is('teams') ? 'active' : '' }}">{{ __('Teams')}}</a>

                        </div>
                    </div>
                @endif
                @if(auth()->user()->hasRole(['Super Admin','Business Owner','Individuals']))
                    <div class="nav-item {{ request()->is('league*') ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-align-justify"></i><span>{{ __('Leagues Management')}}</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('league.index') }}" class="menu-item {{ request()->is('league') ? 'active' : '' }}"> {{ __('Leagues')}}</a>
                            <a href="{{ route('league.create') }}" class="menu-item {{ request()->is('league/create') ? 'active' : '' }}"> {{ __('Add League')}}</a>


                             @if(auth()->user()->hasRole(['Individuals']))
                                <a href="{{ route('leagues.myleagues') }}" class="menu-item {{ request()->is('all/leagues') ? 'active' : '' }}"> {{ __('My Leagues')}}</a>

                                <a href="{{ route('leagues.open') }}" class="menu-item {{ request()->is('open/leagues') ? 'active' : '' }}"> {{ __('Open Leagues')}}</a>

                                <a href="{{ route('leagues.myregistered') }}" class="menu-item {{ request()->is('my-registered-leagues') ? 'active' : '' }}"> {{ __('My Registered Leagues')}}</a>

                             @endif

                        </div>
                    </div>
                @endif

                @if(auth()->user()->hasRole(['Athlete']))
                    <div class="nav-item {{ request()->is('league*') || request()->is('athlete/my-leagues*') ? 'active open' : '' }} has-sub">
                        <a href="#"><i class="ik ik-align-justify"></i><span>{{ __('Leagues')}}</span></a>
                        <div class="submenu-content">
                            <a href="{{ route('league.index') }}" class="menu-item {{ request()->is('league') ? 'active' : '' }}"> {{ __('Leagues')}}</a>
                            <a href="{{ route('athlete.my-leagues') }}" class="menu-item {{ request()->is('athlete/my-leagues') ? 'active' : '' }}"> {{ __('My Leagues')}}</a>
                        </div>
                    </div>
                @endif




                @can('manage_permission')
            @endcan
        </div>
    </div>
</div>
