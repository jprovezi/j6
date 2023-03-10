@extends("templates.inovex.main")

@section('title','J6 Soluções Digitais')
@section('description','Somos uma agência com soluções digitais para o seu negócio. Redes Sociais, Sites e muito mais confira.')

@section('menuSolucoes')
    @foreach ($solucoes as $item)
        <li><a href="{{ $item["url-single"] }}">{{ $item["titulo"] }}</a></li>
    @endforeach
@endsection

@section('content')
    <section class="banner-one">
        <div class="particles-snow" id="banner-one-snow"></div><!-- /#cta-one-snow.particles-snow -->
        <div class="container">
            <div class="banner-one__image wow slideInUp" data-wow-duration="1500ms">
            <img src="{{ asset("templates/inovex/images/shapes/foguete-1.png") }}" class="banner-one__bg-shape-2">
            <img src="{{ asset("templates/inovex/images/shapes/planeta-4.png") }}" class="banner-one__bg-shape-3">
            <img src="{{ asset("templates/inovex/images/shapes/planeta-5.png") }}" class="banner-one__bg-shape-5">
            </div><!-- /.banner-one__image -->
            <div class="row">
                <div class="col-xl-7">
                    <div class="banner-one__content">
                        <h3>Soluções Digitais para sua <span class="cor-destaque">empresa decolar</span> como um foguete.</h3>
                    </div><!-- /.banner-one__content -->
                </div><!-- /.col-lg-7 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </section><!-- /.banner-one --> 

<section class="brand-one brand-one__pricing-page brand-one__home-three" style="margin-top: 70px;">
    <div class="container">
        <div class="block-title text-center">
            <p class="color-2"><span>Clientes</span></p>
            <h3>Faça como muitas empresas <br> <span>que confiaram na J6 Soluções Digitais</span></h3>
        </div><!-- /.block-title text-center -->

        <div class="brand-one__carousel owl-carousel thm__owl-carousel owl-theme" data-options='{
            "items": 5, "margin": 95, "smartSpeed": 700, "loop": true, "autoplay": true, "autoplayTimeout": 5000, "autoplayHoverPause": false, "nav": false, "dots": false, "responsive": {"0": { "margin": 20, "items": 2 }, "575": { "margin": 30, "items": 3 },"767": { "margin": 40, "items": 4 },   "991": { "margin": 70, "items": 4 }, "1199": { "margin": 95, "items": 5 } } }'>
            @foreach ($clientes as $item)
                <div class="item">
                    <img src="{{ asset("j6/clientes/".$item["img"]) }}" title="{{ $item["nome"] }}">
                </div><!-- /.item -->                
            @endforeach
        </div><!-- /.brand-one__carousel owl-carousel thm__owl-carousel owl-theme -->
    </div><!-- /.container -->
</section><!-- /.brand-one -->    

<section class="about-one">
    <img src="{{ asset("templates/inovex/images/shapes/bg-shape-1-1.png") }}" class="error-404__bg-shape-1">
    <img src="{{ asset("templates/inovex/images/shapes/bg-shape-1-2.png") }}" class="error-404__bg-shape-2">
    <img src="{{ asset("templates/inovex/images/shapes/bg-shape-1-3.png") }}" class="error-404__bg-shape-3">

    <div class="error-404__bubble-1"></div><!-- /.error-404__bubble-1 -->
    <div class="error-404__bubble-2"></div><!-- /.error-404__bubble-2 -->
    <div class="error-404__bubble-3"></div><!-- /.error-404__bubble-3 -->
    <div class="error-404__bubble-4"></div><!-- /.error-404__bubble-4 -->
    <div class="error-404__bubble-5"></div><!-- /.error-404__bubble-5 -->
    <div class="error-404__bubble-6"></div><!-- /.error-404__bubble-6 -->
    <div class="error-404__bubble-7"></div><!-- /.error-404__bubble-7 -->
    <div class="error-404__bubble-8"></div><!-- /.error-404__bubble-8 -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about-one__content">
                    <div class="block-title text-left">
                        <p class="color-2"><span>Porque nos escolher?</span></p>
                        <h3>A galáxia é grande... <br> <span>Então porque nos escolher?</span></h3>
                    </div><!-- /.block-title text-center -->
                    <p>Separamos abaixo 3 bons motivos, para que a sua escolha seja a nossa empresa.</p>
                    <div class="about-one__box-wrapper">
                        <div class="about-one__box">
                            <div class="about-one__box-icon">
                                <i class="fa fa-check"></i>
                            </div><!-- /.about-one__box-icon -->
                            <div class="about-one__box-content">
                                <h3>Qualidade e Profissionalismo</h3>
                                <p>Não economizamos quando o assunto é entregar serviço de extrema qualidade e profissionalismo.</p>
                            </div><!-- /.about-one__box-content -->
                        </div><!-- /.about-one__box -->
                        <div class="about-one__box">
                            <div class="about-one__box-icon">
                                <i class="fa fa-check"></i>
                            </div><!-- /.about-one__box-icon -->
                            <div class="about-one__box-content">
                                <h3>Personalizamos o trabalho para a sua necessidade</h3>
                                <p>Nosso trabalho é em cima da necessidade de cada empresa e cliente, levando assim sempre a melhor solução digital.</p>
                            </div><!-- /.about-one__box-content -->
                        </div><!-- /.about-one__box -->
                        <div class="about-one__box">
                            <div class="about-one__box-icon">
                                <i class="fa fa-check"></i>
                            </div><!-- /.about-one__box-icon -->
                            <div class="about-one__box-content">
                                <h3>Atendimento diferenciado</h3>
                                <p>Nosso atendimento é diferenciado, exclusivo aos nossos clientes e amigos.</p>
                            </div><!-- /.about-one__box-content -->
                        </div><!-- /.about-one__box -->
                    </div><!-- /.about-one__box-wrapper -->
                </div><!-- /.about-one__content -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6 d-flex">
                <div class="my-auto">
                    <div class="about-one__image wow slideInDown" data-wow-duration="1500ms">
                        <img src="templates/inovex/images/mocups/about-1-moc-1.png" alt="">
                    </div><!-- /.about-one__image -->
                </div><!-- /.my-auto -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.about-one -->

<section class="service-one service-one__home-three">
    <img src="{{ asset("templates/inovex/images/shapes/service-1-h3-shape-1.png") }}" class="service-one__home-three__bg-1">
    <img src="{{ asset("templates/inovex/images/shapes/service-1-h3-shape-2.png") }}" class="service-one__home-three__bg-2">
    <img src="{{ asset("templates/inovex/images/shapes/service-1-h3-shape-3.png") }}" class="service-one__home-three__bg-3">
    <div class="container">
        <div class="block-title text-center">
            <p><span>Nossas Soluções</span></p>
            <h3>Qualidade em serviços digitais <br> <span>Além das estrelas</span></h3>
        </div><!-- /.block-title text-center -->
        <div class="row high-gutters">
            @foreach ($solucoes as $item)
            <div class="col-lg-6 col-md-12 wow fadeInLeft" data-wow-duration="1500ms">
                <div class="service-one__single">
                    <div class="service-one__icon">
                        <div class="">
                            <img src="{{asset("j6/".$item["img"]) }}">
                        </div><!-- /.service-one__icon-inner -->
                    </div><!-- /.service-one__icon -->
                    <div class="service-one__content">
                        <h3><a href="{{ $item["url-single"] }}">{{ $item["titulo"] }}</a></h3>
                        <p>{{ $item["descricao"] }}</p>
                    </div><!-- /.service-one__content -->
                </div><!-- /.service-one__single -->
            </div><!-- /.col-lg-6 col-md-12 -->                
            @endforeach
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.service-one -->

<section class="testimonials-one testimonials-one__about-one testimonials-one__home-three">
    <div class="container">
        <div class="block-title text-left">
            <p class="color-2"><span>Depoimentos</span></p>
            <h3>Alguns clientes <br> <span>muito além do universo.</span></h3>
        </div><!-- /.block-title text-center -->
        <div class="testimonials-one__carousel thm__owl-carousel owl-carousel owl-theme" data-options='{
                    "items": 3, "margin": 40, "smartSpeed": 700, "autoplay": true, "autoplayTimeout": 5000,
                    "autoplayHoverPause": true, "nav": false, "dots": false, "loop": true, "responsive": {
                        "0": { "items": 1, "margin": 0},
                        "767": { "items": 1, "margin": 0},
                        "991": { "items": 2, "margin": 40},
                        "1199": { "items": 2, "margin": 40},
                        "1200": { "items": 3, "margin": 40}
                    }
                }'>
                @foreach ($depoimentos as $item)
                    <div class="item">
                        <div class="testimonials-one__single">
                            <div class="testimonials-one__icon">
                                <img src="{{ asset("templates/inovex/images/shapes/testi-qoute-1-1.png") }}">
                            </div><!-- /.testimonials-one__icon -->
                            <p>{{ $item["depoimento"]; }}</p>
                            <h3>{{ $item["nome"]; }}</h3>
                        </div><!-- /.testimonials-one__single -->
                    </div><!-- /.item -->    
                @endforeach


        </div><!-- /.testimonials-one__carousel -->
    </div><!-- /.container -->
</section><!-- /.testimonials-one -->

<section class="faq-one__form-wrap faq-one__home-three faq-one">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="faq-one__form-image">
                    <img src="{{ asset("templates/inovex/images/mocups/faq-moc-1-1.png") }}">
                    <img src="{{ asset("templates/inovex/images/mocups/faq-moc-1-2.png") }}">
                </div><!-- /.faq-one__form-image -->
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6 d-flex">
                <div class="my-auto">
                    <div class="block-title text-left">
                        <p><span>Perguntas e Respostas</span></p>
                        <h3>Dúvidas Frequentes dos <br> <span>nossos clientes.</span></h3>
                    </div><!-- /.block-title text-center -->                 
                    <div class="accrodion-grp" data-grp-name="career-one__accrodion">
                        @foreach ($duvidas as $item)
                        <div class="accrodion {{ $item["active"]; }}">
                            <div class="accrodion-title">
                                <h4>{{ $item["pergunta"]; }}</h4>
                            </div>
                            <div class="accrodion-content">
                                <div class="inner">
                                    <p>{{ $item["resposta"]; }}</p>
                                </div><!-- /.inner -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div><!-- /.my-auto -->
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.faq-one__form-wrap -->

<!--
<section class="blog-one blog-one__home-one">
    <div class="container">
        <div class="blog-one__top">
            <div class="block-title text-left">
                <p><span>Blog</span></p>
                <h3>Learn Some New info from <br> <span>Our Latest News.</span></h3>
            </div>

            <div class="blog-one__carousel-btn">
                <a href="#" class="blog-one__carousel-btn-left"><i class="far fa-angle-left"></i></a>
                <a href="#" class="blog-one__carousel-btn-right"><i class="far fa-angle-right"></i></a>
            </div>
        </div>


        <div class="thm__owl-carousel blog-one__carousel owl-carousel owl-theme" data-carousel-prev-btn=".blog-one__carousel-btn-left" data-carousel-next-btn=".blog-one__carousel-btn-right" data-options='{
                    "items": 3, "margin": 40, "smartSpeed": 700, "autoplay": true, "autoplayTimeout": 5000,
                    "autoplayHoverPause": true, "nav": false, "dots": false, "loop": true, "responsive": {
                        "0": { "items": 1, "margin": 0},
                        "575": { "items": 1, "margin": 0},
                        "767": { "items": 1, "margin": 0},
                        "991": { "items": 2, "margin": 40},
                        "1199": { "items": 3, "margin": 40}
                    }
                }'>

            <div class="item">
                <div class="blog-one__single">
                    <div class="blog-one__image">
                        <img src="templates/inovex/images/blog/blog-1-1.jpg" alt="">
                        <a href="blog-details.html"><i class="fal fa-plus"></i></a>
                    </div>
                    <div class="blog-one__content">
                        <div class="blog-one__meta">
                            <a href="blog-details.html">Sara dodly</a>
                            <span>-</span>
                            <a href="blog-details.html">Mar 15, 2020</a>
                        </div>
                        <h3><a href="blog-details.html">Additional Services that will Grow Your...</a></h3>
                        <a href="blog-details.html" class="thm-btn blog-one__btn"><span>Read More</span></a>

                    </div>
                </div>
            </div>

    </div>
</section>-->
@endsection
