<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="www.frebsite.nl" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
        <title>Web App Macau</title>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{asset('/assets/css/styles.css', config()->get('app.https')) }}">
        <link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom.css', config()->get('app.https')) }}">
		
		<!-- Custom Color Option -->
        <link rel="stylesheet" href="{{asset('/assets/css/colors.css', config()->get('app.https')) }}">

        {{-- Font --}}
        <link rel="stylesheet" href="https://cdn.rawgit.com/mfd/09b70eb47474836f25a21660282ce0fd/raw/e06a670afcb2b861ed2ac4a1ef752d062ef6b46b/Gilroy.css">

        @yield('header')

    </head>
	
    <body class="red-skin">
	
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div id="preloader"><div class="preloader"><span></span><span></span></div></div>
		
		
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper">
            @if(auth()->user())
                @include('layouts.top-nav-bar-backoffice')
            @else
                @include('layouts.top-nav-bar')
            @endif

            @yield('content')
            
            @include('layouts.footer')

            @include('layouts.login_modal')
            @include('layouts.signup_modal')

            <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
        <script src="{{asset('/assets/js/jquery.min.js', config()->get('app.https'))}}"></script>
        <script src="{{asset('/assets/js/popper.min.js', config()->get('app.https'))}}"></script>
        <script src="{{asset('/assets/js/bootstrap.min.js', config()->get('app.https'))}}"></script>
        <script src="{{asset('/assets/js/select2.min.js', config()->get('app.https'))}}"></script>
        <script src="{{asset('/assets/js/slick.js', config()->get('app.https'))}}"></script>
        <script src="{{asset('/assets/js/jquery.counterup.min.js', config()->get('app.https'))}}"></script>
        <script src="{{asset('/assets/js/counterup.min.js', config()->get('app.https'))}}"></script>
        <script src="{{asset('/assets/js/custom.js', config()->get('app.https'))}}"></script>

        <script src="{{asset('/assets/js/webapp-macau-custom.js', config()->get('app.https'))}}"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
		<!-- ============================================================== -->

        @yield('scripts')

	</body>
</html>