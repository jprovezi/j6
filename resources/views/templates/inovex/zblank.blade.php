@extends('templates.inovex.main')
@section('title','aqui o title')
@section('description','aqui a descrição')
@section('content')
<section class="page-header">
    <div class="particles-snow" id="header-snow"></div><!-- /#header-snow.particles-snow -->

    <img src="assets/images/shapes/page-header-shape-1-1.png" class="page-header__bg-shape-1" alt="">
    <img src="assets/images/shapes/page-header-shape-1-2.png" class="page-header__bg-shape-2" alt="">
    <img src="assets/images/shapes/footer-shape-1-1.png" class="page-header__bg-shape-3" alt="">
    <img src="assets/images/shapes/footer-shape-1-3.png" class="page-header__bg-shape-4" alt="">
    <div class="container text-center">
        <h2>TITULO AQUI</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ config("app.url") }}">Home</a></li>
            <li><span>PAG AQUI</span></li>
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

    content aqui ....
    

</section><!-- /.error-404 -->        
@endsection