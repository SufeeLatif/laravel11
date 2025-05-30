		<!-- Title -->
		<title>@yield('title', 'Admitro - Laravel 11')</title>

		<!--Favicon -->
		<link rel="icon" href="{{ asset('assets/images/brand/favicon.ico')}}" type="image/x-icon"/>

		<!--Bootstrap css -->
		<link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

		<!-- Style css -->
		<link href="{{ asset('assets/css/style.css')}}" rel="stylesheet" />

		@if(Auth::check() && Auth::user()->theme == 1)
		

		@else

		<link href="{{ asset('assets/css/dark.css')}}" rel="stylesheet" />

		@endif

		<link href="{{ asset('assets/css/skin-modes.css')}}" rel="stylesheet" />

		<!-- Animate css -->
		<link href="{{ asset('assets/css/animated.css')}}" rel="stylesheet" />

		<!--Sidemenu css -->
       <link href="{{ asset('assets/css/sidemenu.css')}}" rel="stylesheet">

		<!-- P-scroll bar css-->
		<link href="{{ asset('assets/plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />

		<!---Icons css-->
		<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet" />
		@yield('css')
	
		<!-- Simplebar css -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}">

	    <!-- Color Skin css -->
		<link id="theme" href="{{ asset('assets/colors/color1.css')}}" rel="stylesheet" type="text/css"/>

	