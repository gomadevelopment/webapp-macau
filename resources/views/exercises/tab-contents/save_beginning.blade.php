<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-4 mb-5">
        <div class="card-body">
            <div class="form-group">
                <label class="label_title">Criar a partir de outro Exercício <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                <select name="exercise_template" id="exercise_template" class="form-control">
                    <option value=""></option>
                    <option value="1">Exercício A</option>
                    <option value="2">Exercício B</option>
                    <option value="3">Exercício C</option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-5 mb-5">
        <div class="card-body mb-3">
            <div class="form-group">
                <label class="label_title">Criar Novo <img src="{{asset('/assets/backoffice_assets/icons/Tooltip.svg')}}" alt="" style="margin-left: 5px;"></label>
                <input name="exercise_name" id="exercise_name" type="text" class="form-control" placeholder="Título do exercício">
            </div>
            <div class="form-group">
                <label class="label_title">Tags</label>
                <div class="select2_with_search" style="border-radius: 5px; border: 2px solid #e6ebf1;">
                    <select name="tags" id="tags" class="form-control" multiple style="border: none;">
                        <option value=""></option>
                        <option value="1">Ciência</option>
                        <option value="2">Tecnologia</option>
                        <option value="3">Natureza</option>
                        <option value="4">Sintáx</option>
                        <option value="5">Geografia</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                        <label class="label_title">Categoria</label>
                        <select name="categories" id="categories" class="form-control">
                            <option value=""></option>
                            <option value="1">Gramática</option>
                            <option value="2">Ciência</option>
                            <option value="3">Desporto</option>
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
                    <div class="form-group">
                        <label class="label_title">Nível</label>
                        <select name="levels" id="levels" class="form-control">
                            <option value=""></option>
                            <option value="1">A1</option>
                            <option value="2">A2</option>
                            <option value="3">A3</option>
                        </select>
                    </div>
                </div>
            </div>
                
        </div>
        <button type="" class="btn search-btn comment_submit">Gravar <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px;"></button>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-3 text-center">
        <img src="{{asset('/assets/backoffice_assets/images/lamp.svg')}}" alt="" style="contain: style;">
    </div>
</div>