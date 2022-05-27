@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/homepage.css', config()->get('app.https')) }}?v=2.4">

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=2.4">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=2.4">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}?v=2.4">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/users.css', config()->get('app.https')) }}?v=2.4">

<link rel="stylesheet" href="{{asset('/assets/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.css', config()->get('app.https')) }}" id="bscss">

@stop

@section('content')

<div class="alert alert-success successMsg global-alert" style="display:none;" role="alert">

</div>

<div class="alert alert-danger errorMsg global-alert" style="display:none;" role="alert">

</div>

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

<style>
    .sg_rate_title, .exercise_author, .exercise_author strong{
        line-height: 30px !important;
    }
</style>

<section class="page-title classroom">
    <div class="container">
        
        <div class="row mb-5">
            {{-- My Profile --}}
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="wrap mb-3">
                    <h1 class="title">Política de Privacidade</h1>
                </div>
                <div class="shop_grid_caption card-body m-0 p-4">
                    <div class="form-group d-flex flex-wrap justify-content-center m-0">
                        <p class="exercise_author">
                            <strong>
                                Esta Política de Privacidade regula o tratamento dos dados pessoais dos utilizadores (adiante designados por “Utilizador” ou “Utilizadores”) recolhidos, no âmbito da utilização do sítio da Internet Português à Vista com o endereço https://portuguesavista.com/ (doravante designado “Sítio”) pelo proprietário.
                            </strong>
                            <br>
                            <br>
                        </p>
                        
                        <h4 class="sg_rate_title mr-auto">1. Dados pessoais recolhidos</h4>
                        <br>
                        <br>
                        <p class="exercise_author">
                            <strong>
                                1.1 – Entidade responsável pela plataforma, recolha e tratamento dos dados
                            </strong>
                            <br>
                            A Universidade de São José é a entidade responsável pela plataforma Português à Vista, no âmbito da qual serão solicitados dados pessoais dos Utilizadores recolhidos através do Sítio, tratados nos termos ora descritos.
                            <br>
                            <br>

                            <strong>
                                1.2 – Utilização do Sítio.
                            </strong>
                            <br>
                            O acesso ao Sítio não implica a disponibilização de dados pessoais.
                            <br>
                            No entanto, a navegação no Sítio implica a disponibilização de dados pessoais, designadamente aquando do registo na plataforma. Neste caso, é solicitado ao utilizador para a criação da conta:
                            <br>
                            • Nome de utilizador
                            <br>
                            • Endereço eletrónico
                            <br>
                            Estes dados são de fornecimento obrigatório, sob pena de não ser possível fazer o registo e de navegar na plataforma.
                            <br>
                            <br>
                        </p>

                        <h4 class="sg_rate_title mr-auto">2. Utilização dos Dados Pessoais</h4>
                        <br>
                        <br>
                        <p class="exercise_author">

                            Português à Vista não partilha o seu endereço eletrónico com terceiros.
                            <br>
                            Os dados pessoais são utilizados apenas para as finalidades de registo na plataforma ou para dar resposta a algum e-mail enviado pelo Utilizador. 
                            <br>
                            <br>

                        </p>

                        <h4 class="sg_rate_title mr-auto">3. Conservação dos dados pessoais</h4>
                        <br>
                        <br>
                        <p class="exercise_author">

                            Os dados pessoais recolhidos são conservados de forma a permitir a identificação dos seus titulares e para dar resposta a algum pedido de contacto por parte do Utilizador.
                            <br>
                            <br>

                        </p>

                        <h4 class="sg_rate_title mr-auto">4. Informações de contacto</h4>
                        <br>
                        <br>
                        <p class="exercise_author w-100">

                            <strong>Proprietário:</strong>
                            <br>
                            Universidade de São José
                            <br>
                            Estrada Marginal da Ilha Verde, 14-17 Macau, China
                            <br>
                            <br>

                            <strong>E-mail:</strong>
                            <br>
                            <a href="mailto:info@usj.edu.mo" target="_blank">info@usj.edu.m</a>
                            <br>
                            <br>

                            <strong>Telefone:</strong>
                            <br>
                            (853) 8592 5600

                        </p>

                    </div>
                </div>
            </div>
        
    </div>

</section>


@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=2.4"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=2.4"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=2.4"></script>
@stop
