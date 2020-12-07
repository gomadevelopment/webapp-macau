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
<div class="row mb-5 classes">
    @if($classes->count())
        {{-- ODD COLUMN --}}
        <div class="col-sm-12 col-lg-6 col-md-6">
            @foreach ($classes as $class)
                @if($loop->iteration  % 2 == 0)
                    @continue
                @else
                    <div class="row">

                        {{-- Turma --}}
                        <div class="col-sm-12 col-md-12 col-lg-12 unique_class_body class_{{ $class->id }}">

                            @include('users.edit-tab-contents.classes.unique_class_partial', [
                                'class' => $class,
                                'students_without_class' => $students_without_class
                                ])

                        </div>
                        
                    </div>
                @endif
            @endforeach
        </div>

        {{-- EVEN COLUMN --}}
        <div class="col-sm-12 col-lg-6 col-md-6">
            @foreach ($classes as $class)
                @if($loop->iteration  % 2 != 0)
                    @continue
                @else
                    <div class="row">

                        {{-- Turma --}}
                        <div class="col-sm-12 col-md-12 col-lg-12 unique_class_body class_{{ $class->id }}">

                            @include('users.edit-tab-contents.classes.unique_class_partial', [
                                'class' => $class,
                                'students_without_class' => $students_without_class
                                ])

                        </div>
                        
                    </div>
                @endif
            @endforeach
        </div>
    @else
        <div class="form-group d-flex flex-wrap justify-content-center m-0">
            <div class="col-12">
                <h4 class="sg_rate_title align-self-center m-0" style="font-size: 24px; color: #131b31;">
                    Ainda não tem turmas criadas. Comece por criar uma turma.          
                </h4>
            </div>
        </div>
    @endif

</div>