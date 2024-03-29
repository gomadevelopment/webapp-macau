<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="header header-light {{ Request::path('') === '/' || Request::path('') === '/login' || Request::path('') === 'login' ? 'homepage' : '' }} {{ auth()->user() ? 'logged_in' : '' }}">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="/">
                    <img src="{{asset('/assets/landing_page/logo/PortuguêsàVista_Positivo.svg', config()->get('app.https'))}}?v=2.4" class="logo" alt="" />
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    @if(auth()->user())
                        {{-- Professor --}}
                        @if(auth()->user()->isProfessor() && auth()->user()->isActive())
                            <li class="<?php echo !empty($topNavBarOption) && $topNavBarOption == 'exercises' ? 'active' : ''; ?>">
                                <a href="/exercicios">Exercícios</a>
                            </li>
                            <li class="<?php echo !empty($topNavBarOption) && $topNavBarOption == 'questions' ? 'active' : ''; ?>">
                                <a href="/questoes">Questões</a>
                            </li>
                            <li class="<?php echo !empty($topNavBarOption) && $topNavBarOption == 'classroom' ? 'active' : ''; ?>">
                                <a href="/sala_de_aula">Sala de Aula</a>
                            </li>
                            <li class="<?php echo !empty($topNavBarOption) && $topNavBarOption == 'articles' ? 'active' : ''; ?>">
                                <a href="/artigos">Biblioteca</a>
                            </li>
                        
                        {{-- Student --}}
                        @else
                            <li class="<?php echo !empty($topNavBarOption) && $topNavBarOption == 'exercises' ? 'active' : ''; ?>">
                                <a href="/exercicios">Exercícios</a>
                            </li>
                            <li class="<?php echo !empty($topNavBarOption) && $topNavBarOption == 'classroom' ? 'active' : ''; ?>">
                                <a href="/sala_de_aula">Sala de Aula</a>
                            </li>
                            <li class="<?php echo !empty($topNavBarOption) && $topNavBarOption == 'articles' ? 'active' : ''; ?>">
                                <a href="/artigos">Biblioteca</a>
                            </li>
                        @endif
                    {{-- No user logged in --}}
                    @else
                        <li class="active">
                            <a href="/">
                                @if((isset($pt_lang) && $pt_lang) || isset($en_lang) && $en_lang)
                                    Home
                                @else
                                    主頁
                                @endif
                            </a>
                        </li>
                        <li>
                            <a class="homepage-links" data-request-path="{{ Request::path('') }}" href="#sobre">
                                @if(isset($pt_lang) && $pt_lang)
                                    Sobre
                                @elseif(isset($en_lang) && $en_lang)  
                                    About
                                @else
                                    關於
                                @endif 
                            </a>
                        </li>
                        <li>
                            <a class="homepage-links" data-request-path="{{ Request::path('') }}" href="#como_funciona">
                                @if(isset($pt_lang) && $pt_lang)
                                    Como Funciona
                                @elseif(isset($en_lang) && $en_lang)  
                                    How it Works
                                @else
                                    如何操作本平台
                                @endif
                            </a>
                        </li>
                        <li>
                            <a class="homepage-links" data-request-path="{{ Request::path('') }}" href="#contactos">
                                @if(isset($pt_lang) && $pt_lang)
                                    Contactos
                                @elseif(isset($en_lang) && $en_lang)  
                                    Contacts
                                @else
                                    聯絡我們
                                @endif
                            </a>
                        </li>
                    @endif
                    
                </ul>
                
                <ul class="nav-menu nav-menu-social align-to-right">
                    @if(auth()->user())
                        <li class="user_avatar dropdown">
                            <a href="#" class="nav-link messages" data-toggle="dropdown">
                                <span class="ping"></span>
                                {{-- <img src="{{ auth()->user()->avatar_url ? '/webapp-macau-storage/avatars/'.auth()->user()->id.'/'.auth()->user()->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                                class="img-fluid avater" alt=""> --}}
                                <div style="backgroud-size: 100%; background-image: url({{ auth()->user()->avatar_url ? '/webapp-macau-storage/avatars/'.auth()->user()->id.'/'.auth()->user()->avatar_url : 'https://via.placeholder.com/500x500'}})"
                                    class="top_nav_bar_avatar">
                                </div>
                                Olá, {{ auth()->user()->isProfessor() && auth()->user()->isActive() ? 'Professor' : 'Aluno'}}!
                                <span class="dropdown-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu message-box">
                                <a class="msg-title view_profile" href="/perfil/{{auth()->user()->id}}">
                                    <img src="{{asset('/assets/backoffice_assets/icons/USer.svg', config()->get('app.https'))}}?v=2.4" class="logo logout_icon user_icon_normal mb-1 " alt="" style="margin-left: 3px;" />
                                    <img src="{{asset('/assets/backoffice_assets/icons/USer_pink.svg', config()->get('app.https'))}}?v=2.4" class="logo logout_icon user_icon_pink mb-1 " alt="" style="margin-left: 3px; display: none;"/>
                                    Ver Perfil
                                </a>
                                @if(auth()->user()->isAdmin())

                                    <a class="msg-title settings" href="/perfil/editar/{{auth()->user()->id}}?land_on_settings_tab">
                                        <img src="{{asset('/assets/backoffice_assets/icons/cog.svg', config()->get('app.https'))}}?v=2.4" class="logo logout_icon settings_icon_normal mb-1 " alt="" style="margin-right: 8px;" />
                                        <img src="{{asset('/assets/backoffice_assets/icons/cog_pink.svg', config()->get('app.https'))}}?v=2.4" class="logo logout_icon settings_icon_pink mb-1 " alt="" style="margin-right: 8px; display: none;"/>
                                        Definições
                                    </a>

                                    <a class="msg-title irr-actions" href="/acoes-irreversiveis?land_on_tab=professor">
                                        <i class="fa fa-exclamation-triangle" style="width: 22px; margin-right: 7px; text-align: center;"></i>
                                        Ações Irreversíveis
                                    </a>
                                    
                                @endif
                                <a class="msg-title logout" href="/logout">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Logout.svg', config()->get('app.https'))}}?v=2.4" class="logo logout_icon logout_icon_normal mr-2" alt="" style="margin-left: 3px;" />
                                    <img src="{{asset('/assets/backoffice_assets/icons/Logout_pink.svg', config()->get('app.https'))}}?v=2.4" class="logo logout_icon logout_icon_pink mr-2" alt="" style="margin-left: 3px; display: none;"/>
                                    Terminar Sessão
                                </a>
                            </div>
                        </li>
                        <li style="border-left: 2px solid #e6ebf1 !important; height: 23px; margin-top: 30px;"></li>
                        <li class="user_notifications dropdown">
                            <a href="#" class="nav-link messages" data-toggle="dropdown">
                                <span class="ping"></span>
                                <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_pink.svg', config()->get('app.https'))}}?v=2.4" class="logo" alt="" />
                                <span class="dropdown-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu message-box notifications">
                                <div class="msg-title mt-2 pb-3">
                                    <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_black.svg', config()->get('app.https'))}}?v=2.4" class="logo" alt="" style="margin-right: 10px;margin-bottom: 3px;" />
                                    <div class="d-inline-block">
                                        Notificações ({{ $unread_user_notifications->count() }})
                                    </div>
                                </div>

                                <div id="user_notifications_partial">
                                    @include('layouts.notifications-partial')
                                </div>

                            </div>
                            <div class="notifications-count">
                                {{ $unread_user_notifications->count() }}
                            </div>
                        </li>
                    @else
                        <li class="login_click light">
                            <a href="#" data-toggle="modal" data-target="#login">
                                @if(isset($pt_lang) && $pt_lang)
                                    Entrar
                                @elseif(isset($en_lang) && $en_lang)  
                                    Sign In
                                @else
                                    登入
                                @endif
                            </a>
                        </li>
                        <li class="login_click theme-bg">
                            <a href="#" data-toggle="modal" data-target="#signup">
                                @if(isset($pt_lang) && $pt_lang)
                                    Inscrever
                                @elseif(isset($en_lang) && $en_lang)  
                                    Sign Up
                                @else
                                    註冊
                                @endif
                            </a>
                        </li>
                    @endif
                    @if(Request::path() === '/' || stristr(Request::path(), 'redefinir_password') !== false)
                        <li class="language_button ml-4 {{ isset($pt_lang) && $pt_lang ? 'active' : '' }}">
                            <a href="/locale/pt">PT</a>
                        </li>
                        <li class="language_slash ml-1">
                            <a href="#" style="padding: 30px 5px;">|</a>
                        </li>
                        {{-- <li class="language_button ml-1 {{ isset($en_lang) && $en_lang ? 'active' : '' }}">
                            <a href="/locale/en">EN</a>
                        </li>
                        <li class="language_slash ml-1">
                            <a href="#" style="padding: 30px 5px;">|</a>
                        </li> --}}
                        <li class="language_button ml-1 {{ isset($cnn_lang) && $cnn_lang ? 'active' : '' }}">
                            <a href="/locale/cnn">CHN</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
