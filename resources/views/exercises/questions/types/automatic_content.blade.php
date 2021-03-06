<div class="form-group to_choose automatic_content">

    <form id="form-automatic_content" class="question-form" action=""  enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            @if (isset($question->id) && $question->question_subtype_id == 13)
                @foreach ($question->question_items as $question_item)
                    @if (!$loop->first)
                        <div class="col-12 mb-1 hr_row"><hr></div>
                    @endif
                    <div class="col-12">
                        <label class="label_title mb-0 text_number">
                            <span>Texto {{ $loop->index + 1 }}</span>
                        </label>
                    </div>
                    <div class="col-12 mb-2">
                        <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                            *Escreva o texto original para que as suas palavras possam ser separadas (com pré-visualização).
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                            <textarea class="form-control" name="split_textarea_{{$loop->index}}" id="split_textarea_{{$loop->index}}" 
                                cols="30" rows="4" placeholder="Texto original...">{{$question_item->text_1}}</textarea>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                        <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                            <textarea class="form-control" name="split_preview_{{$loop->index}}" id="split_preview_{{$loop->index}}" 
                                cols="30" rows="4" placeholder="Pré-visualização..." disabled style="background-color: #e9ecef5c;">{{str_replace(" ","",$question_item->text_1)}}</textarea>
                        </div>
                    </div>
                    <div class="col-12">
                        <a href="#" class="btn btn-theme remove_button remove_row remove_automatic_content" style="float: right; padding: 16px 20px; white-space: nowrap;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                            Remover
                        </a>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <label class="label_title mb-0 text_number">
                        <span>Texto 1</span>
                    </label>
                </div>
                <div class="col-12 mb-2">
                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                        *Escreva o texto original para que as suas palavras possam ser separadas (com pré-visualização).
                    </p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="split_textarea_0" id="split_textarea_0" cols="30" rows="4" placeholder="Texto original..."></textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="split_preview_0" id="split_preview_0" cols="30" rows="4" placeholder="Pré-visualização..." disabled style="background-color: #e9ecef5c;"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <a href="#" class="btn btn-theme remove_button remove_row remove_automatic_content" style="float: right; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            @endif
        </div>
        <div class="row mb-3">
            <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                <a href="#" class="btn search-btn comment_submit m-3 button_add_split" style="font-size: 21px; float: none;">
                    <img src="{{asset('/assets/backoffice_assets/icons/Add_white.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 4px;">
                    Adicionar Alínea
                </a>
            </div>
        </div>

    </form>

</div>

{{-- CLONES --}}

<div class="add_split_clone" hidden>
    <div class="col-12 mb-1 hr_row"><hr></div>
    @if (isset($question->id) && $question->question_subtype_id == 13)
        @foreach ($question->question_items as $question_item)
            @if($loop->last)
                <div class="col-12">
                    <label class="label_title mb-0 text_number">
                        <span>Texto {{ $loop->index + 1 }}</span>
                    </label>
                </div>
                <div class="col-12 mb-2">
                    <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                        *Escreva o texto original para que as suas palavras possam ser separadas (com pré-visualização).
                    </p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="split_textarea_{{$loop->index}}" id="split_textarea_{{$loop->index}}" cols="30" rows="4" placeholder="Texto original..."></textarea>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
                    <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                        <textarea class="form-control" name="split_preview_{{$loop->index}}" id="split_preview_{{$loop->index}}" cols="30" rows="4" placeholder="Pré-visualização..." disabled style="background-color: #e9ecef5c;"></textarea>
                    </div>
                </div>
                <div class="col-12">
                    <a href="#" class="btn btn-theme remove_button remove_row remove_automatic_content" style="float: right; padding: 16px 20px; white-space: nowrap;">
                        <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                        Remover
                    </a>
                </div>
            @endif
        @endforeach
    @else
        <div class="col-12">
            <label class="label_title mb-0 text_number">
                <span>Texto 1</span>
            </label>
        </div>
        <div class="col-12 mb-2">
            <p class="exercise_level m-0 float-none" style="font-size: 16px;">
                *Escreva o texto original para que as suas palavras possam ser separadas (com pré-visualização).
            </p>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="split_textarea_0" id="split_textarea_0" cols="30" rows="4" placeholder="Texto original..."></textarea>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6 mb-3">
            <div class="p-3" style="background-color: #f1f6f9; border-radius: 10px; box-shadow: 0 13px 26px 13px rgba(0, 0, 0, 0.01);">
                <textarea class="form-control" name="split_preview_0" id="split_preview_0" cols="30" rows="4" placeholder="Pré-visualização..." disabled style="background-color: #e9ecef5c;"></textarea>
            </div>
        </div>
        <div class="col-12">
            <a href="#" class="btn btn-theme remove_button remove_row remove_automatic_content" style="float: right; padding: 16px 20px; white-space: nowrap;">
                <img src="{{asset('/assets/backoffice_assets/icons/Cross.svg')}}" alt="" style="margin-right: 10px; margin-bottom: 2px;">
                Remover
            </a>
        </div>
    @endif
    
</div>