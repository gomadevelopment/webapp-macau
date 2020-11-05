<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Texto Introdutório <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                <textarea class="form-control" name="intro_text" id="intro_text" cols="30" rows="4" placeholder=""></textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Enunciado <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                <textarea class="form-control" name="statement" id="statement" cols="30" rows="4" placeholder=""></textarea>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-4 col-lg-4 mb-5">
        <div class="card-body">
            <div class="form-group">
                <form action=""></form>
                <label class="label_title">Media <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                    <div id="dropzone">
                        <form class="dropzone needsclick" id="form-dropzone" action="#">
                            <div class="dz-message needsclick">
                                <img src="{{asset('/assets/backoffice_assets/icons/Upload.svg')}}" alt="">
                                <br>
                                Arraste e solte os seus ficheiros aqui 
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Descrição Audivisual <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                <textarea class="form-control" name="audio_visual_description" id="audio_visual_description" cols="30" rows="4" placeholder=""></textarea>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Transcrição Áudio <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                <textarea class="form-control" name="audio_transcription" id="audio_transcription" cols="30" rows="4" placeholder=""></textarea>
                <div class="audio_transcription_more_options">
                    <input id="show_to_my_students" class="checkbox-custom" name="show_to_my_students" type="checkbox">
                    <label for="show_to_my_students" class="checkbox-custom-label">Mostrar aos meus Alunos?</label>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12 col-md-8 col-lg-6 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Opções Adicionais <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                <div class="row">
                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center">
                        <input id="time_for_fill" class="checkbox-custom" name="time_for_fill" type="checkbox">
                        <label for="time_for_fill" class="checkbox-custom-label">Tempo para preenchimento</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center">
                        <select name="fill_time" id="fill_time" class="form-control" disabled>
                            <option value=""></option>
                            <option value="1">1h 00m</option>
                            <option value="2">1h 30m</option>
                            <option value="3">2h 00m</option>
                        </select>
                    </div>
                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center mt-3">
                        <input id="allow_interruptions" class="checkbox-custom" name="allow_interruptions" type="checkbox">
                        <label for="allow_interruptions" class="checkbox-custom-label">Permite interrupções</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center mt-3">
                        <select name="interruption_time" id="interruption_time" class="form-control" disabled>
                            <option value=""></option>
                            <option value="1">0h 05m</option>
                            <option value="2">0h 10m</option>
                            <option value="3">0h 15m</option>
                            <option value="4">0h 20m</option>
                        </select>
                    </div>

                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center mt-3">
                        <input id="available_for_cloning" class="checkbox-custom" name="available_for_cloning" type="checkbox">
                        <label for="available_for_cloning" class="checkbox-custom-label">Dísponivel para clonar por outros utilizadores</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center"></div>

                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center mt-3">
                        <input id="available_for_my_students" class="checkbox-custom" name="available_for_my_students" type="checkbox">
                        <label for="available_for_my_students" class="checkbox-custom-label">Dísponivel só para os meus Alunos</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center"></div>

                    <div class="col-sm-12 col-md-7 col-lg-7 align-self-center mt-3">
                        <input id="available_correction" class="checkbox-custom" name="available_correction" type="checkbox">
                        <label for="available_correction" class="checkbox-custom-label">Disponibilizar Correção só após verificação pelo Professor</label>
                    </div>
                    <div class="col-sm-12 col-md-5 col-lg-5 align-self-center"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-4 col-lg-6 mb-5 align-self-end">
        <button type="" class="btn search-btn comment_submit">Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;"></button>
    </div>
</div>