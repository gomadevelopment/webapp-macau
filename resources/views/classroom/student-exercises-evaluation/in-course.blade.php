<div class="row">

    @foreach ($student_in_course_exames as $exame)

        <div class="col-lg-12 col-md-12 col-sm-12">
                
            <div class="shop_grid_caption card-body m-0 mb-4">
            <h4 class="sg_rate_title">{{ $exame->title }}</h4>
                <div class="d-flex float-left flex-column">
                    <p class="exercise_author">
                        <strong>Nível:</strong> {{ $exame->level->name }}
                    </p>
                </div>
                <div class="d-block float-right">
                    <a href="/exercicios/realizar/{{ $exame->exercise->id }}" class="btn search-btn comment_submit" style="float: none; padding: 12px 20px; margin-left: 15px;">
                        <img src="{{asset('/assets/backoffice_assets/icons/play.svg')}}" alt="" style="margin-right: 5px; margin-bottom: 2px;">
                        Retomar
                    </a>
                </div>
                    
            </div>
            
        </div>

    @endforeach

    @if(!$student_in_course_exames->count())
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="shop_grid">
                <div class="shop_grid_caption">
                    <h4 class="sg_rate_title" style="font-size: 20px;">
                        Não foram encontrados exercícios em curso.
                    </h4>
                </div>
            </div>
        </div>
    @endif

</div>

<!-- Row -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        
        <!-- Pagination -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">

                {{ $student_in_course_exames->links('layouts.pagination-macau') }}
                
            </div>
        </div>
        
    </div>
</div>
<!-- /Row -->