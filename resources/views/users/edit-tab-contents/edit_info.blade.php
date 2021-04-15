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
<div class="row mb-5">
    {{-- My Profile --}}
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="shop_grid_caption card-body classroom m-0 p-4">

            <form method="POST" id="edit_profile_form" novalidate="true" action="/perfil/editar/{{ $user->id }}" enctype="multipart/form-data">
                @csrf

                <div class="row">

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">
                        <div class="preloader ajax col-lg-9 col-md-12 col-sm-12 order-1 order-lg-2" style="margin: auto !important;"><span></span><span></span></div>
                        <div class="row replace_user_avatar_row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group d-flex flex-wrap justify-content-center m-0">
                                    {{-- <img src="{{ $user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}" 
                                    alt="" class="user_round_avatar"> --}}
                                <div style="background-size: 100%; background-repeat: no-repeat; background-image: url('{{$user->avatar_url ? '/webapp-macau-storage/avatars/'.$user->id.'/'.$user->avatar_url : 'https://via.placeholder.com/500x500'}}')" class="user_round_avatar"></div>
                                </div>
                                <h4 class="sg_rate_title align-self-center text-center mt-3">
                                    Imagem de Perfil
                                </h4>
                                <a href="#" id="replace_user_avatar" class="btn search-btn comment_submit mt-4 mb-4" style="float: none; padding: 12px 20px;">
                                    <img src="{{asset('/assets/backoffice_assets/icons/Upload_white.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                    Substituir Fotografia
                                </a>
                                <input type="file" name="avatar_url" id="avatar_url" hidden>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 text-left mb-3">
                        @if (session('edit_profile_error'))
                            <div class="alert alert-danger">
                                {{ session('edit_profile_error') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="" class="label_title">Nome de Utilizaddor</label>
                                    <input class="form-control" type="text" name="username" id="username" 
                                    value="{{ old('username', $user->username) }}">
                                    @if ($errors->has('username'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('username') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title">Nome</label>
                                    <input class="form-control" type="text" name="first_name" id="first_name" 
                                    placeholder="João Paulo" value="{{ old('first_name', $user->first_name) }}">
                                    @if ($errors->has('first_name'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('first_name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title">Apelido</label>
                                    <input class="form-control" type="text" name="last_name" id="last_name" 
                                    placeholder="Madeira" value="{{ old('last_name', $user->last_name) }}">
                                    @if ($errors->has('last_name'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('last_name') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title">E-mail</label>
                                    <input class="form-control" type="email" name="email" id="email" 
                                    placeholder="j.p.madeira4782@mail.com" value="{{ old('email', $user->email) }}">
                                    @if ($errors->has('email'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('email') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title">E-mail Secundário</label>
                                    <input class="form-control" type="email" name="second_email" id="second_email" 
                                    placeholder="j.p.madeira4782@mail.com" value="{{ old('second_email', $user->second_email) }}">
                                    @if ($errors->has('second_email'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('second_email') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title">Palavra-Passe</label>
                                    <input class="form-control" type="password" name="password" id="password" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                                    @if ($errors->has('password'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    <label for="" class="label_title">Repetir Palavra-Passe</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;">
                                    @if ($errors->has('password'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                <div class="form-group">
                                    @if($user->isProfessor() && $user->isActive())
                                    <label for="" class="label_title">Instituição onde lecciona</label>
                                    @else
                                    <label for="" class="label_title">Instituição de Ensino</label>
                                    @endif
                                    <select class="form-control" name="select_university" id="select_university">
                                        <option value="0">Nenhuma</option>
                                        @foreach ($universities as $uni)
                                            <option value="{{ $uni->id }}" {{ $user->university && $user->university->id == $uni->id ? 'selected' : '' }}>
                                                {{ $uni->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('select_university'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('select_university') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6 col-lg-6">
                                @if($user->isProfessor() && $user->isActive())
                                <div class="form-group">
                                    <label for="" class="label_title">Outra</label>
                                    <input class="form-control" type="text" name="user_student_number" id="user_student_number" placeholder="">
                                    @if ($errors->has('user_student_number'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('user_student_number') }}
                                        </span>
                                    @endif
                                </div>
                                @else
                                <div class="form-group">
                                    <label for="" class="label_title">Nº de Aluno</label>
                                    <input class="form-control" type="text" name="student_number" id="student_number" 
                                    placeholder="B2397419861" value="{{ old('student_number', $user->student_number) }}">
                                    @if ($errors->has('student_number'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('student_number') }}
                                        </span>
                                    @endif
                                </div>
                                @endif
                            </div>
                            @if($user->isProfessor() && $user->isActive())
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="" class="label_title">Página LinkedIn</label>
                                    <input class="form-control" type="text" name="linkedin_url" id="linkedin_url" 
                                    placeholder="https://www.linkedin.com/jp.madeira52" value="{{ old('linkedin_url', $user->linkedin_url) }}">
                                    @if ($errors->has('linkedin_url'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('linkedin_url') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                            @endif
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    @if($user->isProfessor() && $user->isActive())
                                        <label for="" class="label_title">Breve Resumo do Percurso Profissional</label>
                                    @else
                                        <label for="" class="label_title">Sobre mim</label>
                                    @endif
                                    <textarea class="form-control" name="resume" id="resume" cols="30" rows="5">{{ old('resume', $user->resume) }}</textarea>
                                    @if ($errors->has('resume'))
                                        <span class="error-block-span pink">
                                            {{ $errors->first('resume') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <hr>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="form-group">
                                    <label for="" class="label_title">Preferências</label>
                                    @if($user->isProfessor() && $user->isActive())
                                        <input id="show_email" class="checkbox-custom" name="show_email" type="checkbox"
                                        {{ $user->show_email ? 'checked' : ''}}>
                                        <label for="show_email" class="checkbox-custom-label mb-3">Mostrar o meu Email a Utilizadores que não pertencam às minhas Turmas</label>
                                    @else
                                        <input id="show_performance" class="checkbox-custom" name="show_performance" type="checkbox"
                                        {{ $user->show_performance ? 'checked' : ''}}>
                                        <label for="show_performance" class="checkbox-custom-label mb-3">Permitir que o meu Desempenho seja visto pelos Colegas de Turma</label>

                                        <input id="show_email" class="checkbox-custom" name="show_email" type="checkbox"
                                        {{ $user->show_email ? 'checked' : ''}}>
                                        <label for="show_email" class="checkbox-custom-label mb-3">Mostrar o meu Email aos meus Colegas</label>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <div class="d-block text-right mt-2">
                                    <a href="/perfil/{{ $user->id }}" class="btn btn-theme remove_button m-2" style="float: none; padding: 12px 20px;">
                                        <img src="{{asset('/assets/backoffice_assets/icons/eye_outline.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                        Ver o meu Perfil
                                    </a>
                                    <button class="btn search-btn comment_submit m-2" style="float: none; padding: 12px 20px;">
                                        Gravar
                                        <img src="{{asset('/assets/backoffice_assets/icons/save.svg')}}" alt="" style="margin-left: 10px; margin-bottom: 2px;">
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <hr>
                    </div>

                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mt-3 mb-2">
                        <div class="d-block text-center mb-3">
                            <a href="/exercicios" class="btn btn-theme remove_button m-3" style="float: none; padding: 12px 20px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/icon_View_Exercises.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Ver Exercícios
                            </a>
                            <a href="/sala_de_aula" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px;">
                                <img src="{{asset('/assets/backoffice_assets/icons/Book.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                                Sala de Aula
                            </a>
                        </div>
                    </div>

                </div>
            
            </form>

        </div>
    </div>
</div>