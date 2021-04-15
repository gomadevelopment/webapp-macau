<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Texto Introdutório <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" 
                    title="Breve resumo apresentado como descrição do Exercício, tanto na lista de Exercícios como na introdução de cada Exercício individual." 
                    alt="" style="margin-left: 5px;"></label>
                <textarea class="form-control" name="introduction" id="introduction" cols="30" rows="4" placeholder="" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>{{ old('introduction', $exercise->introduction) }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Enunciado <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" 
                    title="Enunciado Geral do Exercício." 
                    alt="" style="margin-left: 5px;"></label>
                <textarea class="form-control" name="statement" id="statement" cols="30" rows="4" placeholder="" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>{{ old('statement', $exercise->statement) }}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 mb-5">
        <div class="card-body">
            <div class="form-group">
                <form action=""></form>
                <label class="label_title">Media <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" 
                    title="Insira aqui o vídeo/audio/imagem a apresentar ao longo de todo o Exercício." 
                    alt="" style="margin-left: 5px;"></label>
                <div id="dropzone">
                    <div class="dropzone needsclick {{ isset($details_page) && $details_page ? 'disabled' : '' }}" id="form-dropzone-media">
                        <div class="dz-message needsclick">
                            <img src="{{asset('/assets/backoffice_assets/icons/Upload.svg')}}" alt="">
                            <br>
                            Arraste e solte os seus ficheiros aqui 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Descrição Audiovisual <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" 
                    title="Descrição Audiovisual apresentado no ínicio da realização do Exercício, acerca da media acima inserida." 
                    alt="" style="margin-left: 5px;"></label>
                <textarea class="form-control" name="audiovisual_desc" id="audiovisual_desc" cols="30" rows="4" placeholder="" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>{{ old('audiovisual_desc', $exercise->audiovisual_desc) }}</textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Transcrição Áudio <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" 
                    title="Transcrição Áudio apresentada no fim da realização de um Exercício, após o mesmo ser submetido pelo Aluno." 
                    alt="" style="margin-left: 5px;"></label>
                <textarea class="form-control" name="audio_transcript" id="audio_transcript" cols="30" rows="4" placeholder="" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>{{ old('audio_transcript', $exercise->audio_transcript) }}</textarea>
                {{-- <div class="audio_transcription_more_options">
                    <input id="show_to_my_students" class="checkbox-custom" name="show_to_my_students" type="checkbox">
                    <label for="show_to_my_students" class="checkbox-custom-label">Mostrar aos meus Alunos?</label>
                </div> --}}
            </div>
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Opções Adicionais</label>
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center">
                        <input id="has_time" class="checkbox-custom" name="has_time" type="checkbox" {{ $exercise->has_time ? 'checked' : '' }} {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                        <label for="has_time" class="checkbox-custom-label">Tempo para preenchimento</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center">
                        <select name="time" id="time" class="form-control" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                            <option value="30" {{ $exercise->time == 30 ? 'selected' : '' }}>30m</option>
                            <option value="60" {{ $exercise->time == 60 ? 'selected' : '' }}>1h 00m</option>
                            <option value="90" {{ $exercise->time == 90 ? 'selected' : '' }}>1h 30m</option>
                            <option value="120" {{ $exercise->time == 120 ? 'selected' : '' }}>2h 00m</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center mt-3">
                        <input id="has_interruption" class="checkbox-custom" name="has_interruption" type="checkbox" {{ $exercise->has_interruption ? 'checked' : '' }} {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                        <label for="has_interruption" class="checkbox-custom-label">Permite interrupções</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center mt-3">
                        <select name="interruption_time" id="interruption_time" class="form-control" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                            <option value="5" {{ $exercise->interruption_time == 5 ? 'selected' : '' }}>0h 05m</option>
                            <option value="10" {{ $exercise->interruption_time == 10 ? 'selected' : '' }}>0h 10m</option>
                            <option value="15" {{ $exercise->interruption_time == 15 ? 'selected' : '' }}>0h 15m</option>
                            <option value="20" {{ $exercise->interruption_time == 20 ? 'selected' : '' }}>0h 20m</option>
                            <option value="25" {{ $exercise->interruption_time == 25 ? 'selected' : '' }}>0h 25m</option>
                            <option value="30" {{ $exercise->interruption_time == 30 ? 'selected' : '' }}>0h 30m</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center mt-3">
                        <input id="can_clone" class="checkbox-custom" name="can_clone" type="checkbox" {{ $exercise->can_clone ? 'checked' : '' }} {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                        <label for="can_clone" class="checkbox-custom-label">Dísponivel para clonar por outros utilizadores</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center"></div>

                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center mt-3">
                        <input id="only_my_students" class="checkbox-custom" name="only_my_students" type="checkbox" {{ $exercise->only_my_students ? 'checked' : '' }} {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                        <label for="only_my_students" class="checkbox-custom-label">Dísponivel só para os meus Alunos</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center"></div>

                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center mt-3">
                        <input id="only_after_correction" class="checkbox-custom" name="only_after_correction" type="checkbox" {{ $exercise->only_after_correction ? 'checked' : '' }} {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                        <label for="only_after_correction" class="checkbox-custom-label">Disponibilizar Correção só após verificação pelo Professor</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-6 mb-5 align-self-end">
        <button type="button" class="btn search-btn comment_submit intro_save save_exercise_form_button" {{ isset($details_page) && $details_page ? 'hidden' : '' }}>
            Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;">
        </button>
    </div>
</div>