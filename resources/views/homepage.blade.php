@extends('layouts.default')

@section('header')

@stop

@section('content')
<!-- ============================ Hero ================================== -->
<div class="image-cover hero_banner hero-inner-2 shadow rlt" data-overlay="7">
    <div class="container">

                <div class="hero-caption small_wd mb-5">
                    <h1 class="big-header-capt cl_2 mb-0">Aprendizagem de </h1>
                    <h1 class="big-header-capt-pink cl_2 mb-0">Português&nbsp;</h1> 
                    <h1 class="big-header-capt cl_2 mb-0">fácil e prática.</h1>
                    <p style="margin-left: 0;">Plataforma moderna criada especificamente para professores e alunos.
                        Aprenda Português de forma moderna, prática e fácil.</p>

                    <button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#signup">
                        Inscrever &nbsp; <object class="" data="{{asset('/assets/landing_page/icons/Arrow.svg')}}" type="image/svg+xml"></object>
                    </button>
                </div>
                <img class="scene1_svg" src="{{asset('/assets/landing_page/illustrations/Scene1.svg')}}" alt="">
                {{-- <object class="scene1_svg" data="{{asset('/assets/landing_page/illustrations/Scene1.svg')}}" type="image/svg+xml"></object> --}}
        
    </div>
</div>

<!-- ============================ About Section ================================== -->
<section class="about_section p-0">
    <div class="container">
        <h1 class="title">Sobre</h1>
        <h1 class="sub_title">A Lingua Portuguesa simplificada, com ajuda de Instrutores Profissionais.</h1>
        <p class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc in sem justo. Etiam ut ante ac sem malesuada sodales. Phasellus iaculis porttitor dui blandit egestas. Nulla eget lacinia nibh. Mauris rhoncus dolor tortor, a tristique purus ultricies at. Nunc at mi diam. Nunc nunc metus, lacinia et nisl ac, fringilla elementum ex. Fusce ut odio vel dolor rutrum suscipit et at ante. Aliquam in sem diam. Phasellus ut nunc eget nisl facilisis convallis ullamcorper nec mauris. Maecenas nec nibh orci. Ut eros sem, commodo sit amet risus a, efficitur dignissim purus. Nullam eu cursus dolor, vel ultricies elit. Duis eu mollis nunc. Etiam nec facilisis dui, eget egestas enim. Pellentesque pretium varius massa, nec mattis diam pellentesque quis.</p>
        <div class="signup_button">
            <button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#signup">
                Inscrever-me &nbsp;&nbsp;&nbsp; <object class="" data="{{asset('/assets/landing_page/icons/Arrow-pink.svg')}}" type="image/svg+xml"></object>
            </button>
        </div>
            
    </div>
</section>

<!-- ============================ How it works Section ================================== -->
<section class="how_it_works_section">
    <div class="container">

        <h1 class="title">Como funciona</h1>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7">
                <img class="scene2_svg" src="{{asset('/assets/landing_page/illustrations/Scene2.svg')}}" alt="">
                {{-- <object class="scene2_svg" data="{{asset('/assets/landing_page/illustrations/Scene2.svg')}}" type="image/svg+xml"></object> --}}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
                <div class="hero-caption small_wd mb-5">
                    <h1 class="big-header-capt cl_2 mb-0">Reading for hours? Way better than that.</h1>
                    <div style="display: inline-flex; align-items: center; margin-bottom: -20px;">
                        <div style="width: 30px; text-align: center;">
                            <img src="{{asset('/assets/landing_page/icons/Desktop.svg')}}" alt="">
                        </div>
                        <p>Easily access to all the content you need from our WebApp.</p>
                    </div>
                    <div style="display: inline-flex; align-items: center; margin-bottom: -20px;">
                        <div style="width: 40px; text-align: center;">
                            <img src="{{asset('/assets/landing_page/icons/Comment.svg')}}" alt="">
                        </div>
                        <p>Make contact with other Students and Teachers all around the World so you don't fall into error by mispelling.</p>
                    </div>
                    <div style="display: inline-flex; align-items: center; margin-bottom: 30px;">
                        <div style="width: 40px; text-align: center;">
                            <img src="{{asset('/assets/landing_page/icons/Badge.svg')}}" alt="">
                        </div>
                        <p>Get your Portuguese well learned to earn an Official Portuguese Certificate gaven by your Teacher.</p>
                    </div>

                    <button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#signup" style="display: block;">
                        Inscrever &nbsp; <object class="" data="{{asset('/assets/landing_page/icons/Arrow.svg')}}" type="image/svg+xml"></object>
                    </button>
                </div>
            </div>
            
        </div>
        
    </div>
</section>

<!-- ============================ Contacts Section ================================== -->
<section class="contacts_section about_section p-0">
    <div class="container">
        <h1 class="title">Contactos</h1>
        <p class="small_text">4967 Sardis Sta, Victoria 8007,  Macau.</p>
        <p class="small_text">+1 246-345-0695</p>
        <p class="small_text">info@escola.com</p>
        <h1 class="sub_title">Junta-te a milhares de Utilizadores felizes!</h1>
        <p class="small_text">Inscreve-te agora e começa a aprender uma das Linguas mais faladas por todo o Mundo!</p>
        <p class="small_text">*Alunos de Nacionalidade Chinesa sujeitos a Pagamento.</p>
        <div class="signup_button">
            <button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#signup">
                Inscrever-me &nbsp;&nbsp;&nbsp; <object class="" data="{{asset('/assets/landing_page/icons/Arrow-pink.svg')}}" type="image/svg+xml"></object>
            </button>
        </div>
            
    </div>
</section>

@stop

@section('scripts')
    @if (session('login_error'))
        <script type="text/javascript">
            $(function() {
                $('#login').modal('show');
            });
        </script>
    @endif
    @if (session('signup_error'))
        <script type="text/javascript">
            $(function() {
                $('#signup').modal('show');
            });
        </script>
    @endif
@stop