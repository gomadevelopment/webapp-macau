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
    .table tr th, .table tr td{
        border-color: black !important;
    }
</style>

<section class="page-title classroom">
    <div class="container">
        
        <div class="row mb-5">
            {{-- My Profile --}}
            <div class="col-sm-12 col-md-12 col-lg-12" style="min-height: 900px;">
                <div class="wrap mb-3">
                    <h1 class="title">Ficha Técnica</h1>
                </div>
                <div class="shop_grid_caption card-body m-0 p-4">
                    <div class="form-group d-flex flex-wrap justify-content-center m-0">

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <td><p class="exercise_author"><strong>Propriedade</strong></p></td>
                                    <td><p class="exercise_author">Universidade de São José (<a href="https://www.usj.edu.mo/en/" target="_blank">USJ</a>) Estrada Marginal da Ilha Verde, 14-17, Macau,China</p></td>
                                </tr>
                                <tr>
                                    <td><p class="exercise_author"><strong>Entidade Financiadora</strong></p></td>
                                    <td><p class="exercise_author">Fundo do Ensino Superior do Governo de Macau RAE</p></td>
                                </tr>
                                <tr>
                                    <td><p class="exercise_author"><strong>Responsável pelo Projeto</strong></p></td>
                                    <td><p class="exercise_author">João Paulo Pereira</p></td>
                                </tr>
                                <tr>
                                    <td><p class="exercise_author"><strong>Programação e Apoio Técnico</strong></p></td>
                                    <td><p class="exercise_author">Goma Development (<a href="https://gomadevelopment.pt/" target="_blank">GOMA</a>)</p></td>
                                </tr>
                            </tbody>
                            </table>

                            <br>

                            <p class="exercise_author mr-auto"><strong>Exemplo:&nbsp;<a href="http://www.portaldalinguaportuguesa.org/admin.html" target="_blank">Portal da Língua Portuguesa</a></strong></p>
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
