@extends('layouts.default')

@section('header')

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/homepage.css', config()->get('app.https')) }}?v=2.4">

<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/articles.css', config()->get('app.https')) }}?v=2.4">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/exercises.css', config()->get('app.https')) }}?v=2.4">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/classroom.css', config()->get('app.https')) }}?v=2.4">
<link rel="stylesheet" href="{{asset('/assets/css/webapp-macau-custom-css/users.css', config()->get('app.https')) }}?v=2.4">

<link rel="stylesheet" href="{{asset('/assets/js/bootstrap-datepicker/dist/css/bootstrap-datepicker.css', config()->get('app.https')) }}" id="bscss">

@stop

@section('content')

<div class="alert alert-success successMsg global-alert" style="display:none;" role="alert">

</div>

<div class="alert alert-danger errorMsg global-alert" style="display:none;" role="alert">

</div>

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

<style>
    .sg_rate_title, .exercise_author, .exercise_author strong{
        line-height: 30px !important;
    }
</style>

<section class="page-title classroom">
    <div class="container">
        
        <div class="row mb-5">
            {{-- My Profile --}}
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="wrap mb-3">
                    <h1 class="title">FAQ's</h1>
                </div>
                <div class="shop_grid_caption card-body m-0 p-4">
                    <div class="form-group d-flex flex-wrap justify-content-center m-0">
                        <h4 class="sg_rate_title mr-auto">Caro(a) Utilizador(a)</h4>
                        <p class="exercise_author">
                            <strong>
                                Neste espaço encontra informações gerais sobre a plataforma Português à Vista, os destinatários, os conteúdos audiovisuais, os princípios de aprendizagem e a organização dos materiais didáticos.     
                            </strong>
                            <br>
                            <br>

                            <strong>
                                O que é a plataforma Português à Vista?
                            </strong>
                            <br>
                            A plataforma digital de aprendizagem Português à Vista é um projeto do Departamento de Línguas e Cultura/ Faculdade de Artes e Humanidades da Universidade de São José, financiado pelo Fundo do Ensino Superior do Governo da RAEM.
                            <br>
                            <br>

                            <strong>
                                A quem se destina a plataforma Português à Vista?
                            </strong>
                            <br>
                            Português à Vista destina-se aos aprendentes e professores da Licenciatura de Estudos de Tradução Português-Chinês da Universidade de São José, mas também a todos os que ensinam e aprendem o Português como língua não materna em Macau.
                            <br>
                            <br>

                            <strong>
                                Quais os objetivos de Português à Vista?
                            </strong>
                            <br>
                            Português à Vista  tem como objetivos principais:
                            <br>
                            • Contribuir para o desenvolvimento da compreensão de textos orais;
                            <br>
                            • Apresentar soluções tecnológicas em linha com os resultados da investigação do ensino de línguas assistido por computador no domínio da compreensão do oral;   
                            <br>
                            • Contribuir para o desenvolvimento de competências relacionadas com as novas formas de comunicação presentes nas redes tecnológicas atuais.
                            <br>
                            <br>

                            <strong>
                                Quais os conteúdos que se podem encontrar em Português à Vista?
                            </strong>
                            <br>
                            Conteúdos audiovisuais de vários géneros, tais como documentários, videoclipes, curtas-metragens e notícias, muitos dos quais sobre Macau e os países de língua oficial portuguesa. No total, são 100 vídeos e centenas de propostas de atividades. 
                            <br>
                            <br>

                            <strong>
                                Quem colaborou neste Projeto?
                            </strong>
                            <br>
                            Colaboraram neste projeto várias entidades, como por exemplo produtores, canais televisivos, realizadores, escritores e organismos de cooperação multilateral. 
                            <br>
                            <br>

                            <strong>
                                O que é preciso para entrar na plataforma Português à Vista?
                            </strong>
                            <br>
                            É necessário fazer o registo, isto é, criar uma conta de utilizador que, consoante o caso, pode ser de aluno ou de professor.
                            <br>
                            A conta de aluno pode ser associada a uma turma/ professor (validada pelo número de aluno), no caso de pertencer à Universidade de São José. Como se disse, qualquer outro aprendente e professor que não desta universidade pode também aceder à plataforma e criar a sua conta.  
                            <br>
                            <br>

                            <strong>
                                Como estão organizados os materiais didáticos na Plataforma Português à Vista?
                            </strong>
                            <br>
                            Após o registo e entrada na plataforma, professores e alunos têm acesso a uma área comum onde encontram as unidades didáticas dispostas de forma sequencial. É possível aceder diretamente a estas também através de pesquisa ou filtragem por nível de proficiência linguística (do A1 ao C1), por tema, por tag ou por marcação para lista de favoritos.  
                            <br>
                            <br>

                            <strong>
                                Qual é a conceção de aprendizagem seguida?
                            </strong>
                            <br>
                            A concepção de aprendizagem de Português à Vista inscreve-se na ideia de uso de língua como atividade social. Isto significa que os aprendentes devem ser capazes de usar a língua adequadamente, segundo as suas necessidades concretas e nos contextos onde atuam e interagem. Trata-se de uma abordagem orientada para a ação, tal como defende o Quadro Europeu Comum de Referência para as Línguas (QECR), que encara o utilizador e o aprendente como atores sociais que têm de cumprir tarefas em circunstâncias e ambientes determinados (Conselho da Europa, 2001: 29). As unidades didáticas de Português à Vista procuram assim fomentar uma aprendizagem contextualizada, promovendo o desenvolvimento linguístico-comunicativo e a reflexão sobre o próprio processo de aprender. 
                            <br>
                            <br>

                            <strong>
                                Que abordagem didática é privilegiada nos materiais didáticos?
                            </strong>
                            <br>
                            Um conjunto de princípios e abordagens subjaz aos materiais didáticos desenvolvidos, de que se destacam:
                            <br>
                            <strong>1 - </strong>A adoção de um modelo didático que combina uma abordagem que envolve atividades para testar o nível de compreensão oral com uma abordagem que promove a reflexão sobre os processos cognitivos e as estratégias de aprendizagem com vista a desenvolver a capacidade de compreensão auditiva;
                            <br>
                            <strong>2 - </strong>A inclusão de atividades provenientes da abordagem metacognitiva da compreensão do oral (Goh, 2008);
                            <br>
                            <strong>3 - </strong>A utilização de técnicas e abordagens de exploração didática do vídeo, com vista a promover não só as competências linguísticas, mas também competências associadas à multimodalidade dos textos (New London Group, 1996).
                            <br>
                            <br>

                            <strong>
                                Como é que as unidades didáticas foram concebidas?
                            </strong>
                            <br>
                            As unidades didáticas estão organizadas sequencialmente e por etapas. Essas etapas são: Pré-Escuta, À Escuta, Oficina de Escuta e Pós-Escuta.
                            <br>
                            A etapa de Pré-Escuta consiste na preparação do aprendente para o visionamento do vídeo. Pretende-se neste ponto ativar conhecimentos factuais, lexicais ou culturais, servindo igualmente para motivar e estimular a curiosidade do aprendente. 
                            <br>
                            A etapa À Escuta visa treinar essencialmente as competências de compreensão geral. Para isso, pode ser mobilizado todo o recurso ou apenas uma parte do mesmo. Pode ainda consistir na confirmação das previsões e inferências feitas na etapa anterior.
                            <br>
                            A etapa Oficina de Escuta pretende trabalhar as competências de compreensão específica. São trabalhados aspetos relacionados com as características do discurso oral, aspectos fonético-fonológicos, aspetos lexicais ou aspectos gramaticais. Nesta parte também são propostas atividades para desenvolver a literacia visual.  
                            <br>
                            Finalmente, na fase de Pós-Escuta são propostas tarefas com vista à reutilização e apropriação das novas aquisições em termos escritos ou orais. Esta parte inclui ainda um questionário de autorreflexão (em português, em chinês e em inglês), que tem por objectivo promover a reflexão em relação às estratégias utilizadas para compreender o texto oral, e um diagrama de ansiedade, com vista a que o aprendente controle os níveis de ansiedade.
                            <br>
                            <br>

                            <strong>
                                O que é o Auto-Exercício?
                            </strong>
                            <br>
                            A plataforma Português à Vista permite que o aluno crie os seus próprios exercícios. Para isso, é necessário aceder, na área de aluno, a Auto Exercício, copiar a transcrição do vídeo (por exemplo, a letra de uma canção), gerando o programa automaticamente um exercício de Preenchimento de Espaços ou de Fronteira de Palavra. 

                        </p>
                    </div>
                </div>
            </div>
        
    </div>

</section>


@stop

@section('scripts')

    <script src="{{asset('/assets/js/webapp-macau-custom-js/homepage.js', config()->get('app.https')) }}?v=2.4"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/articles.js', config()->get('app.https')) }}?v=2.4"></script>
    <script src="{{asset('/assets/js/webapp-macau-custom-js/exercises.js', config()->get('app.https')) }}?v=2.4"></script>
@stop
