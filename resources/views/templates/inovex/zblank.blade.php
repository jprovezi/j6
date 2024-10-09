@extends('templates.inovex.main')
@section('title','aqui o title')
@section('description','aqui a descrição')
@section('menuSolucoes')
    @foreach ($solucoes as $item)
        <li><a href="{{ $item["url-single"] }}">{{ $item["titulo"] }}</a></li>
    @endforeach
@endsection
@section('content')
<section class="page-header">
    <div class="particles-snow" id="header-snow"></div><!-- /#header-snow.particles-snow -->

    <div class="container text-center">
        <h2>TITULO AQUI</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ config("app.url") }}">Home</a></li>
            <li><span>PAG AQUI</span></li>
        </ul><!-- /.thm-breadcrumb -->
    </div><!-- /.container text-center -->
</section><!-- /.page-header -->
  
@endsection