<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div class="header header-light">
    <div class="container">
        <nav id="navigation" class="navigation navigation-landscape">
            <div class="nav-header">
                <a class="nav-brand" href="/">
                    <img src="{{asset('/assets/landing_page/logo/PortuguêsàVista_Positivo.svg')}}" class="logo" alt="" />
                </a>
                <div class="nav-toggle"></div>
            </div>
            <div class="nav-menus-wrapper" style="transition-property: none;">
                <ul class="nav-menu">
                    @if(auth()->user())
                        {{-- Professor --}}
                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                            <li class=""><a href="/exercicios">Exercícios</a></li>
                            <li><a href="/questoes">Questões</a></li>
                            <li><a href="/sala_de_aula">Sala de Aula</a></li>
                            <li><a href="/artigos">Artigos</a></li>
                        
                        {{-- Student --}}
                        @else
                            <li class=""><a href="/exercicios">Exercícios</a></li>
                            <li><a href="/questoes">Questões</a></li>
                            <li><a href="/sala_de_aula">Sala de Aula</a></li>
                            <li><a href="/artigos">Artigos</a></li>
                        @endif
                    {{-- No user logged in --}}
                    @else
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="#sobre">Sobre</a></li>
                        <li><a href="#como_funciona">Como Funciona</a></li>
                        <li><a href="#contactos">Contactos</a></li>
                    @endif
                    
                </ul>
                
                <ul class="nav-menu nav-menu-social align-to-right">
                    @if(auth()->user())
                        <li class="user_avatar dropdown">
                            <a href="#" class="nav-link messages" data-toggle="dropdown">
                                <span class="ping"></span>
                                <img src="https://via.placeholder.com/500x500" class="img-fluid avater" alt="">
                                Olá, {{ auth()->user()->role == 1 || auth()->user()->role == 2 ? 'Professor' : 'Aluno'}}!
                                <span class="dropdown-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu message-box">
                                <a class="msg-title" href="#">
                                    <img src="{{asset('/assets/backoffice_assets/icons/USer.svg')}}" class="logo logout_icon" alt="" />
                                    Ver Perfil
                                </a>
                                <a class="msg-title" href="/logout">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Logout.svg')}}" class="logo logout_icon" alt="" />
                                    Terminar Sessão
                                </a>
                            </div>
                        </li>
                        <li style="border-left: 2px solid #e6ebf1 !important; height: 23px; margin-top: 30px;"></li>
                        <li class="user_notifications dropdown">
                            <a href="#" class="nav-link messages" data-toggle="dropdown">
                                <span class="ping"></span>
                                <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_pink.svg')}}" class="logo" alt="" />
                                <span class="dropdown-menu-arrow"></span>
                            </a>
                            <div class="dropdown-menu message-box notifications">
                                <div class="msg-title">
                                    <img src="{{asset('/assets/backoffice_assets/icons/bell_icon_black.svg')}}" class="logo" alt="" style="margin-right: 10px;" />
                                    Notificações (1)
                                </div>

                                <div class="msg-box-content">
                                    <!-- Message Block -->
                                    <a href="#">
                                        O Aluno Luis Silva aguarda a avaliação do Exercício “De Áustria para Portugal”.
                                        <p class="time float-right">Há 24 minutos</p>
                                    </a>
                                </div>
                            </div>
                            <div class="notifications-count">
                                1
                            </div>
                        </li>
                    @else
                        <li class="login_click light">
                            <a href="#" data-toggle="modal" data-target="#login">Entrar</a>
                        </li>
                        <li class="login_click theme-bg">
                            <a href="#" data-toggle="modal" data-target="#signup">Inscrever</a>
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