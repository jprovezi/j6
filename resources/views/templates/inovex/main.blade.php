<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="J6 Soluções Digitais">
    <!-- favicons -->
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset("templates/inovex/images/favicons/favicon.png")}}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Roboto:ital,wght@0,300;0,400;0,500;0,700;1,400;1,500;1,700&display=swap">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/animate.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/bootstrap-datepicker.min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/bootstrap-select.min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/fontawesome-all.min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/hover-min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/swiper.min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/jquery.mCustomScrollbar.min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/magnific-popup.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/owl.theme.default.min.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/plugins/lightbox2/dist/css/lightbox.min.css")}}">
    
    <!-- Template Styles -->
    <link rel="stylesheet" href="{{asset("templates/inovex/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("templates/inovex/css/responsive.css")}}">

</head>

<body>

    <div class="preloader">
        <div class="lds-ripple">
            <div></div>
            <div></div>
        </div>
    </div><!-- /.preloader -->

    <div class="page-wrapper">

        <nav class="main-nav-one stricky">
            <div class="container-fluid">
                <div class="inner-container">
                    <div class="logo-box">
                        <a href="{{ config("app.url"); }}">
                            <img src="{{asset("templates/inovex/images/logo-1-2.png")}}">
                        </a>
                        <a href="#" class="side-menu__toggler"><i class="fa fa-bars"></i></a>
                    </div><!-- /.logo-box -->
                    <div class="main-nav__main-navigation">
                        <ul class="main-nav__navigation-box">
                            <li><a href="<?=config("app.url"); ?>/sobre">Sobre nós</a></li>
                            <li class="dropdown">
                                <a href="<?=config("app.url"); ?>/solucoes">Nossas Soluções</a>
                                <ul>
                                    @yield('menuSolucoes')
                                </ul>
                            </li>
                            <li><a href="<?=config("app.url"); ?>/portfolio">Portfólio</a></li>
                            <li><a href="<?=config("app.url"); ?>/duvidas">Dúvidas</a></li>
                        </ul><!-- /.main-nav__navigation-box -->
                    </div><!-- /.main-nav__main-navigation -->
                    <div class="main-nav__right">
                        <!--<a href="#" class="search-popup__toggler main-nav__search"><i class="far fa-search"></i></a>-->
                        <a href="{{ config("app.url"); }}/fale-conosco" class="thm-btn main-nav-one__btn"><span>Fale Conosco</span></a>
                        <!-- /.thm-btn main-nav-one__btn -->
                    </div><!-- /.main-nav__right -->
                </div><!-- /.inner-container -->
            </div><!-- /.container-fluid -->
        </nav><!-- /.main-nav-one -->

        @yield('content')

        <footer class="site-footer site-footer__home-three" style="margin-top: 70px;">

            <div class="site-footer__upper">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget footer-widget__about">
                                <h3 class="footer-widget__title">Sobre</h3>
                                <p>Nosso foco é levar a melhor solução digital para nossos clientes, com serviço de excelência e valores justo.</p>
                                <div class="footer-widget__social">
                                    <a href="https://www.google.com/search?q=j6+solucoes+digitais&rlz=1C1GCEA_enBR1106BR1106&oq=j6+soluco&gs_lcrp=EgZjaHJvbWUqCAgAEEUYJxg7MggIABBFGCcYOzIGCAEQRRg5MgoIAhAAGIAEGKIEMgYIAxBFGDwyBggEEEUYPDIGCAUQRRg80gEIMjI4NWowajeoAgCwAgA&sourceid=chrome&ie=UTF-8"><i class="fab fa-google-plus"></i></a>
                                    <a href="https://www.facebook.com/j6solucoesdigitais"><i class="fab fa-facebook-f"></i></a>
                                    <a href="https://www.instagram.com/j6solucoesdigitais"><i class="fab fa-instagram"></i></a>
                                    <a href="https://www.linkedin.com/company/j6solucoesdigitais/?viewAsMember=true"><i class="fab fa-linkedin"></i></a>                            
                                </div><!-- /.footer-widget__social -->
                            </div><!-- /.footer-widget footer-widget__about -->
                        </div><!-- /.col-lg-3 col-md-6 col-sm-12 -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget footer-widget__links__1">
                                <h3 class="footer-widget__title">Soluções</h3>
                                <ul class="list-unstyled footer-widget__links-list">
                                    @yield('menuSolucoes')
                                </ul><!-- /.list-unstyled footer-widget__links-list -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-lg-3 col-md-6 col-sm-12 -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget footer-widget__links__2">
                                <h3 class="footer-widget__title">Acessos</h3>
                                <ul class="list-unstyled footer-widget__links-list">
                                    <li><a href="{{ route('site.sobre') }}">Sobre nós</a></li>
                                    <li><a href="{{ route('site.portfolio') }}">Portfólio</a></li>
                                    <li><a href="{{ route('site.duvidas') }}">Dúvidas</a></li>
                                    <li><a href="{{ route('site.faleconosco') }}">Fale conosco</a></li>
                                </ul><!-- /.list-unstyled footer-widget__links-list -->
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-lg-3 col-md-6 col-sm-12 -->
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <div class="footer-widget footer-widget__contact">
                                <h3 class="footer-widget__title">Contato</h3>
                                <p>Balneário Piçarras <br> Santa Catarina, BR</p>
                                <p><a href="mailto:diretoria@j6.net.br">joao@j6solucoesdigitais.com.br</a></p>
                                <p><a href="https://whatsa.me/5547997758281/?t=Ol%C3%A1%20J6%20Solu%C3%A7%C3%B5es%20Digitais,%20preciso%20de%20uma%20ajuda.">+55 47 9 9775-8281</a></p>
                            </div><!-- /.footer-widget -->
                        </div><!-- /.col-lg-3 col-md-6 col-sm-12 -->
                    </div><!-- /.row -->
                </div><!-- /.container -->
        
            </div><!-- /.site-footer__upper -->
            <div class="site-footer__bottom">
                <div class="container">
                    <p>® {{date("Y"); }} - J6 Soluções Digitais</p>
                    <a href="index.html"><img src="{{asset("templates/inovex/images/logo-1-1.png")}}"></a>
                    <ul class="list-unstyled site-footer__bottom-menu">
                        <li><a href="javascript:void(0);">CNPJ: 47.189.708.0001-04 </a></li>
                    </ul><!-- /.list-unstyled site-footer__bottom-menu -->
                </div><!-- /.container -->
            </div><!-- /.site-footer__bottom -->
        
        </footer><!-- /.site-footer -->

    </div><!-- /.page-wrapper -->


    <div class="side-menu__block">

        <a href="#" class="side-menu__toggler side-menu__close-btn"><i class="fa fa-times"></i>
            <!-- /.fa fa-close --></a>
    
        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.side-menu__block-overlay -->
        <div class="side-menu__block-inner ">
    
            <a href="index.html" class="side-menu__logo"><img src="{{asset("templates/inovex/images/logo-1-1.png")}}"></a>
            <nav class="mobile-nav__container">
                <!-- content is loading via js -->
            </nav>
            <p class="side-menu__block__copy">® <?=date("Y"); ?> - <a href="{{ config('app.url') }}">J6 Soluções Digitais</a></p>
            <div class="side-menu__social">
                <a href="https://www.google.com/search?q=j6+solucoes+digitais&rlz=1C1GCEA_enBR1106BR1106&oq=j6+soluco&gs_lcrp=EgZjaHJvbWUqCAgAEEUYJxg7MggIABBFGCcYOzIGCAEQRRg5MgoIAhAAGIAEGKIEMgYIAxBFGDwyBggEEEUYPDIGCAUQRRg80gEIMjI4NWowajeoAgCwAgA&sourceid=chrome&ie=UTF-8"><i class="fab fa-google-plus"></i></a>
                <a href="https://www.facebook.com/j6solucoesdigitais"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/j6solucoesdigitais"><i class="fab fa-instagram"></i></a>
                <a href="https://www.linkedin.com/company/j6solucoesdigitais"><i class="fab fa-linkedin"></i></a>            </div>
        </div><!-- /.side-menu__block-inner -->
    </div><!-- /.side-menu__block -->
    
    <div class="search-popup">
        <div class="search-popup__overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.search-popup__overlay -->
        <div class="search-popup__inner">
            <form action="#" class="search-popup__form">
                <input type="text" name="search" placeholder="Escreva para procurar algo....">
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
        </div><!-- /.search-popup__inner -->
    </div><!-- /.search-popup -->
    
    <div id="hi-whatsapp" onclick="location.href='https://whatsa.me/5547997758281/?t=Ol%C3%A1%20J6%20Solu%C3%A7%C3%B5es%20Digitais,%20preciso%20de%20uma%20ajuda.'">
        <i class="fab fa-whatsapp"></i>
    </div>
    
    <!-- template scripts -->
    <script src="{{asset("templates/inovex/js/jquery.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/bootstrap-datepicker.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/bootstrap-select.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/isotope.js")}}"></script>
    <script src="{{asset("templates/inovex/js/jquery.ajaxchimp.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/jquery.circleType.js")}}"></script>
    <script src="{{asset("templates/inovex/js/waypoints.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/jquery.counterup.min.js")}}"></script>
    <!--<script src="{{{asset("templates/inovex/js/jquery.lettering.min.js")}}}/"></script>-->
    <script src="{{asset("templates/inovex/js/jquery.magnific-popup.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/jquery.mCustomScrollbar.concat.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/jquery.validate.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/owl.carousel.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/TweenMax.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/wow.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/swiper.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/particles.min.js")}}"></script>
    <script src="{{asset("templates/inovex/js/particel-config.js")}}"></script>
    <script src="{{asset("templates/inovex/js/theme.js")}}"></script>
    <script src="{{asset("templates/inovex/plugins/lightbox2/dist/js/lightbox.min.js")}}"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.img-responsive').on("click", function() {
                $(this).toggleClass('maxSize')
            });
        });
    </script>    
</body>

</html>