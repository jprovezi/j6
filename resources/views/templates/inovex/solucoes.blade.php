@extends('templates.inovex.main')
@section('title','J6 Soluções Digitais para a sua empresa')
@section('description','Posts para redes sociais, campanhas no google ads, artes digitais, site express, site personalizado')
@section('menuSolucoes')
    @foreach ($solucoes as $item)
        <li><a href="{{ $item["url-single"] }}">{{ $item["titulo"] }}</a></li>
    @endforeach
@endsection
@section('content')
<section class="page-header">
    <div class="particles-snow" id="header-snow"></div><!-- /#header-snow.particles-snow -->
    <div class="container text-center">
        <h2>Nossas Soluções</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ config("app.url") }}">Home</a></li>
            <li><span>Nossas Soluções</span></li>
        </ul><!-- /.thm-breadcrumb -->
    </div><!-- /.container text-center -->
</section><!-- /.page-header -->

<section class="service-one">
    <div class="container">
        <div class="block-title text-center">
            <p><span>Nossas Soluções</span></p>
            <h3>Soluções além das estrelas</h3>
        </div><!-- /.block-title text-center -->
        <div class="row high-gutters">
            @foreach ($solucoes as $item)
            <div class="col-lg-6 col-md-12 wow fadeInLeft" data-wow-duration="1500ms">
                <a href="{{ $item["url-single"] }}">
                    <div class="service-one__single">
                        <div class="service-one__icon">
                            <div class="">
                                <img src="{{ asset("j6/".$item["img"]) }}">
                            </div><!-- /.service-one__icon-inner -->
                        </div><!-- /.service-one__icon -->
                        <div class="service-one__content">
                            <h3>{{ $item["titulo"] }}</h3>
                            <p>{{ $item["descricao"] }}</p>
                        </div>
                    </div>
                </a>
            </div><!-- /.col-lg-6 col-md-12 -->                
            @endforeach
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.service-one -->

<section class="cta-one">
    <div class="particles-snow" id="cta-one-snow"></div><!-- /#cta-one-snow.particles-snow -->
    <div class="container">
        <h3>Quer conhecer um <br> <span>pouco mais das nossas soluções</span></h3>
        <a href="{{ asset("templates/inovex/pdf/apresentacao-j6.pdf") }}" class="thm-btn cta-one__btn" target="_blank">
            <span>Ver nossa apresentação em PDF</span>
        </a>
    </div><!-- /.container -->
</section><!-- /.cta-one -->

@endsection