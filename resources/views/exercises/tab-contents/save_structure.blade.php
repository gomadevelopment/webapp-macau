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
<div class="alert alert-success successMsg" style="display:none;" role="alert">

</div>

<div class="alert alert-danger errorMsg" style="display:none;" role="alert">

</div>

<h1 class="structure_title">Pré-Escuta / Visionamento</h1>
{{-- CREATED CARDS --}}
@foreach ($exercise->questions as $question)
    @if($question->section == "Pré-Escuta")
        <div class="row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card-body">
                    <div class="form-group">
                        <label class="label_title mb-4 d-block">
                            Pré-Escuta: {{ $question->title }}</label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_level m-0"><strong>Tipo:</strong> {{ $question->question_type->name }}</p>
                            <p class="exercise_level m-0"><strong>Referência:</strong> {{ $question->reference }}</p>
                        </div>
                        <div class="d-block float-right mt-3">
                            <form method="GET" action="/exercicios/{{ $exercise->id }}/questao/editar/{{ $question->id }}" class="" style="display: contents;">
                                <button class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Editar
                                </button>
                                <input type="text" name="exercise_question_section" id="exercise_question_section" value="Pré-Escuta" hidden>
                            </form>
                            <a href="#" class="btn btn-theme remove_button delete_question_button" data-id="{{$question->id}}" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                Remover
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
{{-- ADD NEW QUESTIONS --}}
<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body text-center">
            <form action=""></form>
            <form method="GET" action="{{ '/exercicios/' . $exercise->id . '/questao/criar' }}" class="add_question_form">
                <button type="submit" class="btn search-btn comment_submit m-3" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px;">
                    Adicionar</button>
                <input type="text" name="exercise_question_section" id="exercise_question_section" value="Pré-Escuta" hidden>
            </form>
        </div>
    </div>
</div>

<h1 class="structure_title">À Escuta / Visionamento</h1>
{{-- CREATED CARDS --}}
@foreach ($exercise->questions as $question)
    @if($question->section == "À Escuta")
        <div class="row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card-body">
                    <div class="form-group">
                        <label class="label_title mb-4 d-block">
                            À Escuta: {{ $question->title }}</label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_level m-0"><strong>Tipo:</strong> {{ $question->question_type->name }}</p>
                            <p class="exercise_level m-0"><strong>Referência:</strong> {{ $question->reference }}</p>
                        </div>
                        <div class="d-block float-right mt-3">
                            <form method="GET" action="/exercicios/{{ $exercise->id }}/questao/editar/{{ $question->id }}" class="" style="display: contents;">
                                <button class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Editar
                                </button>
                                <input type="text" name="exercise_question_section" id="exercise_question_section" value="À Escuta" hidden>
                            </form>
                            <a href="#" class="btn btn-theme remove_button delete_question_button" data-id="{{$question->id}}" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                Remover
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
{{-- ADD NEW QUESTIONS --}}
<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body text-center">
            <form method="GET" action="{{ '/exercicios/' . $exercise->id . '/questao/criar' }}" class="add_question_form">
                <button type="submit" class="btn search-btn comment_submit m-3" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px;">
                    Adicionar</button>
                <input type="text" name="exercise_question_section" id="exercise_question_section" value="À Escuta" hidden>
            </form>
        </div>
    </div>
</div>

<h1 class="structure_title">Oficina da Escuta</h1>
{{-- CREATED CARDS --}}
@foreach ($exercise->questions as $question)
    @if($question->section == "Oficina da Escuta")
        <div class="row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card-body">
                    <div class="form-group">
                        <label class="label_title mb-4 d-block">
                            Oficina da Escuta: {{ $question->title }}</label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_level m-0"><strong>Tipo:</strong> {{ $question->question_type->name }}</p>
                            <p class="exercise_level m-0"><strong>Referência:</strong> {{ $question->reference }}</p>
                        </div>
                        <div class="d-block float-right mt-3">
                            <form method="GET" action="/exercicios/{{ $exercise->id }}/questao/editar/{{ $question->id }}" class="" style="display: contents;">
                                <button class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Editar
                                </button>
                                <input type="text" name="exercise_question_section" id="exercise_question_section" value="Oficina da Escuta" hidden>
                            </form>
                            <a href="#" class="btn btn-theme remove_button delete_question_button" data-id="{{$question->id}}" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                Remover
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
{{-- ADD NEW QUESTIONS --}}
<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body text-center">
            <form method="GET" action="{{ '/exercicios/' . $exercise->id . '/questao/criar' }}" class="add_question_form">
                <button type="submit" class="btn search-btn comment_submit m-3" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px;">
                    Adicionar</button>
                <input type="text" name="exercise_question_section" id="exercise_question_section" value="Oficina da Escuta" hidden>
            </form>
        </div>
    </div>
</div>

<h1 class="structure_title">Pós-Escuta</h1>
{{-- CREATED CARDS --}}
@foreach ($exercise->questions as $question)
    @if($question->section == "Pós-Escuta")
        <div class="row mb-5">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="card-body">
                    <div class="form-group">
                        <label class="label_title mb-4 d-block">
                            Pós-Escuta: {{ $question->title }}</label>
                        <div class="d-flex float-left flex-column">
                            <p class="exercise_level m-0"><strong>Tipo:</strong> {{ $question->question_type->name }}</p>
                            <p class="exercise_level m-0"><strong>Referência:</strong> {{ $question->reference }}</p>
                            {{-- <p class="exercise_level m-0"><strong>Autor:</strong> Professor João Paulo</p> --}}
                        </div>
                        <div class="d-block float-right mt-3">
                            {{-- <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Editar
                            </a> --}}
                            <form method="GET" action="/exercicios/{{ $exercise->id }}/questao/editar/{{ $question->id }}" class="" style="display: contents;">
                                <button class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Pencil.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Editar
                                </button>
                                <input type="text" name="exercise_question_section" id="exercise_question_section" value="Pós-Escuta" hidden>
                            </form>
                            <a href="#" class="btn btn-theme remove_button delete_question_button" data-id="{{$question->id}}" style="float: none; padding: 14px 20px; margin-left: 15px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 5px;">
                                Remover
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endforeach
{{-- ADD NEW QUESTIONS --}}
<div class="row mb-5">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="card-body text-center">
            <form method="GET" action="{{ '/exercicios/' . $exercise->id . '/questao/criar' }}" class="add_question_form">
                <button type="submit" class="btn search-btn comment_submit m-3" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px;">
                    Adicionar</button>
                <input type="text" name="exercise_question_section" id="exercise_question_section" value="Pós-Escuta" hidden>
            </form>
        </div>
    </div>
</div>

<div class="text-right mt-4">
    <form method="POST" action="/exercicios/editar/{{ $exercise->id }}">
        @csrf
        <input type="hidden" name="from_structure_tab" value="true">
        <input id="publish_exam" class="checkbox-custom" name="publish_exam" type="checkbox" {{ $exercise->published == 1 ? 'checked' : '' }} {{ $exercise->questions()->count() ? '' : 'disabled' }}>
        <label for="publish_exam" class="checkbox-custom-label publish_exam-label d-inline-block mb-3">Publicar Sequência? (Ativo/Desativo)</label>
        <button type="submit" class="btn search-btn comment_submit ml-3 mb-3" style="float: none;">
            Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;"></button>
    </form>
</div>