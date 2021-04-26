@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/homepage.css', config()->get('app.https')) }}?v=1.2">

@stop

@section('content')
<!-- ============================ Hero ================================== -->
@if (session('success'))
    <div class="global-alert alert alert-success" role="alert">
        {{session('success')}}
    </div>
@endif
@if (session('error'))
    <div class="global-alert alert alert-danger" role="alert">
        {{session('error')}}
    </div>
@endif
@if(Session::get('locale') == 'pt' || !Session::has('locale'))
    <?php $pt_lang = true; ?>
@elseif(Session::get('locale') == 'en')
    <?php $en_lang = true; ?>
@endif

<div class="image-cover hero_banner hero-inner-2 shadow rlt" data-overlay="7">
    <div class="container">

                <div class="hero-caption small_wd mb-5">
                    <img class="university_logo d-block mb-3" src="{{asset('/assets/landing_page/illustrations/logomacau_Positivo.svg')}}" alt="">
                    <h1 class="big-header-capt cl_2 mb-0">
                        @if(isset($pt_lang) && $pt_lang)
                            Aprenda&nbsp;
                        @elseif(isset($en_lang) && $en_lang)
                            Learn&nbsp;
                        @endif
                    </h1>
                    <h1 class="big-header-capt-pink cl_2 mb-0">
                        @if(isset($pt_lang) && $pt_lang)
                            Português&nbsp;
                        @elseif(isset($en_lang) && $en_lang)
                            Portuguese&nbsp;
                        @endif
                    </h1> 
                    <h1 class="big-header-capt cl_2 mb-0">
                        @if(isset($pt_lang) && $pt_lang)
                            de forma prática e inovadora.
                        @elseif(isset($en_lang) && $en_lang)
                            in a practical and<br>innovative way.
                        @endif
                    </h1>
                    <p style="margin-left: 0;">
                        @if(isset($pt_lang) && $pt_lang)
                            Plataforma de aprendizagem para alunos e professores com propostas 
                            de actividades para desenvolver a compreensão do oral em Português Língua 
                            Não Materna.
                        @elseif(isset($en_lang) && $en_lang)
                            Learning platform for students and teachers with activity proposals to 
                            develop the understanding of oral Portuguese Language
                            Not Maternal.
                        @endif
                    </p>

                    <button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#signup">
                        {{ isset($pt_lang) && $pt_lang ? 'Inscrever-me' : 'Sign Up' }} &nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow.svg')}}" alt="" style="margin-bottom: 2px;">
                    </button>
                </div>
                <img class="scene1_svg" src="{{asset('/assets/landing_page/illustrations/Hero_Image.svg')}}" alt="">
    </div>
</div>

<!-- ============================ About Section ================================== -->
<section class="about_section p-0" id="sobre">
    <div class="container">
        <h1 class="title">{{ isset($pt_lang) && $pt_lang ? 'Sobre' : 'About' }}</h1>
        <h1 class="sub_title">
            @if(isset($pt_lang) && $pt_lang)
                Uma plataforma a pensar em todos os que ensinam e aprendem o Português como Língua Não Materna.
            @elseif(isset($en_lang) && $en_lang)
                A platform for everyone who teaches and learns Portuguese as a Non-Native Language.
            @endif
        </h1>
        <p class="description">
            @if(isset($pt_lang) && $pt_lang)
                ‘Português à Vista’ é uma plataforma de e-learning que tem por objetivo apoiar o ensino e a aprendizagem do Português Língua Não Materna em Macau (PLNM). A partir de um conjunto  vasto de recursos audiovisuais, devidamente selecionados e organizados por níveis de proficiência linguística (do A1 a C1) e temas, foram criados exercícios interativos especificamente desenhados para o desenvolvimento da comprensão do oraldo PLNM. “Português à Vista” promove a autonomia da aprendizagem, tal como a interação social e a colaboração, tirando   partido das ferramentas digitais criadas para esse fim. É ainda disponibilizada, a pensar nos  professores, asistematização da exploração didática da maioria dos recursos audiovisuais que se encontram na plataforma.
            @elseif(isset($en_lang) && $en_lang)
                ‘Português à Vista’ is an e-learning platform that aims to support the teaching and learning of Portuguese as a Non-Native Language in Macau (PNNL). From a vast set of audiovisual resources, duly selected and organized by levels of linguistic proficiency (from A1 to C1) and themes, interactive exercises were created specifically designed to develop PNLL oral comprehension. “Português à Vista” promotes learning autonomy, as well as social interaction and collaboration, taking advantage of the digital tools created for this purpose. It is also available, thinking about teachers, the systematization of the didactic exploration of most audiovisual resources that are on the platform.
            @endif
        </p>
        <div class="signup_button">
            <button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#signup">
                {{ isset($pt_lang) && $pt_lang ? 'Inscrever-me' : 'Sign Up' }} &nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow-pink.svg')}}" alt="" style="margin-bottom: 2px;">
            </button>
        </div>
            
    </div>
</section>

<!-- ============================ How it works Section ================================== -->
<section class="how_it_works_section" id="como_funciona">
    <div class="container">

        <h1 class="title">{{ isset($pt_lang) && $pt_lang ? 'Como funciona' : 'How it Works' }}</h1>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7">
                <img class="scene2_svg" src="{{asset('/assets/landing_page/illustrations/HowitWorks.svg')}}" alt="">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-5">
                <div class="hero-caption small_wd mb-5">
                    <h1 class="big-header-capt cl_2 mb-0" style="font-size: 37px !important;">
                        @if(isset($pt_lang) && $pt_lang)
                            Procura um sítio para ouvir e aprender Português?
                        @elseif(isset($en_lang) && $en_lang)
                            Looking for a place to listen and learn Portuguese?
                        @endif
                    </h1>
                    <h1 class="big-header-capt cl_2 mb-0 p-0" style="font-size: 30px !important;">
                        @if(isset($pt_lang) && $pt_lang)
                            Aqui encontra:
                        @elseif(isset($en_lang) && $en_lang)
                            Here you can find:
                        @endif
                    </h1>
                    <div style="display: inline-flex; align-items: center; margin-bottom: -20px;">
                        <div style="width: 30px; text-align: center;" class="desktop_icon_div">
                            <img src="{{asset('/assets/landing_page/icons/Desktop.svg')}}" alt="">
                        </div>
                        <p>
                            @if(isset($pt_lang) && $pt_lang)
                                Recursos audiovisuais autênticos, como material  informativo  
                                (TV)  e videoclipes, com legendas  e organizados  por  níveis 
                                (A1  a  C1) e por temas.
                            @elseif(isset($en_lang) && $en_lang)
                                Authentic audiovisual resources, such as information material
                                (TV) and video clips, with subtitles and organized by levels
                                (A1 to C1) and by themes.
                            @endif
                        </p>
                    </div>
                    <div style="display: inline-flex; align-items: center; margin-bottom: -20px;">
                        <div style="width: 35px; text-align: center;">
                            <img src="{{asset('/assets/landing_page/icons/Contents.svg')}}" alt="">
                        </div>
                        <p>
                            @if(isset($pt_lang) && $pt_lang)
                                Conteúdos representativos dos países e regiões onde se fala o Português.
                            @elseif(isset($en_lang) && $en_lang)
                                Representative content of the countries and regions where the Portuguese language is spoken.
                            @endif
                        </p>
                    </div>
                    <div style="display: inline-flex; align-items: center; margin-bottom: -20px;">
                        <div style="width: 36px; text-align: center;">
                            <img src="{{asset('/assets/landing_page/icons/Badge.svg')}}" alt="">
                        </div>
                        <p>
                            @if(isset($pt_lang) && $pt_lang)
                                Centenas de propostas de atividades interativas para desenvolver a compreensão do oral.
                            @elseif(isset($en_lang) && $en_lang)
                                Hundreds of proposals for interactive activities to develop oral understanding.
                            @endif
                        </p>
                    </div>
                    <div style="display: inline-flex; align-items: center; margin-bottom: -20px;">
                        <div style="width: 36px; text-align: center;">
                            <img src="{{asset('/assets/landing_page/icons/Pencil.svg')}}" alt="">
                        </div>
                        <p>
                            @if(isset($pt_lang) && $pt_lang)
                                Possibilidade de criar os seus próprios exercícios para treinar a compreensão do oral.
                            @elseif(isset($en_lang) && $en_lang)
                                Possibility to create your own exercises to train listening comprehension.          
                            @endif
                        </p>
                    </div>
                    <div style="display: inline-flex; align-items: center; margin-bottom: 30px;">
                        <div style="width: 36px; text-align: center;">
                            <img src="{{asset('/assets/landing_page/icons/Comment.svg')}}" alt="">
                        </div>
                        <p>
                            @if(isset($pt_lang) && $pt_lang)
                                Questionários de auto-reflexão para desenvolver as estratégias 
                                de aprendizagem da compreensão do oral, de acordo com as abordagens didáticas atuais.
                            @elseif(isset($en_lang) && $en_lang)
                                Self-reflection questionnaires to develop strategies of learning 
                                to understand oral language, according to current teaching 
                                approaches.        
                            @endif
                        </p>
                    </div>
                    
                    <button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#signup" style="display: block;">
                        {{ isset($pt_lang) && $pt_lang ? 'Inscrever-me' : 'Sign Up' }} &nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow.svg')}}" alt="" style="margin-bottom: 2px;">
                    </button>
                </div>
            </div>
            
        </div>
        
    </div>
</section>

<!-- ============================ Contacts Section ================================== -->
<section class="contacts_section about_section p-0" id="contactos">
    <div class="container">
        <h1 class="title">{{ isset($pt_lang) && $pt_lang ? 'Contactos' : 'Contacts' }}</h1>
        <p class="small_text">4967 Sardis Sta, Victoria 8007,  Macau.</p>
        <p class="small_text">+1 246-345-0695</p>
        <p class="small_text">info@ptavista.com</p>
        <h1 class="sub_title">
            @if(isset($pt_lang) && $pt_lang)
                Junta-te a milhares de Utilizadores felizes!
            @elseif(isset($en_lang) && $en_lang)
                Join thousands of happy Users!
            @endif
        </h1>
        <p class="small_text">
            @if(isset($pt_lang) && $pt_lang)
                Inscreve-te agora e começa a aprender uma das Linguas mais faladas por todo o Mundo!
            @elseif(isset($en_lang) && $en_lang)
                Sign up now and start learning one of the most spoken languages ​​around the world!
            @endif
        </p>
        <div class="signup_button">
            <button class="btn btn-theme btn-lg" data-toggle="modal" data-target="#signup">
                {{ isset($pt_lang) && $pt_lang ? 'Inscrever-me' : 'Sign Up' }} &nbsp; <img src="{{asset('/assets/landing_page/icons/Arrow-pink.svg')}}" alt="" style="margin-bottom: 2px;">
            </button>
        </div>
            
    </div>
</section>

@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=1.2"></script>

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
    @if (session('recover_password_error'))
        <script type="text/javascript">
            $(function() {
                $('#recover_password').modal('show');
            });
        </script>
    @endif

@stop