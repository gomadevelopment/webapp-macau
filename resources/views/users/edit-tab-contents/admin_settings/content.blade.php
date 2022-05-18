{{-- UNIVERSITES --}}
<div class="shop_grid_caption card-body m-0 mb-4 pt-2 pb-2">
                
    <div class="form-group d-flex flex-wrap justify-content-center m-0 float-left">
        <a href="#collapse_universities" class="m-0 b-0 p-0 align-self-center classes_accordion expand_accordion collapsed d-inline-flex"  data-toggle="collapse" data-parent="#accordion">
            <h4 class="sg_rate_title align-self-center text-center mr-2" style="font-size: 21px;">
                Universidades
            </h4>
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="" style="display: none;">
        </a>
    </div>

</div>


<div id="collapse_universities" class="collapse" data-parent="#accordion">

    @include('users.edit-tab-contents.admin_settings.content-partials.universities')
        
</div>


{{-- TAGS --}}
<div class="shop_grid_caption card-body m-0 mb-4 pt-2 pb-2">

    <div class="form-group d-flex flex-wrap justify-content-center m-0 float-left">
        <a href="#collapse_tags" class="m-0 b-0 p-0 align-self-center classes_accordion expand_accordion collapsed d-inline-flex"  data-toggle="collapse" data-parent="#accordion">
            <h4 class="sg_rate_title align-self-center text-center mr-2" style="font-size: 21px;">
                Tags
            </h4>
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="" style="display: none;">
        </a>
    </div>

</div>

<div id="collapse_tags" class="collapse" data-parent="#accordion">
    
    @include('users.edit-tab-contents.admin_settings.content-partials.tags')

</div>


{{-- EXERCISES LEVELS --}}
<div class="shop_grid_caption card-body m-0 mb-4 pt-2 pb-2">

    <div class="form-group d-flex flex-wrap justify-content-center m-0 float-left">
        <a href="#collapse_exercises_levels" class="m-0 b-0 p-0 align-self-center classes_accordion expand_accordion collapsed d-inline-flex"  data-toggle="collapse" data-parent="#accordion">
            <h4 class="sg_rate_title align-self-center text-center mr-2" style="font-size: 21px;">
                Níveis de Exercícios
            </h4>
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="" style="display: none;">
        </a>
    </div>

</div>


<div id="collapse_exercises_levels" class="collapse" data-parent="#accordion">

    @include('users.edit-tab-contents.admin_settings.content-partials.exercises_levels')
        
</div>


{{-- EXERCISES CATEGORIES --}}
<div class="shop_grid_caption card-body m-0 mb-4 pt-2 pb-2">

    <div class="form-group d-flex flex-wrap justify-content-center m-0 float-left">
        <a href="#collapse_exercises_categories" class="m-0 b-0 p-0 align-self-center classes_accordion expand_accordion collapsed d-inline-flex"  data-toggle="collapse" data-parent="#accordion">
            <h4 class="sg_rate_title align-self-center text-center mr-2" style="font-size: 21px;">
                Categorias de Exercícios
            </h4>
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="" style="display: none;">
        </a>
    </div>

</div>


<div id="collapse_exercises_categories" class="collapse" data-parent="#accordion">

    @include('users.edit-tab-contents.admin_settings.content-partials.exercises_categories')
        
</div>


{{-- ARTICLES CATEGORIES --}}
<div class="shop_grid_caption card-body m-0 mb-4 pt-2 pb-2">

    <div class="form-group d-flex flex-wrap justify-content-center m-0 float-left">
        <a href="#collapse_articles_categories" class="m-0 b-0 p-0 align-self-center classes_accordion expand_accordion collapsed d-inline-flex"  data-toggle="collapse" data-parent="#accordion">
            <h4 class="sg_rate_title align-self-center text-center mr-2" style="font-size: 21px;">
                Categorias de Artigos
            </h4>
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_black.svg', config()->get('app.https'))}}?v=2.4" class="expand_chevron" alt="">
            <img src="{{asset('/assets/backoffice_assets/icons/Chevron_up_pink.svg', config()->get('app.https'))}}?v=2.4" class="collapse_chevron" alt="" style="display: none;">
        </a>
    </div>

</div>


<div id="collapse_articles_categories" class="collapse" data-parent="#accordion">

    @include('users.edit-tab-contents.admin_settings.content-partials.articles_categories')
        
</div>
