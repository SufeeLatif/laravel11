<aside class="app-sidebar">
    <div class="app-sidebar__logo">
        <a class="header-brand" href="{{ Route('Dashboard') }}">
            <img src="{{ asset('assets/images/brand/logo.png') }}" class="header-brand-img desktop-lgo"
                alt="Admintro logo">
            <img src="{{ asset('assets/images/brand/logo1.png') }}" class="header-brand-img dark-logo"
                alt="Admintro logo">
            <img src="{{ asset('assets/images/brand/favicon.png') }}" class="header-brand-img mobile-logo"
                alt="Admintro logo">
            <img src="{{ asset('assets/images/brand/favicon1.png') }}" class="header-brand-img darkmobile-logo"
                alt="Admintro logo">
        </a>
    </div>
    <div class="app-sidebar__user">
        <div class="dropdown user-pro-body text-center">
            <div class="user-pic">


                <img src="{{ asset(Auth::check() && Auth::user()->image && file_exists(public_path('uploads/profile_img/' . Auth::user()->image)) ? 'uploads/profile_img/' . Auth::user()->image : 'assets/images/users/2.jpg') }}"
                    alt="user-img" class="avatar-xl rounded-circle mb-1">





            </div>
            <div class="user-info">
                <h5 class=" mb-1">
                    @if (session()->has('first_name') && session()->has('last_name'))
                        {{ session('first_name') }} {{ session('last_name') }}
                    @elseif(Auth::check())
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    @else
                        Guest
                    @endif <i class="ion-checkmark-circled  text-success fs-12"></i>
                </h5>
                <span class="text-muted app-sidebar__user-name text-sm">

                    @if(Auth::check())
                        <p>Session ID: {{ str_pad(Auth::user()->id, 5, '0', STR_PAD_LEFT) }}</p>
                    @else
                        <p>Session ID: 0000000</p>
                    @endif



                </span>
            </div>
        </div>
    </div>
    <ul class="side-menu app-sidebar3">

        <li class="slide">
            <a class="side-menu__item" href="{{ route('Dashboard') }}">
                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                    width="24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                </svg>
                <span class="side-menu__label">Dashboard</span>
            </a>
        </li>

        @if (Session::has('userAccessArr.userList') && Session::get('userAccessArr.userList') == 1)
            <li class="slide">
                <a class="side-menu__item" href="{{ route('userList') }}">
                    <svg class="side-menu__icon custom-icon" xmlns="http://www.w3.org/2000/svg" height="24" width="24"
                        viewBox="0 0 24 24" fill="currentColor">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2c-3.3 0-9.9 1.7-9.9 5v2h19.8v-2c0-3.3-6.6-5-9.9-5z" />
                    </svg>
                    <span class="side-menu__label">Users</span>
                </a>
            </li>
        @endif


        
        


        {{-- @if (Session::has('userAccessArr.userRoleList') && Session::get('userAccessArr')['userRoleList'] == 1)
            <li class="slide">
                <a class="side-menu__item" href="{{ route('userRole') }}">

                    <svg class="side-menu__icon custom-icon" xmlns="http://www.w3.org/2000/svg" height="24"
                        viewBox="0 0 24 24" width="24">
                        <path d="M0 0h24v24H0V0z" fill="none" />
                        <path
                            d="M19 5v2h-4V5h4M9 5v6H5V5h4m10 8v6h-4v-6h4M9 17v2H5v-2h4M21 3h-8v6h8V3zM11 3H3v10h8V3zm10 8h-8v10h8V11zm-10 4H3v6h8v-6z" />
                    </svg>


                    <span class="side-menu__label">User Roles</span>
                </a>
            </li>
        @endif --}}



        <li class="slide">
            <a class="side-menu__item" href="{{ route('logout') }}">

                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                    width="24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path d="M13 3h-2v10h2V3zm-2 14h2v-2h-2v2zM5 13h4v-2H5V9L1 12l4 3v-2zm14 0h-4v2h4v2l4-3-4-3v2z" />
                </svg>

                <span class="side-menu__label">Logout</span>
            </a>
        </li>
        <li class="slide">
            <a class="side-menu__item" href="{{ route('cacheClear') }}">

                <svg class="side-menu__icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24"
                    width="24">
                    <path d="M0 0h24v24H0V0z" fill="none" />
                    <path
                        d="M12 4V1L8 5l4 4V6c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6h-2c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z" />
                </svg>

                <span class="side-menu__label">Cache Clear</span>
            </a>
        </li>

    </ul>
</aside>
<!--aside closed-->