@extends('templates.inovex.main')
@section('title', $seo['titulo'])
@section('description', $seo['descricao'])
@section('menuSolucoes')
    @foreach ($solucoes as $item)
        <li><a href="{{ $item["url-single"] }}">{{ $item["titulo"] }}</a></li>
    @endforeach
@endsection
@section('content')
    <section class="page-header">
        <div class="particles-snow" id="header-snow"></div><!-- /#header-snow.particles-snow -->
        <div class="container text-center">
            <h2>{{ $info['titulo'] }}</h2>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="{{ config('app.url') }}">Home</a></li>
                <li><a href="{{ config('app.url') }}/solucoes">Soluções</a></li>
                <li><span>{{ $info['titulo'] }}</span></li>
            </ul><!-- /.thm-breadcrumb -->
        </div><!-- /.container text-center -->
    </section><!-- /.page-header -->

    <section class="service-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="sidebar sidebar__left">
                        <div class="sidebar__single sidebar__category">
                            <ul class="list-unstyled sidebar__category-list">
                                @foreach ($solucoes as $item)
                                    <li class="{{ $item['active'] }}">
                                        <a href="{{ $item['url-single'] }}">{{ $item['titulo'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- /.sidebar__single -->
                        <div class="sidebar__single sidebar__contact">
                            <h3 class="sidebar__title">Contato</h3>
                            <ul class="list-unstyled sidebar__contact-list">
                                <li>
                                    <i class="fa fa-map-marker-alt"></i>
                                    Balneário Piçarras, SC
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:diretoria@j6.net.br">diretoria@j6.net.br</a>
                                </li>
                                <li>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:+5547997758281">+55 (47)997758281</a>
                                </li>
                            </ul>
                        </div><!-- /.sidebar__single -->
                        <div class="sidebar__single sidebar__brouchers">
                            <h3 class="sidebar__title">Material Extra</h3>
                            <ul class="list-unstyled sidebar__category-list">
                                <li>
                                    <a href="{{ asset('templates/inovex/pdf/apresentacao.pdf') }}" target="_blank">Apresentação em PDF <i
                                            class="far fa-file-pdf"></i></a>
                                </li>
                            </ul><!-- /.list-unstyled sidebar__category-list -->
                        </div><!-- /.sidebar__single -->
                    </div><!-- /.sidebar -->
                </div><!-- /.col-lg-4 -->
                <div class="col-lg-8">
                    <div class="service-details__main">
                        <div class="service-details__image">
                            <img src={{ asset('j6/' . $info['capa']) }} />
                        </div><!-- /.service-details__image -->
                        <div class="service-details__content">
                            <h3>{{ $info['titulo'] }}</h3>
                            <p>{!! $info["descricao"] !!}</p>
                            <ul class="service-details__list list-unstyled">
                                @foreach ($info["destaques"] as $destaques)
                                <li><i class="fa fa-check-circle"></i>{{ $destaques }}</li>
                                @endforeach
                            </ul><!-- /.service-details__list list-unstyled -->
                            <br>
                            <div class="row">
                                @foreach ($info["img-exemplo"] as $img)
                                <div class="col-md-6">
                                    <a href="{{ asset('j6/'.$img) }}" data-lightbox="image">
                                        <img src="{{ asset('j6/'.$img) }}" class="img-responsive" style="margin-top: 0px;">
                                    </a>
                                </div><!-- /.col-lg-6 -->                                    
                                @endforeach
                            </div><!-- /.row -->
                            <br>
                            <p class="destaque">Todas as nossas soluções são de alta qualidade, faça como muitas empresas e posicione o seu negócio no mundo digital.</p>
                            <p>
                                <button class="btn btn-primary" onclick="document.location.href='{{ route('site.faleconosco') }}'">Fale Conosco</button>
                            </p>
                        </div><!-- /.service-details__content -->
                    </div><!-- /.service-details__main -->
                </div><!-- /.col-lg-8 -->

            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.blog-standard -->
 
@endsection
