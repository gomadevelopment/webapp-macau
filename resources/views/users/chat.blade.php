@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=2.0">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=2.0">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}?v=2.0">

@stop

@section('content')

<!-- ============================ Page Title Start================================== -->
<section class="page-title articles">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="wrap">
                    <h1 class="title">Chat</h1>
                </div>
                
                <div class="exercise_time wrap float-right create_class_button">
                    <a href="#" data-toggle="modal" data-target="#chat_new_message_modal" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Nova Mensagem
                    </a>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ============================ Page Title End ================================== -->	

<!-- ============================ Find Courses with Sidebar ================================== -->
<?php $other_user = null; ?>
<?php $users_are_blocked = false; ?>

@if(isset($chat->id) && $chat)

    @if(!$chat->is_group)
        @if (auth()->user()->id == $chat->user_2->id)
            <?php $other_user = $chat->user_1; ?>
        @else
            <?php $other_user = $chat->user_2; ?>
        @endif

        @if($other_user->eitherUserBlocked(auth()->user()->id) || auth()->user()->eitherUserBlocked($other_user->id))
            <?php $users_are_blocked = true; ?>
        @endif
    @endif

@endif

<section class="pt-0 classroom">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <input type="text" placeholder="Pesquisar..." id="filter_chat_users" name="filter_chat_users" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>

                    {{-- Users partial --}}
                    <div class="card-body contacts_body">
                        @include('users.chat-partials.chat-users', [
                            'users_with_chats' => $users_with_chats,
                            'group_chats' => $group_chats])
                    </div>
                    
                </div>
            </div>

            <div class="preloader ajax chat col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2"><span></span><span></span></div>

            <div class="col-md-8 col-xl-9 chat" id="chat_body">
                <div class="alert alert-success successMsg global-alert" style="display:none;" role="alert">

                </div>

                <div class="alert alert-danger errorMsg global-alert" style="display:none;" role="alert">

                </div>
                @if(isset($chat->id) && $chat)
                    <div class="card">
                        <div class="card-header msg_head">
                            <div class="d-flex bd-highlight align-items-center">
                                <div class="img_cont">
                                    @if (!$chat->is_group)
                                        <img src="{{ $other_user->avatar_url ? '/webapp-macau-storage/avatars/'.$other_user->id.'/'.$other_user->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                                        class="rounded-circle user_img">
                                    @else
                                        @foreach ($chat->users as $user)
                                            @if($loop->index == 3)
                                                @break
                                            @endif
                                            <img src="{{ $user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                                            class="rounded-circle user_img {{ $loop->first ? 'group_white_border_first' : 'group_white_border' }} index_{{ $loop->index }}"
                                            >
                                        @endforeach
                                        @if($chat->users->count() > 3)
                                            <div class="chat_more_users_circle rounded-circle">
                                                <span>
                                                    +{{ $chat->users->count() - 3 }}
                                                </span>
                                            </div>
                                        @endif
                                    @endif
                                    
                                    {{-- <span class="online_icon"></span> --}}
                                </div>
                                <div class="user_info {{ $chat->is_group ? 'users_group' : '' }} {{ $chat->is_group && $chat->users->count() > 3 ? 'more_than_3' : '' }}">
                                    @if (!$chat->is_group)
                                        <span class="colleagues_name {{ $users_are_blocked ? 'current_chat_user' : '' }}">{{ $other_user->username }}</span>
                                    @else
                                        <?php $tooltip_title = ''; ?>
                                        @foreach ($chat->users as $user)
                                            @if(!$loop->last)
                                                @if($loop->first)
                                                    <?php $tooltip_title .= $user->username . ' *<br>'; ?>
                                                @else
                                                    <?php $tooltip_title .= $user->username . '<br>'; ?>
                                                @endif
                                            @else
                                                <?php $tooltip_title .= $user->username . '<br>*(Administrador)'; ?>
                                            @endif
                                        @endforeach
                                        <span class="colleagues_name current_chat_user" 
                                            data-toggle="tooltip" 
                                            data-html="true"
                                            title="{{ $tooltip_title }}">
                                            @foreach ($chat->users as $user)
                                                @if($loop->index == 3)
                                                    ...
                                                    @break
                                                @endif
                                                @if($user->first_name && $user->last_name)
                                                    {{ substr($user->first_name, 0, 1) . '. ' . substr($user->last_name, 0, 1) . '.' }}{{ $loop->index < 2 || !$loop->last ? ',' : '' }}
                                                @else
                                                    {{ $user->username }} {{ $loop->index < 2 || !$loop->last ? ',' : '' }}
                                                @endif
                                                
                                            @endforeach
                                        </span>
                                        <p class="notification_time_ago m-0">Chat constituído por {{ $chat->users->count() }} utilizadores.</p>
                                    @endif
                                    @if ($users_are_blocked)
                                        <p class="notification_time_ago m-0">Utilizador bloqueado</p>
                                    @endif
                                </div>
                            </div>

                            @if (!$chat->is_group)
                                <span class="action_menu_btn">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Dots.svg')}}" class="empty_dots d-block" alt="">
                                    <img src="{{asset('/assets/backoffice_assets/icons/dots_filled.svg')}}" class="filled_dots" alt="" style="display: none;">
                                </span>
                                <div class="action_menu">
                                    <ul>
                                        <li>
                                            <a href="/perfil/{{ $other_user->id }}">
                                                <i class="fas fa-user-circle"></i>  Ver Perfil
                                            </a>
                                        </li>
                                        <li>
                                            <a href="/block_user/{{ $other_user->id }}">
                                                <i class="fas fa-ban"></i>
                                            @if($users_are_blocked)
                                                Desbloquear
                                            @else
                                                Bloquear
                                            @endif
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @elseif($chat->is_group && $chat->chat_user_is_admin(auth()->user()->id))
                                <span class="action_menu_btn">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Dots.svg')}}" class="empty_dots d-block" alt="">
                                    <img src="{{asset('/assets/backoffice_assets/icons/dots_filled.svg')}}" class="filled_dots" alt="" style="display: none;">
                                </span>
                                <div class="action_menu">
                                    <ul>
                                        <li>
                                            <a href="#" id="delete_group_chat" data-group-chat-id="{{ $chat->id }}">
                                                <i class="fas fa-trash"></i>  Apagar Chat de Grupo
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                        </div>

                        {{-- Chat body partial --}}
                        <div class="card-body msg_card_body pt-4">
                            @include('users.chat-partials.chat-body', ['chat' => $chat, 'other_user' => $other_user])
                        </div>

                        <div class="card-footer">
                            <form id="chat_message_form" class="" method="POST" autocomplete="off">
                                @csrf
                                <div class="input-group">
                                    {{-- <div class="input-group-append">
                                        <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                    </div> --}}
                                    <input type="hidden" name="chat_id" id="hidden_chat_id" value="{{ $chat->id }}">
                                    {{-- <input type="hidden" name="user_1_id" id="hidden_user_1_id" value="{{ isset($chat->user_1_id) ? $chat->user_1_id : null }}">
                                    <input type="hidden" name="user_2_id" id="hidden_user_2_id" value="{{ isset($chat->user_2_id) ? $chat->user_2_id : null }}"> --}}
                                    <input type="hidden" name="user_sender_id" id="hidden_user_sender_id" value="{{ auth()->user()->id }}">
                                    <input name="message" id="chat_input_message" class="form-control type_msg" placeholder="Escreve a tua mensagem…" 
                                    {{ $users_are_blocked ? 'disabled' : '' }}/>
                                    <div class="input-group-append">
                                        <span class="input-group-text {{ $users_are_blocked ? '' : 'send_btn' }}"><i class="fas fa-location-arrow"></i></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="shop_grid">
                                <div class="shop_grid_caption">
                                    <h4 class="sg_rate_title" style="font-size: 20px;">
                                        Não tem nenhum chat ativo. Seleccione ou crie já um novo chat!
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="new_message_clone" hidden>
        <div class="d-flex justify-content-end mb-4">
            <div class="msg_cotainer_send">
                {{-- New Message HERE --}}
                <span class="msg_time_send notification_time_ago">
                    Agora mesmo
                </span>
            </div>
            <div class="img_cont_msg">
                <img src="{{ auth()->user()->avatar_url ? '/webapp-macau-storage/avatars/'.auth()->user()->id.'/'.auth()->user()->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                class="rounded-circle user_img_msg">
            </div>
        </div>
    </div>

</section>

{{-- New Message partial --}}
@include('users.chat-partials.new-chat-modal', ['users_without_chats' => $users_without_chats])

<!-- ============================ Find Courses with Sidebar End ================================== -->

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=2.0"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=2.0"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=2.0"></script>

    <script>

        $(function() {

            var chat_id = $('#hidden_chat_id').val();

            $('body').addClass('chat_body');

            // Force chat to scroll down
            function scrollMessageBodyDown(){
                var msgCardBody = $('.msg_card_body');
                if(msgCardBody.length > 0){
                    $(msgCardBody).scrollTop($(msgCardBody)[0].scrollHeight);
                }
            }
            scrollMessageBodyDown();

            $('#select_users_for_new_chat').select2({
                placeholder: 'Pesquisar...',
                templateResult: formatState,
                templateSelection: formatState
            });

            function formatState (opt) {
                if (!opt.id) {
                    return opt.text;
                } 
                var optimage = $(opt.element).attr('data-image'); 
                if(!optimage){
                    return opt.text;
                }
                else {                    
                    var $opt = $(
                    '<span><img class="rounded-circle user_img mr-2" src="' + optimage + '" /> ' + opt.text + '</span>'
                    );
                    return $opt;
                }
            };

            $(document).on('click', '.action_menu_btn',function(){
                $(this).next('.action_menu').toggle();
                if($(this).hasClass('user_action_menu_btn')){
                    if($(this).next('.action_menu').hasClass('d-block')){
                        $(this).next('.action_menu').removeClass('d-block');
                    }
                    else{
                        $(this).next('.action_menu').addClass('d-block');
                    }
                }
            });

            function changeDotsIcons(selector){
                if(!$(selector).parent().hasClass('show')){
                    $(selector).find('img.filled_dots').addClass('d-block');
                    $(selector).find('img.empty_dots').removeClass('d-block').hide();
                }
            }

            $('.action_menu_btn').on('click', function(){
                $('.action_menu_btn').find('img.filled_dots').removeClass('d-block').hide();
                $('.action_menu_btn').find('img.empty_dots').addClass('d-block');
                changeDotsIcons(this);
            });

            $('html, body').on('click', function(e){
                if (!$(e.target).hasClass('empty_dots') || $(e.target).hasClass('colleagues_options')) {
                    $('.action_menu_btn').find('img.filled_dots').removeClass('d-block').hide();
                    $('.action_menu_btn').find('img.empty_dots').addClass('d-block');
                    $('.action_menu').hide();
                }
                if(!$(e.target).hasClass('user_img_msg')){
                    $('.action_menu.user_action_menu.d-block').each(function(index, element){
                        $(element).removeClass('d-block');
                    });
                }
                // console.log($(e.target).attr('class'));
                // $('.action_menu.user_action_menu.d-block').each(function(index, element){
                //     $(element).removeClass('d-block');
                // });
            });

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('input[name="_token"]').attr("value")
                }
            });

            function sendMessage(){
                var message = $('#chat_input_message').val();

                if(message){
                    var form_array = $("#chat_message_form").serialize();
                    pasteNewMessage(message);
                    $('#chat_input_message').val('');
                    $.ajax({
                        type: "POST",
                        url: '/chat/message',
                        data: form_array,
                        success: function(response) {
                            if(response && response.status == 'success'){

                                // $(".successMsg").text(response.message);
                                // $(".successMsg").fadeIn();
                                // setTimeout(() => {
                                //     $(".successMsg").fadeOut();
                                // }, 5000);
                                
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

            function getMessages(){
                $.ajax({
                    type: "GET",
                    url: '/chat/messages/' + chat_id,
                    success: function(response) {
                        if(response && response.status == 'success'){
                            $(".msg_card_body").html(response.html);
                            // scrollMessageBodyDown();
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

            function pasteNewMessage(new_message){
                var last_message = $('.msg_card_body').children().last();
                var html = $('.new_message_clone').children().clone();

                // Previous message - same user
                if(last_message.hasClass('justify-content-end')){
                    last_message.removeClass('mb-4').addClass('mb-1');
                    last_message.find('.msg_time_send').remove();
                    last_message.find('.img_cont_msg').empty();

                    html.find('.msg_cotainer_send').addClass('border-not-first-message');
                    html.find('.msg_cotainer_send .msg_time_send').before(new_message);
                }
                // First message ever (Ainda não falou com AdrianoStudent. Comece já a escrever!) - removal
                else if(last_message.hasClass('justify-content-center')){
                    html.find('.msg_cotainer_send .msg_time_send').before(new_message);
                    $(last_message).after(html);
                    last_message.remove();
                    return false;
                }
                // Previous message - other user
                else{
                    html.find('.msg_cotainer_send .msg_time_send').before(new_message);
                }

                $(last_message).after(html);
                scrollMessageBodyDown();
            }

            $(document).on('click', 'span.send_btn', function(e){
                sendMessage();
            });

            $('#chat_input_message').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    $('span.send_btn').click();
                    return false;  
                }
            });

            // New Message - individual AND group
            $(document).on('click', '.write_new_message_to', function(e){
                e.preventDefault();
                var user_ids_for_new_chat = $('#select_users_for_new_chat').val();

                // Individual Chat
                if(user_ids_for_new_chat.length == 1){
                    window.location = '/chat/' + user_ids_for_new_chat[0];
                }
                // Group Chat
                else if(user_ids_for_new_chat.length > 1){
                    $.ajax({
                        type: 'GET',
                        url: '/chat_de_grupo',
                        data: {group_chat_user_ids: user_ids_for_new_chat},
                        success: function(response){
                            if(response && response.status == 'success'){
                                window.location = '/chat_de_grupo/' + response.chat_id;
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
            });

            // Filter Chat Users
            $(document).on('click', '.search_btn', function(e){
                var search_username = $('#filter_chat_users').val();
                $.ajax({
                    type: 'GET',
                    url: '/chat_search_users',
                    data: {search_username: search_username},
                    success: function(response) {
                        if(response && response.status == 'success'){
                            $(".contacts_body").html(response.html);
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
            });

            $('#filter_chat_users').keypress(function (e) {
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    $('.search_btn').click();
                    return false;  
                }
            });

            $('#filter_chat_users').keyup(function (e) {
                var search_username = $('#filter_chat_users').val();
                var data;
                if(chat_id){
                    data = {
                        search_username: search_username,
                        chat_id: chat_id
                    };
                }
                else{
                    data = {
                        search_username: search_username
                    };
                }
                if(search_username.length == 0 || search_username.length > 2){
                    $.ajax({
                        type: 'GET',
                        url: '/chat_search_users',
                        data: data,
                        success: function(response) {
                            if(response && response.status == 'success'){
                                $(".contacts_body").html(response.html);
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
                
            });

            // Delete Group Chat
            $(document).on('click', '#delete_group_chat', function(e){
                e.preventDefault();
                var group_chat_id = $(this).attr('data-group-chat-id');

                $("#chat_body").hide();
                $('.preloader.ajax.chat')
                    .css('height', $("#chat_body").height())
                    .show();

                $.ajax({
                    type: 'GET',
                    url: '/delete_group_chat',
                    data: {group_chat_id: group_chat_id},
                    success: function(response) {
                        if(response && response.status == 'success'){
                            window.location.href = '/chat';
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
            });


            // Update message every 15 seconds
            setInterval(() => {
                if(chat_id){
                    getMessages();
                }
            }, 15000);

        });

    </script>

@stop