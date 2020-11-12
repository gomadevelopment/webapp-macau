<div class="row mb-5">
    {{-- My Profile --}}
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="shop_grid_caption card-body classroom m-0 p-4">

            <div class="row">

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                    <div class="row">
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group d-flex flex-wrap justify-content-center m-0">
                                <img src="https://via.placeholder.com/500x500" alt="" class="user_round_avatar mr-3">
                            </div>
                            <h4 class="sg_rate_title align-self-center text-center mt-3">
                                Imagem de Perfil
                            </h4>
                            <a href="#" class="btn search-btn comment_submit mt-4 mb-4" style="float: none; padding: 12px 20px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Substituir Fotografia
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 text-left mb-3">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="" class="label_title">Nome</label>
                                <input class="form-control" type="text" name="user_name" id="user_name" placeholder="João Paulo">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="" class="label_title">Apelido</label>
                                <input class="form-control" type="text" name="user_last_name" id="user_last_name" placeholder="Madeira">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="" class="label_title">E-mail</label>
                                <input class="form-control" type="email" name="user_email" id="user_email" placeholder="j.p.madeira4782@mail.com">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="" class="label_title">E-mail Secundário</label>
                                <input class="form-control" type="email" name="user_email_sec" id="user_email_sec" placeholder="j.p.madeira4782@mail.com">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="" class="label_title">Palavra-Passe</label>
                                <input class="form-control" type="password" name="user_password" id="user_password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="" class="label_title">Repetir Palavra-Passe</label>
                                <input class="form-control" type="password" name="user_password_conf" id="user_password_conf" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                <label for="" class="label_title">Instituição onde lecciona</label>
                                @else
                                <label for="" class="label_title">Instituição de Ensino</label>
                                @endif
                                <select class="form-control" name="select_school_name" id="select_school_name">
                                    <option value="1">University of Saint Joseph - Macau</option>
                                    <option value="2">University of Saint Joseph - Macau</option>
                                    <option value="3">University of Saint Joseph - Macau</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                            <div class="form-group">
                                <label for="" class="label_title">Outra</label>
                                <input class="form-control" type="text" name="user_student_number" id="user_student_number" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                            </div>
                            @else
                            <div class="form-group">
                                <label for="" class="label_title">Nº de Aluno</label>
                                <input class="form-control" type="text" name="user_student_number" id="user_student_number" placeholder="B2397419861">
                            </div>
                            @endif
                        </div>
                        @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="" class="label_title">Página LinkedIn</label>
                                <input class="form-control" type="text" name="user_linkedin_link" id="user_linkedin_link" placeholder="https://www.linkedin.com/jp.madeira52">
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <label for="" class="label_title">Breve Resumo do Percurso Profissional</label>
                                @else
                                    <label for="" class="label_title">Sobre mim</label>
                                @endif
                                <textarea class="form-control" name="user_description" id="user_description" cols="30" rows="5">Escola de Linguas.</textarea>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <hr>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="form-group">
                                <label for="" class="label_title">Preferências</label>
                                @if(auth()->user()->role == 1 || auth()->user()->role == 2)
                                    <input id="show_email_to_other_classes" class="checkbox-custom" name="show_email_to_other_classes" type="checkbox">
                                    <label for="show_email_to_other_classes" class="checkbox-custom-label mb-3">Mostrar o meu Email a Utilizadores que não pertencam às minhas Turmas</label>
                                @else
                                    <input id="allow_performance_by_colleagues" class="checkbox-custom" name="allow_performance_by_colleagues" type="checkbox">
                                    <label for="allow_performance_by_colleagues" class="checkbox-custom-label mb-3">Permitir que o meu Desempenho seja visto pelos Colegas de Turma</label>

                                    <input id="show_email_to_my_colleagues" class="checkbox-custom" name="show_email_to_my_colleagues" type="checkbox">
                                    <label for="show_email_to_my_colleagues" class="checkbox-custom-label mb-3">Mostrar o meu Email aos meus Colegas</label>
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-12 col-lg-12">
                            <div class="d-block text-right mt-3 mb-3">
                                <a href="/perfil" class="btn btn-theme remove_button" style="float: none; padding: 12px 20px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Eye_pink.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Ver o meu Perfil
                                </a>
                                <a href="#" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                                    Gravar
                                    <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px; margin-bottom: 2px;">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <hr>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3 mb-2">
                    <div class="d-block text-center mt-3 mb-3">
                        <a href="/exercicios" class="btn btn-theme remove_button" style="float: none; padding: 12px 20px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/icon_View_Exercises.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                            Ver Exercícios
                        </a>
                        <a href="/sala_de_aula" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                            <img src="{{asset('/assets/backoffice_assets/icons/Book.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                            Sala de Aula
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>