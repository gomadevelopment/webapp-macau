    @if ($chat->messages->isEmpty())
        <div class="d-flex justify-content-center">
            <div class="chat_no_messages_yet">
                @if(!$chat->is_group)
                    Ainda não falou com {{ $other_user->username }}. Comece já a escrever!
                @else
                    Ainda não foi registada nenhuma conversa neste grupo. Comece por ser você!
                @endif
            </div>
        </div>
        
    @else

        @for ($index = 0; $index < $chat->messages->count(); $index++)

            @if (isset($chat->messages[$index+1]) && $chat->messages[$index]->user_id == $chat->messages[$index+1]->user_id)
                <?php $same_user_message = true; ?>
            @elseif(isset($chat->messages[$index+1]) && $chat->messages[$index]->user_id != $chat->messages[$index+1]->user_id)
                <?php $same_user_message = false; ?>
            @else
                <?php $same_user_message = false; ?>
            @endif

            @if (isset($chat->messages[$index-1]) && $chat->messages[$index]->user_id == $chat->messages[$index-1]->user_id)
                <?php $first_message = false; ?>
            @elseif(isset($chat->messages[$index-1]) && $chat->messages[$index]->user_id != $chat->messages[$index-1]->user_id)
                <?php $first_message = true; ?>
            @else
                <?php $first_message = true; ?>
            @endif

            @if ($chat->messages[$index]->user_id == auth()->user()->id)
                <div class="d-flex justify-content-end 
                {{ $same_user_message ? 'mb-1' : 'mb-4' }}
                ">
                    <div class="msg_cotainer_send 
                    {{ $first_message ? '' : 'border-not-first-message' }}">
                        {!! $chat->messages[$index]->message !!}
                        @if (!$same_user_message)
                            <span class="msg_time_send notification_time_ago">
                                {{ $chat->messages[$index]->created_at->format('d M Y, G:i') }}
                            </span>
                        @endif
                    </div>
                    <div class="img_cont_msg user_info_tooltip">
                        @if (!$same_user_message)
                            <span class="tooltiptext">{{ $chat->messages[$index]->user->username }}</span>
                            <span class="action_menu_btn user_action_menu_btn">
                                <img src="{{ $chat->messages[$index]->user->avatar_url ? '/webapp-macau-storage/avatars/'.$chat->messages[$index]->user->id.'/'.$chat->messages[$index]->user->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                                class="rounded-circle user_img_msg">
                            </span>
                            <div class="action_menu user_action_menu">
                                <ul>
                                    <li>
                                        <a href="/perfil/{{ $chat->messages[$index]->user->id }}">
                                            <i class="fas fa-user-circle"></i>  Ver Perfil
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <div class="d-flex justify-content-start 
                {{ $same_user_message ? 'mb-1' : 'mb-4' }}">
                    <div class="img_cont_msg user_info_tooltip">
                        @if (!$same_user_message)
                            <span class="tooltiptext left">{{ $chat->messages[$index]->user->username }}</span>
                            <span class="action_menu_btn user_action_menu_btn">
                                <img src="{{ $chat->messages[$index]->user->avatar_url ? '/webapp-macau-storage/avatars/'.$chat->messages[$index]->user->id.'/'.$chat->messages[$index]->user->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                                class="rounded-circle user_img_msg">
                            </span>
                            <div class="action_menu user_action_menu left">
                                <ul>
                                    <li>
                                        <a href="/perfil/{{ $chat->messages[$index]->user->id }}">
                                            <i class="fas fa-user-circle"></i>  Ver Perfil
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="msg_cotainer 
                    {{ $first_message ? '' : 'border-not-first-message' }}">
                        {!! $chat->messages[$index]->message !!}
                        @if (!$same_user_message)
                            <span class="msg_time_send notification_time_ago" style="left: 0;">
                                {{ $chat->messages[$index]->created_at->format('d M Y, G:i') }}
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        @endfor

    @endif
    
    @if($other_user)
        @if($other_user->eitherUserBlocked(auth()->user()->id) || auth()->user()->eitherUserBlocked($other_user->id))
            <div class="d-flex justify-content-center">
                <div class="blocked_user_container">
                    Não pode enviar mensagens a este utilizador!
                </div>
            </div>
        @endif
    @endif

    

    {{-- <div class="d-flex justify-content-start mb-4">
        <div class="img_cont_msg">
            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
        </div>
        <div class="msg_cotainer">
            Hi, how are you samim?
            Hi, how are you samim?
            Hi, how are you samim?
            Hi, how are you samim?
            <span class="msg_time notification_time_ago">8:40 AM, Today</span>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-1">
        <div class="msg_cotainer_send">
            Hi Khalid i am good tnx how about you?
        </div>
        <div class="img_cont_msg">
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4">
        <div class="msg_cotainer_send border-not-first-message">
            Hi Khalid i am good tnx how about you?
            <span class="msg_time_send notification_time_ago">8:55 AM, Today</span>
        </div>
        <div class="img_cont_msg">
            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
        </div>
    </div>

    <div class="d-flex justify-content-start mb-4">
        <div class="img_cont_msg">
            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
        </div>
        <div class="msg_cotainer">
            I am good too, thank you for your chat template
            <span class="msg_time notification_time_ago">9:00 AM, Today</span>
        </div>
    </div>
    
    <div class="d-flex justify-content-end mb-4">
        <div class="msg_cotainer_send">
            You are welcome
            <span class="msg_time_send notification_time_ago">9:05 AM, Today</span>
        </div>
        <div class="img_cont_msg">
        <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
        </div>
    </div>

    <div class="d-flex justify-content-start mb-4">
        <div class="img_cont_msg">
            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
        </div>
        <div class="msg_cotainer">
            I am looking for your next templates
            <span class="msg_time notification_time_ago">9:07 AM, Today</span>
        </div>
    </div>

    <div class="d-flex justify-content-end mb-4">
        <div class="msg_cotainer_send">
            Ok, thank you have a good day
            <span class="msg_time_send notification_time_ago">9:10 AM, Today</span>
        </div>
        <div class="img_cont_msg">
            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
        </div>
    </div>

    <div class="d-flex justify-content-start mb-4">
        <div class="img_cont_msg">
            <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
        </div>
        <div class="msg_cotainer">
            Bye, see you
            <span class="msg_time notification_time_ago">9:12 AM, Today</span>
        </div>
    </div> --}}