<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8" />
		<meta name="author" content="www.frebsite.nl" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		
        <title>Web App Macau</title>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{{asset('/assets/css/styles.css', config()->get('app.https')) }}?v=1.5">
        <link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/global_header_footer.css', config()->get('app.https')) }}?v=1.5">
        
		
		<!-- Custom Color Option -->
        <link rel="stylesheet" href="{{asset('/assets/css/colors.css', config()->get('app.https')) }}?v=1.5">

        @yield('header')

        <link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/medias.css', config()->get('app.https')) }}?v=1.5">

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

            @if(Session::get('locale') == 'pt' || !Session::has('locale'))
                <?php $pt_lang = true; ?>
                <input hidden type="text" id="homepage_lang" value="pt_lang">
            @elseif(Session::get('locale') == 'en')
                <?php $en_lang = true; ?>
                <input hidden type="text" id="homepage_lang" value="en_lang">
            @endif

            @include('layouts.top-nav-bar')

            @yield('content')
            
            @include('layouts.footer')

            @if (!auth()->user())

                @include('layouts.login_modal')
                @include('layouts.signup_modal')
                @include('layouts.recover_password_modal')
                
            @endif

            {{-- <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a> --}}

		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->

		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
        <script src="{{asset('/assets/js/jquery.min.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/popper.min.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/bootstrap.min.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/select2.min.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/slick.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/jquery.counterup.min.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/counterup.min.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/jquery.validate.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/custom.js', config()->get('app.https')) }}?v=1.5"></script>

        <script src="{{asset('/assets/js/jquery.timeago.js', config()->get('app.https')) }}?v=1.5"></script>
        <script src="{{asset('/assets/js/jquery.timeago.pt.js', config()->get('app.https')) }}?v=1.5"></script>

        <script src="{{asset('/assets/js/webapp-macau-custom-js/global_header_footer.js', config()->get('app.https')) }}?v=1.5"></script>
		<!-- ============================================================== -->
		<!-- This page plugins -->
        <!-- ============================================================== -->
        
        @if (auth()->user())
            <script>
                $(function(){
                    $("time.timeago").timeago();

                    $('[data-toggle="tooltip"]').tooltip();

                    // Mark shown notifications as read (active = 0) - when bell_icon notifications dropdown is opened
                    function markUserNotsAsRead() {
                        var notifications_ids = JSON.parse($('#unread_user_notifications_ids').val());
                        // console.log(notifications_ids);
                        $.ajax({
                            type: 'GET',
                            url: '/notifications_mark_as_read',
                            data: {notifications_ids:notifications_ids},
                            success: function(response){
                            }
                        });
                    }

                    $(document).on('click', '.user_notifications.dropdown a', markUserNotsAsRead);

                    // Update User Notifications on top-nav-bar dropdown notifications box
                    function updateNotificationsOnScroll(e, show_less = null) {
                        var elem = $(e.currentTarget);
                        if (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight() && !$('#no_more_user_notifications').is(':checked')) {
                            // console.log('ENTROU');
                            var current_unread_limit = $('#unread_user_notifications_count').val();
                            var current_read_limit = $('#read_user_notifications_count').val();
                            $.ajax({
                                type: 'GET',
                                url: '/update_classroom_notifications',
                                data: {current_unread_limit:current_unread_limit, current_read_limit:current_read_limit, show_less: false, nav_bar_notifications: true},
                                success: function(response){
                                    if(response && response.status == 'success'){
                                        
                                        $('#user_notifications_partial').html(response.html);
                                        $('#user_notifications_partial').find('time.timeago').timeago();
                                        $('#user_notifications_partial>div').on('scroll', updateNotificationsOnScroll);
                                        $('.notifications-count').text($('#unread_user_notifications_count').val());
                                        $('.message-box.notifications>div.msg-title>div').text('Notificações ('+ $('#unread_user_notifications_count').val() +')');
                                        if(response.no_more_notifications){
                                            $('#no_more_user_notifications').attr('checked', true);
                                        }
                                        else{
                                            $('#no_more_user_notifications').attr('checked', false);
                                        }
                                        var notifications_ids = JSON.parse($('#unread_user_notifications_ids').val());
                                        // console.log(notifications_ids);
                                        markUserNotsAsRead();
                                    }
                                    else{
                                        $(".errorMsg").text(response.message);
                                        $(".errorMsg").fadeIn();
                                        setTimeout(() => {
                                            $(".errorMsg").fadeOut();
                                        }, 5000);
                                    }
                                }
                            });
                        }
                    }

                    $('.user_notifications .msg-box-content').off('scroll', updateNotificationsOnScroll);
                    $('.user_notifications .msg-box-content').on('scroll', updateNotificationsOnScroll);

                    // Fix select2 option containers
                    $(document).on('click', '.select2', function(){
                        var select2_below_width = $('.select2-dropdown.select2-dropdown--below').outerWidth();
                        var select2_above_width = $('.select2-dropdown.select2-dropdown--above').outerWidth();
                        $('.select2-dropdown.select2-dropdown--below').css('left', '1px');
                        $('.select2-dropdown.select2-dropdown--above').css('left', '1px');
                    });

                    // Top nav bar jquery
                    $('a.view_profile, a.settings, a.logout').mouseover(function(e){
                        if($(this).hasClass('view_profile')){
                            if($('.user_icon_pink').is(':hidden')){
                                $('.user_icon_normal').hide();
                                $('.user_icon_pink').show();
                            }
                        }
                        else if($(this).hasClass('settings')){
                            if($('.settings_icon_pink').is(':hidden')){
                                $('.settings_icon_normal').hide();
                                $('.settings_icon_pink').show();
                            }
                        }
                        else{
                            if($('.logout_icon_pink').is(':hidden')){
                                $('.logout_icon_normal').hide();
                                $('.logout_icon_pink').show();
                            }
                        }
                    });
                    $('a.view_profile, a.settings, a.logout').mouseout(function(e){
                        if($(this).hasClass('view_profile')){
                            $('.user_icon_normal').show();
                            $('.user_icon_pink').hide();
                        }
                        else if($(this).hasClass('settings')){
                            $('.settings_icon_normal').show();
                            $('.settings_icon_pink').hide();
                        }
                        else{
                            $('.logout_icon_normal').show();
                            $('.logout_icon_pink').hide();
                        }
                    });

                });
            </script>
        @endif

        @yield('scripts')

	</body>
</html>