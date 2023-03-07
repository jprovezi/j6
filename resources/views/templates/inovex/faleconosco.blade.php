@extends('templates.inovex.main')
@section('title','Fale Conosco e tire suas dúvidas - J6 Soluções Digitais')
@section('description','Para dúvidas, orçamentos, sugestões e suporte, entre em contato conosco, que lhe responderemos o mais breve possível')
@section('menuSolucoes')
    @foreach ($solucoes as $item)
        <li><a href="{{ $item["url-single"] }}">{{ $item["titulo"] }}</a></li>
    @endforeach
@endsection
@section('content')
<section class="page-header">
    <div class="particles-snow" id="header-snow"></div><!-- /#header-snow.particles-snow -->

    <div class="container text-center">
        <h2>Fale Conosco</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{ config("app.url") }}">Home</a></li>
            <li><span>Fale Conosco</span></li>
        </ul><!-- /.thm-breadcrumb -->
    </div><!-- /.container text-center -->
</section><!-- /.page-header -->
  
<section class="contact-two" style="margin: -100px 0 0 0;">
    <div class="contact-two__bubble-1"></div><!-- /.contact-two__bubble-1 -->
    <div class="contact-two__bubble-2"></div><!-- /.contact-two__bubble-2 -->
    <div class="contact-two__bubble-3"></div><!-- /.contact-two__bubble-3 -->
    <div class="contact-two__bubble-4"></div><!-- /.contact-two__bubble-4 -->
    <div class="contact-two__bubble-5"></div><!-- /.contact-two__bubble-5 -->
    <div class="contact-two__bubble-6"></div><!-- /.contact-two__bubble-6 -->
    <div class="contact-two__bubble-7"></div><!-- /.contact-two__bubble-7 -->
    <div class="contact-two__bubble-8"></div><!-- /.contact-two__bubble-8 -->

    <div class="container">
        <div class="row">
            <div class="col-xl-5">
                <div class="contact-two__info">
                    <h3>Dados de contato</h3>
                    <div class="contact-two__info-single">
                        <div class="contact-two__info-icon">
                            <i class="fa fa-map-marker"></i>
                        </div><!-- /.contact-two__info-icon -->
                        <div class="contact-two__info-content">
                            <h4>Atendimento</h4>
                            <p>Seg à Sex das 08:00 às 18:00 <br> Sab das 08:00 às 12:00</p>
                        </div><!-- /.contact-two__info-content -->
                    </div><!-- /.contact-two__info-single -->
                    <div class="contact-two__info-single">
                        <div class="contact-two__info-icon">
                            <i class="fa fa-phone"></i>
                        </div><!-- /.contact-two__info-icon -->
                        <div class="contact-two__info-content">
                            <h4>Telefone</h4>
                            <p><a href="tel:+5547997758281">(47)99775-8281</a></p>
                        </div><!-- /.contact-two__info-content -->
                    </div><!-- /.contact-two__info-single -->
                    <div class="contact-two__info-single">
                        <div class="contact-two__info-icon">
                            <i class="fa fa-envelope"></i>
                        </div><!-- /.contact-two__info-icon -->
                        <div class="contact-two__info-content">
                            <h4>Email</h4>
                            <p><a href="mailto:diretoria@j6.net.br">diretoria@j6.net.br</a></p>
                        </div><!-- /.contact-two__info-content -->
                    </div><!-- /.contact-two__info-single -->
                </div><!-- /.contact-two__info -->
            </div><!-- /.col-xl-5 -->
            <div class="col-xl-7">
                <div class="contact-two__form-wrap">
                    <h3>Nos envie uma mensagem</h3>

                    <a href="#" name="form"></a>
                    <form action="{{ route('contato.store') }}" class="contact-one__form" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" placeholder="Nome Completo *" name="nome">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Email *" name="email">
                            </div>
                            <div class="col-md-6">
                                <input type="text" placeholder="Telefone *" name="telefone">
                            </div>
                            <div class="col-md-12">
                                <textarea name="mensagem" placeholder="Mensagem *" name="mensagem"></textarea>
                            </div>
                            <div class="col-md-12 text-left">
                                <button type="submit" class="thm-btn contact-one__btn">Enviar</button>
                            </div>
                            @if (session('ok'))
                            <div class="alert alert-success col-md-12 text-left" role="alert" style="margin: 20px 0 0 0;">
                                <h4 class="alert-heading">Sucesso</h4>
                                <p>{{ session('ok') }}</p>
                            </div>
                            @endif

                            @if (session('status'))
                            <div class="alert alert-warning col-md-12 text-left" role="alert" style="margin: 20px 0 0 0;">
                                <h4 class="alert-heading">Aviso</h4>
                                <p>{{ session('status') }}</p>
                            </div>
                            @endif                                
                        </div>
                    </form>

                </div><!-- /.contact-two__form-wrap -->
            </div><!-- /.col-xl-7 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</section><!-- /.contact-two -->


@endsection