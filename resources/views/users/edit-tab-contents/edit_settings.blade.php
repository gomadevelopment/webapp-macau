<div class="container p-0">

    <div class="custom-tab customize-tab tabs_creative">
        <ul class="nav nav-tabs p-2 b-0" id="edit_settings_tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="professors-tab" data-toggle="tab" href="#professors" role="tab" aria-controls="professors" aria-selected="true">
                    Professores</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="students-tab" data-toggle="tab" href="#students" role="tab" aria-controls="students-tab" aria-selected="false">
                    Alunos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content-tab" aria-selected="false">
                    Conteúdo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="library-tab" data-toggle="tab" href="#library" role="tab" aria-controls="library-tab" aria-selected="false">
                    Biblioteca</a>
            </li>
            
        </ul>

        <div class="tab-content" id="edit_settings_tabs_content">

            {{-- PROFESSORS TAB --}}
            <div class="tab-pane fade active show" id="professors" role="tabpanel" aria-labelledby="professors-tab">

                @include('users.edit-tab-contents.admin_settings.professors')

            </div>
            {{-- STUDENTS TAB --}}
            <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">
                
                @include('users.edit-tab-contents.admin_settings.students')

            </div>
            {{-- CONTENT TAB --}}
            <div class="tab-pane fade" id="content" role="tabpanel" aria-labelledby="content-tab">

                @include('users.edit-tab-contents.admin_settings.content')

            </div>
            {{-- LIBRARY TAB --}}
            <div class="tab-pane fade" id="library" role="tabpanel" aria-labelledby="library-tab">

                @include('users.edit-tab-contents.admin_settings.library')

            </div>

        </div>

    </div>

</div>