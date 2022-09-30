@extends('templates.inovex.main')
@section('title','Veja um pouco do nosso trabalho - J6 Soluções Digitais')
@section('description','Sites incríveis, artes digitais, Posts para redes sociais, Marketing Digital e muito mais confira.')
@section('content')
<section class="page-header">

    <div class="container text-center">
        <h2>Portfólio</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ config("app.url") }}">Home</a></li>
            <li><span>Portfólio</span></li>
        </ul><!-- /.thm-breadcrumb -->
    </div><!-- /.container text-center -->
</section><!-- /.page-header -->


<section class="portfolio-grid" style="margin: -150px 0 0 0;">
    <div class="container">
        <div class="block-title text-center">
            <p class="color-2"><span>Portfolio</span></p>
            <h3>Um pedacinho da galáxia <br> <span>& Alguns jobs nossos</span></h3>
        </div><!-- /.block-title text-center -->
        <ul class="portfolio-filter list-unstyled post-filter ">
            <li data-filter=".filter-item" class="active"><span>Todos</span></li>
            @foreach ($menu as $itemMenu)
            <li data-filter=".{{ $itemMenu["tag"] }}"><span>{{ $itemMenu["titulo"] }}</span></li>
            @endforeach
        </ul><!-- /.portfolio-filter list-unstyled -->
        <div class="row high-gutters masonary-layout filter-layout">
            @foreach ($portfolio as $itemPortfolio)
                <div class="col-lg-4 col-md-6 col-sm-12 filter-item masonary-item  {{ $itemPortfolio["menu"]["tag"] }}">
                    <div class="portfolio-one__single">
                        <div class="portfolio-one__image">
                            <img src="{{ asset('j6/thumb/'.$itemPortfolio["img"]) }}">
                            <a href="{{ asset('j6/'.$itemPortfolio["img"]) }}" data-lightbox="{{ $itemPortfolio["menu"]["tag"] }}">
                                <i class="fal fa-plus"></i>
                            </a>
                        </div>
                        <div class="portfolio-one__content">
                            <h3><a href="javascript:void(0)">{{ $itemPortfolio["titulo"] }}</a></h3>
                            <p>{{ $itemPortfolio["menu"]["titulo"] }}</p>
                        </div>
                    </div>
                </div><!-- final sessao -->
            @endforeach
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.portfolio-grid -->
    
@endsection