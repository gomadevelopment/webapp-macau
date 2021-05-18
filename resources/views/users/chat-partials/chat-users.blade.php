
    <ui class="contacts">
        <span class="colleagues_name ml-2">Utilizadores</span>
        @foreach ($users_with_chats as $user)
            <li class="{{ isset($other_user) && $other_user && $other_user->id == $user->id ? 'chat_active' : '' }}">
                <a href="/chat/{{ $user->id }}">
                    <div class="d-flex bd-highlight align-items-center">
                        <div class="img_cont">
                            <img src="{{ $user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                            class="rounded-circle user_img">
                            {{-- <span class="online_icon"></span> --}}
                        </div>
                        <div class="user_info">
                            <span class="colleagues_name">{{ $user->username }}</span>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
        
        <span class="colleagues_name ml-2">Grupos</span>
        @foreach ($group_chats as $group_chat)
            <?php $tooltip_title = ''; ?>
            @foreach ($group_chat->users as $user)
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
            <li class="{{ isset($chat->id) && $chat->id == $group_chat->id ? 'chat_active' : '' }}"
                data-toggle="tooltip" 
                data-html="true"
                title="{{ $tooltip_title }}">
                <a href="/chat_de_grupo/{{ $group_chat->id }}">
                    <div class="d-flex bd-highlight align-items-center">
                        <div class="img_cont">
                            @foreach ($group_chat->users as $user)
                                @if($loop->index == 3)
                                    @break
                                @endif
                                <img src="{{ $user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                                class="rounded-circle user_img {{ $loop->first ? 'group_white_border_first' : 'group_white_border' }} index_{{ $loop->index }}"
                                >
                            @endforeach
                            @if($group_chat->users->count() > 3)
                                <div class="chat_more_users_circle rounded-circle">
                                    <span>
                                        +{{ $group_chat->users->count() - 3 }}
                                    </span>
                                </div>
                            @endif
                            {{-- <img src="{{ $group_chat->user_1->avatar_url ? '/webapp-macau-storage/avatars/'.$group_chat->user_1->id.'/'.$group_chat->user_1->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                            class="rounded-circle user_img"> --}}
                            {{-- <span class="online_icon"></span> --}}
                        </div>
                        <div class="user_info users_group {{ $group_chat->users->count() > 3 ? 'more_than_3' : '' }}">
                            <span class="colleagues_name">
                                @foreach ($group_chat->users as $user)
                                    @if($user->first_name && $user->last_name)
                                        {{ substr($user->first_name, 0, 1) . '. ' . substr($user->last_name, 0, 1) . '.' }}{{ !$loop->last ? ',' : '' }}
                                    @else
                                        {{ $user->username }} {{ !$loop->last ? ',' : '' }}
                                    @endif
                                @endforeach
                            </span>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach
    {{-- <li class="chat_active">
        <div class="d-flex bd-highlight align-items-center">
            <div class="img_cont">
                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
                <span class="online_icon"></span>
            </div>
            <div class="user_info">
                <span class="colleagues_name">Miguel Rodrigues</span>
            </div>
        </div>
    </li>
    <li>
        <div class="d-flex bd-highlight align-items-center">
            <div class="img_cont">
                <img src="https://2.bp.blogspot.com/-8ytYF7cfPkQ/WkPe1-rtrcI/AAAAAAAAGqU/FGfTDVgkcIwmOTtjLka51vineFBExJuSACLcBGAs/s320/31.jpg" class="rounded-circle user_img">
                <span class="online_icon offline"></span>
            </div>
            <div class="user_info">
                <span class="colleagues_name">Luis Marques</span>
            </div>
        </div>
    </li>
    <li>
        <div class="d-flex bd-highlight align-items-center">
            <div class="img_cont">
                <img src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg" class="rounded-circle user_img">
                <span class="online_icon"></span>
            </div>
            <div class="user_info">
                <span class="colleagues_name">Luísa Nunes</span>
            </div>
        </div>
    </li>
    <li>
        <div class="d-flex bd-highlight align-items-center">
            <div class="img_cont">
                <img src="https://i.pinimg.com/originals/ac/b9/90/acb990190ca1ddbb9b20db303375bb58.jpg" class="rounded-circle user_img">
                <span class="online_icon offline"></span>
            </div>
            <div class="user_info">
                <span class="colleagues_name">Rui Carapinha</span>
            </div>
        </div>
    </li>
    <li>
        <div class="d-flex bd-highlight align-items-center">
            <div class="img_cont">
                <img src="https://static.turbosquid.com/Preview/001214/650/2V/boy-cartoon-3D-model_D.jpg" class="rounded-circle user_img">
                <span class="online_icon offline"></span>
            </div>
            <div class="user_info">
                <span class="colleagues_name">Maria Ribeiro</span>
            </div>
        </div>
    </li> --}}
    </ui>