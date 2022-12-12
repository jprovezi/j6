@extends('templates.inovex.main')
@section('title','Sobre a J6 Soluções Digitais')
@section('description','Somos uma agência online, 100% focada em soluções digitais. Nascemos no ano de 2022, porém a experiência da nossa empresa soma + de 10 anos.')
@section('menuSolucoes')
    @foreach ($solucoes as $item)
        <li><a href="{{ $item["url-single"] }}">{{ $item["titulo"] }}</a></li>
    @endforeach
@endsection
@section('content')
<section class="page-header">
    <div class="particles-snow" id="header-snow"></div><!-- /#header-snow.particles-snow -->
    <div class="container text-center">
        <h2>Conheça mais sobre a J6 Soluções Digitais</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ config("app.url") }}">Home</a></li>
            <li><span>Sobre nós</span></li>
        </ul><!-- /.thm-breadcrumb -->
    </div><!-- /.container text-center -->
</section><!-- /.page-header -->

<section class="portfolio-details">

    <div class="error-404__bubble-1"></div><!-- /.error-404__bubble-1 -->
    <div class="error-404__bubble-2"></div><!-- /.error-404__bubble-2 -->
    <div class="error-404__bubble-3"></div><!-- /.error-404__bubble-3 -->
    <div class="error-404__bubble-4"></div><!-- /.error-404__bubble-4 -->
    <div class="error-404__bubble-5"></div><!-- /.error-404__bubble-5 -->
    <div class="error-404__bubble-6"></div><!-- /.error-404__bubble-6 -->
    <div class="error-404__bubble-7"></div><!-- /.error-404__bubble-7 -->
    <div class="error-404__bubble-8"></div><!-- /.error-404__bubble-8 -->

    <div class="portfolio-details__image">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <img src="{{ asset("templates/inovex/images/portfolio/empresa-j6-solucoes-digitais.png") }}">
                </div><!-- /.col-lg-9 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.portfolio-details__image -->
    <div class="portfolio-details__main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="portfolio-details__content">
                        <h3>Um pouco mais sobre a J6</h3>
                        <p>Somos uma Agência digital com foco no posicionamento online dos nossos clientes. Somamos experiência e soluções que profissionalizam e trazem resultados para muitas empresas.</p>
                        <p>Iniciamos nossas atividades em 2022, mas nossa experiência no mercado é desde 2004.
                            <br>
                            Foram muitos desafios nesses anos com programação web, sites profissionais, identidades visuais, startups, portais web. Tendo participado de grandes projetos a jobs menores.
                        </p>
                        <p>Hoje entramos no mercado para fazer a diferença, e executar um serviço de qualidade e comprometimento.</p>
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ asset("templates/inovex/images/portfolio/copo-cafe-j6.png") }}">
                            </div><!-- /.col-md-6 -->
                            <div class="col-md-6">
                                <img src="{{ asset("templates/inovex/images/portfolio/mulher-camisa-j6.png") }}">
                            </div><!-- /.col-md-6 -->
                        </div><!-- /.row -->
                        <p>
                            Já tivemos o prazer de atender clientes de muitas áreas diferentes, e com isso criamos várias soluções digitais, que são serviços profissionais a um ótimo custo benefício.
                            Hoje atendemos desde de micro empreendedores, a grande empresas.
                        </p>
                        <p>Entre em contato conosco e traga já a sua empresa para J6, e faça ela decolar como um foguete!</p>
                    </div><!-- /.portfolio-details__content -->
                </div><!-- /.col-lg-8 -->
                <div class="col-lg-4 wow fadeInRight" data-wow-duration="1500ms">
                    <div class="portfolio-details__info">
                        <h3>Informações da J6</h3>
                        <div class="portfolio-details__info-single">
                            <div class="portfolio-details__info-title">
                                <i class="far fa-calendar-alt"></i>
                                <span>Inicio :</span>
                            </div><!-- /.portfolio-details__info-title -->
                            <div class="portfolio-details__info-text">
                                <p>Ano de 2002</p>
                            </div><!-- /.portfolio-details__info-text -->
                        </div><!-- /.portfolio-details__info-single -->
                        <div class="portfolio-details__info-single">
                            <div class="portfolio-details__info-title">
                                <i class="far fa-map-marker-alt"></i>
                                <span>Local :</span>
                            </div><!-- /.portfolio-details__info-title -->
                            <div class="portfolio-details__info-text">
                                <p>Balneário Piçarras, SC</p>
                            </div><!-- /.portfolio-details__info-text -->
                        </div><!-- /.portfolio-details__info-single -->
                        <div class="portfolio-details__info-single">
                            <div class="portfolio-details__info-title">
                                <i class="far fa-tag"></i>
                                <span>Soluções :</span>
                            </div><!-- /.portfolio-details__info-title -->
                            <div class="portfolio-details__info-text">
                                <p>Criação de Sites <br> Sistemas Web<br> SEO Google<br> Redes Sociais<br> Artes Offline</p>
                            </div><!-- /.portfolio-details__info-text -->
                        </div><!-- /.portfolio-details__info-single -->
                    </div><!-- /.portfolio-details__info -->
                </div><!-- /.col-lg-4 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.portfolio-details__main -->
</section><!-- /.portfolio-details -->
    
@endsection