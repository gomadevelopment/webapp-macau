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
<div class="alert alert-success successMsg global-alert" style="display:none;" role="alert">

</div>

<div class="alert alert-danger errorMsg global-alert" style="display:none;" role="alert">

</div>

@if(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)

    {{-- awaiting-evaluation TAB --}}
    <div class="tab-pane fade show active" id="awaiting-evaluation" role="tabpanel" aria-labelledby="awaiting-evaluation-tab">
        
            @include('classroom.professor-exercises-evaluation.awaiting-evaluation', 
            ['students_exames_awaiting_evaluation' => $students_exames_awaiting_evaluation])

    </div>

    {{-- in-course TAB --}}
    <div class="tab-pane fade" id="in-course" role="tabpanel" aria-labelledby="in-course-tab">

            @include('classroom.professor-exercises-evaluation.in-course',
            ['students_exames_in_course' => $students_exames_in_course])

    </div>

    {{-- evaluated TAB --}}
    <div class="tab-pane fade" id="evaluated" role="tabpanel" aria-labelledby="evaluated-tab">

            @include('classroom.professor-exercises-evaluation.evaluated',
            ['students_exames_evaluated' => $students_exames_evaluated])

    </div>

@else

    {{-- in-evaluation TAB --}}
    <div class="tab-pane fade show active" id="in-evaluation" role="tabpanel" aria-labelledby="in-evaluation-tab">
        
        @include('classroom.student-exercises-evaluation.in-evaluation', 
            ['student_in_evaluation_exames' => $student_in_evaluation_exames])

    </div>

    {{-- in-course TAB --}}
    <div class="tab-pane fade" id="in-course" role="tabpanel" aria-labelledby="in-course-tab">

        @include('classroom.student-exercises-evaluation.in-course', 
            ['student_in_course_exames' => $student_in_course_exames])

    </div>

    {{-- done TAB --}}
    <div class="tab-pane fade" id="done" role="tabpanel" aria-labelledby="done-tab">

        @include('classroom.student-exercises-evaluation.done', 
            ['student_done_exames' => $student_done_exames])

    </div>

@endif
