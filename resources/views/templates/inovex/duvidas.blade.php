@extends('templates.inovex.main')
@section('title','Principais dúvidas respondidas pela - J6 Soluções Digitais')
@section('description','Nessa página você irá encontrar algumas das principais dúvidas da nossa empresa, todas respondidas.')
@section('menuSolucoes')
    @foreach ($solucoes as $item)
        <li><a href="{{ $item["url-single"] }}">{{ $item["titulo"] }}</a></li>
    @endforeach
@endsection
@section('content')
<section class="page-header">
    <div class="particles-snow" id="header-snow"></div><!-- /#header-snow.particles-snow -->

    <div class="container text-center">
        <h2>Dúvidas</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ config("app.url") }}">Home</a></li>
            <li><span>Dúvidas</span></li>
        </ul><!-- /.thm-breadcrumb -->
    </div><!-- /.container text-center -->
</section><!-- /.page-header -->
  

<section class="faq-one">
    <div class="container">
        <div class="block-title text-center">
            <p><span>Dúvidas</span></p>
            <h3>Abaixo muitas dúvidas <br> <span>Já respondidas.</span></h3>
        </div><!-- /.block-title text-center -->

        <div class="row high-gutters">
            <div class="col-lg-6">
                <div class="accrodion-grp" data-grp-name="career-one__accrodion">
                    @foreach ($duvidas[0] as $item)
                        <div class="accrodion {{ $item["active"] }}">
                            <div class="accrodion-title">
                                <h4>{{ $item["pergunta"] }} </h4>
                            </div>
                            <div class="accrodion-content">
                                <div class="inner">
                                    <p>{{ $item["resposta"] }}</p>
                                </div><!-- /.inner -->
                            </div>
                        </div>
                    @endforeach
                </div>
            </div><!-- /.col-lg-6 -->
            <div class="col-lg-6">
                <div class="accrodion-grp" data-grp-name="career-one__accrodion-2">
                    @foreach ($duvidas[1] as $item)
                    <div class="accrodion {{ $item["active"] }}">
                        <div class="accrodion-title">
                            <h4>{{ $item["pergunta"] }}</h4>
                        </div>
                        <div class="accrodion-content">
                            <div class="inner">
                                <p>{{ $item["resposta"] }}</p>
                            </div><!-- /.inner -->
                        </div>
                    </div>
                    @endforeach
                </div>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.faq-one -->

@endsection