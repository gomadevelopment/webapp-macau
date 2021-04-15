<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-4 mb-5" {{ isset($details_page) && $details_page ? 'hidden' : '' }}>
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Criar a partir de outro Exercício <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" data-toggle="tooltip" 
                    title="Clonar um exercício a partir de outro já existente a que tenha acesso e que seja possível clonar." 
                    alt="" style="margin-left: 5px;"></label>
                <select name="exercise_template" id="exercise_template" class="form-control" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                    <option value="0">Escolher exercício...</option>
                    @foreach ($clonable_exercises as $clonable_exercise)
                        <option value="{{ $clonable_exercise->id }}">{{ $clonable_exercise->title }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 {{ isset($details_page) && $details_page ? 'col-md-12 col-lg-8' : 'col-md-6 col-lg-5' }} mb-5">
        <div class="card-body mb-3">
            <div class="form-group">
                <label class="label_title">Criar Novo</label>
                <input name="title" id="title" type="text" class="form-control" placeholder="Título do exercício"
                value="{{ old('title', $exercise->title) }}" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                <span class="error-block-span pink title_error" hidden>
                </span>
            </div>
            <div class="form-group">
                <label class="label_title">Tags</label>
                <div class="select2_with_search">
                    <select name="tags[]" id="tags" class="form-control" multiple  style="border: none;" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                        @foreach ($tags as $tag)
                            <?php 
                                $selected = '';
                                if (!empty($exercise->exercise_tags)) {
                                    foreach ($exercise->exercise_tags as $exercise_tag) {
                                        if ($exercise_tag->id == $tag->id) {
                                            $selected = 'selected';
                                            break;
                                        }
                                    }
                                }
                            ?>                                                        
                            <option value="{{ $tag->id }}" <?php echo $selected;?>>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                        <label class="label_title">Tema</label>
                        <select name="category" id="category" class="form-control" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                            @foreach ($exercises_categories as $category)
                                <option value="{{ $category->id }}" {{ $exercise->id && $exercise->exercise_category_id == $category->id ? 'selected' : '' }}
                                    >{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                        <label class="label_title">Nível</label>
                        <select name="level" id="level" class="form-control" {{ isset($details_page) && $details_page ? 'disabled' : '' }}>
                            @foreach ($exercises_levels as $level)
                                <option value="{{ $level->id }}" {{ $exercise->id && $exercise->exercise_level_id == $level->id ? 'selected' : '' }}
                                    >{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
                
        </div>
        <button type="" class="btn search-btn comment_submit go_to_intro_tab beginning_save save_exercise_form_button" {{ isset($details_page) && $details_page ? 'hidden' : '' }}>
            Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;">
        </button>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-3 text-center">
        <img src="{{asset('/assets/backoffice_assets/images/lamp.svg')}}" alt="" style="contain: style;">
    </div>
</div>