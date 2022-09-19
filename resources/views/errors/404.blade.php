@extends('templates.inovex.main')

@section('title','J6 Soluções Digitais - Página não encontrada')
@section('description','Posts Para Redes Sociais, Artes Digitais, Criação de Sites e muito mais confira.')

@section('content')
<section class="page-header">
    <div class="particles-snow" id="header-snow"></div><!-- /#header-snow.particles-snow -->

    <img src="assets/images/shapes/page-header-shape-1-1.png" class="page-header__bg-shape-1" alt="">
    <img src="assets/images/shapes/page-header-shape-1-2.png" class="page-header__bg-shape-2" alt="">
    <img src="assets/images/shapes/footer-shape-1-1.png" class="page-header__bg-shape-3" alt="">
    <img src="assets/images/shapes/footer-shape-1-3.png" class="page-header__bg-shape-4" alt="">
    <div class="container text-center">
        <h2>Página não encontrada</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ config("app.url") }}">Home</a></li>
            <li><span>404 Notfound</span></li>
        </ul><!-- /.thm-breadcrumb -->
    </div><!-- /.container text-center -->
</section><!-- /.page-header -->

<section class="error-404">
    <img src="assets/images/shapes/bg-shape-1-1.png" class="error-404__bg-shape-1" alt="">
    <img src="assets/images/shapes/bg-shape-1-2.png" class="error-404__bg-shape-2" alt="">
    <img src="assets/images/shapes/bg-shape-1-3.png" class="error-404__bg-shape-3" alt="">


    <div class="error-404__bubble-1"></div><!-- /.error-404__bubble-1 -->
    <div class="error-404__bubble-2"></div><!-- /.error-404__bubble-2 -->
    <div class="error-404__bubble-3"></div><!-- /.error-404__bubble-3 -->
    <div class="error-404__bubble-4"></div><!-- /.error-404__bubble-4 -->
    <div class="error-404__bubble-5"></div><!-- /.error-404__bubble-5 -->
    <div class="error-404__bubble-6"></div><!-- /.error-404__bubble-6 -->
    <div class="error-404__bubble-7"></div><!-- /.error-404__bubble-7 -->
    <div class="error-404__bubble-8"></div><!-- /.error-404__bubble-8 -->
    <div class="container text-center">
        <h3>404</h3>
        <h4>Oops, A página que você tentou acessar, foi engolida por um buraco negro!</h4>
        <a href="{{ config("app.url") }}" class="thm-btn error-404__btn">Voltar para o site</a><!-- /.thm-btn error-404__btn -->
    </div><!-- /.container -->
</section><!-- /.error-404 -->     
@endsection
