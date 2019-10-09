<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Car-E</title>

    <!-- Favicon 
    <link rel="icon" href="img/core-img/favicon.ico">-->
    <link rel="icon" type="image/icon" href="{{  secure_asset('/landing/img/core-img/favicon.ico') }}"/>

    <!-- Core Stylesheet 
    <link href="style.css" rel="stylesheet">-->
    <link href="{{ secure_asset('/css/style.css') }}" rel="stylesheet" type="text/css" >

    <!-- Responsive CSS 
    <link href="css/responsive.css" rel="stylesheet">-->
    <link href="{{ secure_asset('/landing/css/slick.css') }}" rel="stylesheet" type="text/css" >

</head>

<body>
    <!-- Preloader Start -->
    <div id="preloader">
        <div class="colorlib-load"></div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <header class="header_area animated">
        <div class="container-fluid">
            <div class="row align-items-center">
                <!-- Menu Area Start -->
                <div class="col-12 col-lg-10">
                    <div class="menu_area">
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <!-- Logo -->
                            <a class="navbar-brand" href="#"></a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ca-navbar" aria-controls="ca-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                            <!-- Menu Area -->
                            <div class="collapse navbar-collapse" id="ca-navbar">
                                <ul class="navbar-nav ml-auto" id="nav">
                                    <li class="nav-item active"><a class="nav-link" href="#home">Inicio</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#about">Información</a></li>
                                    <!--<li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#screenshot">Screenshot</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#testimonials">Testimonials</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#team">Team</a></li>-->
                                    <li class="nav-item"><a class="nav-link" href="#contact">Contacto</a></li>
                                </ul>
                                <!--
                                <div class="sing-up-button d-lg-none">
                                    <a href="#">Sign Up Free</a>
                                </div>
                                -->
                            </div>
                        </nav>
                    </div>
                </div>
                <!-- Signup btn 
                <div class="col-12 col-lg-2">
                    <div class="sing-up-button d-none d-lg-block">
                        <a href="#">Sign Up Free</a>
                    </div>
                </div>-->
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Wellcome Area Start ***** -->
    <section class="wellcome_area clearfix" id="home">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12 col-md">
                    <div class="wellcome-heading">
                        <h2>Car-E app</h2>
                        <!--<h3>C</h3>-->
                        <p>Encuentra estacionamiento cuando y donde lo necesites</p>
                    </div>
                    <div class="get-start-area">
                        <!-- Form Start -->
                        <!--
                        <form action="#" method="post" class="form-inline">
                            <input type="email" class="form-control email" placeholder="name@company.com">
                            <input type="submit" class="submit" value="Get Started">
                        </form>-->
                        <!-- Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Welcome thumb -->
        <div class="welcome-thumb wow fadeInDown" data-wow-delay="0.5s">
            <!--<img src="../../public/landing/img/bg-img/welcome-img.png')" alt="">-->
            <img src="{{ asset('/landing/img/bg-img/welcome-img.png') }}" alt="background">
        </div>
    </section>
    <!-- ***** Wellcome Area End ***** -->

    <!-- ***** Special Area Start ***** -->
    <section class="special-area bg-white section_padding_100" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Section Heading Area -->
                    <div class="section-heading text-center">
                        <h2>Porque Car-E</h2>
                        <div class="line-shape"></div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.2s">
                        <div class="single-icon">
                            <img src="{{ asset('/dist/img/ico_searcher.png') }}" alt="search" width="42" height="42">
                        </div>
                        <h4>Busca</h4>
                        <p>Encuentra y compara los espacios disponibles cerca de tu destino</p>
                    </div>
                </div>
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.4s">
                        <div class="single-icon">
                            <img src="{{ asset('/dist/img/ico_checked.png') }}" alt="checked" width="42" height="42">
                        </div>
                        <h4>Reserva</h4>
                        <p>Ahorra tiempo apartando anticipadamente el espacio que más te convenga</p>
                    </div>
                </div>
                <!-- Single Special Area -->
                <div class="col-12 col-md-4">
                    <div class="single-special text-center wow fadeInUp" data-wow-delay="0.6s">
                        <div class="single-icon">
                            <img src="{{ asset('/dist/img/ico_parked_car.png') }}" alt="checked" width="42" height="42">
                        </div>
                        <h4>Estaciona</h4>
                        <p>Escanea el código QR de la cochera con tu app y comenzará a contar el tiempo del estacionamiento</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Special Description Area -->
        <div class="special_description_area mt-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="special_description_img">
                            <img src="{{ asset('/landing/img/bg-img/special.png') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-5 ml-xl-auto">
                        <div class="special_description_content">
                            <h2>Car-E es más que una app para encontrar estacionamiento.<br/> Es una comunidad.</h2>
                            <p>En Car-E conectamos a los automovilistas que buscan estacionamiento con personas que tienen cocheras libres para ello, ofreciéndoles seguridad para su patrimonio. <br/><br/>
                            No pierdas más tu tiempo buscando un lugar para estacionar tu vehículo y olvídate de sufrir algun daño o robo por estacionarlo en la vía publica. <br/><br/>
                            Con Car-e reserva anticipadamente tu estacionamiento y nunca volverás a llegar tarde a tus citas.
                            </p>
                            <div class="app-download-area">
                                <div class="app-download-btn wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- Google Store Btn -->
                                    <a href="https://play.google.com/store/apps/details?id=com.smarttie.care">
                                        <img src="{{ asset('/dist/img/ico_login.png') }}" alt="playstore" width="35" height="25" style="padding-right: 15px">    
                                        <p class="mb-0"><span>Descarga en</span> Google Store</p>
                                    </a>
                                </div>
                                <!-- Apple Store Btn 
                                <div class="app-download-btn wow fadeInDown" data-wow-delay="0.4s">
                                    
                                    <a href="#">
                                        <i class="fa fa-apple"></i>
                                        <p class="mb-0"><span>Proximamente en</span> Apple Store</p>
                                    </a>
                                </div>
                                -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-lg-12">
                <div class="special_description_content">
                            <h2><br/><br/>Únete a la comunidad de Arrendadores de Car-E.</h2>
                            <p>Tu cochera es un activo que puedes compartir con los automovilistas para que lleguen más rápido a sus destinos mientras generas un ingreso extra para tu bolsillo, rentándola a través de Car-E.
                            <br/><br/>Como arrendador podrás:

                            <li>Dar de alta un espacio de estacionamiento en minutos. </li>
                            <li>Gestionar fácilmente la disponibilidad de tu cochera y otros detalles.</li>
                            <li>Ganar dinero extra sin trabajo extra.</li>
                            </p>
                            <div class="app-download-area">
                                <div class="app-download-btn wow fadeInUp" data-wow-delay="0.2s">
                                    <!-- SingUp -->
                                    <a href="{{ url('register')}}">
                                        <img src="{{ asset('/dist/img/ico_clipboard.png') }}" alt="register" width="35" height="25" style="padding-right: 15px">
                                        <p class="mb-0"><span>Registrarme como </span> Arrendador</p>
                                    </a>
                                    <a href="{{ url('login')}}">
                                        <img src="{{ asset('/dist/img/ico_password.png') }}" alt="login" width="35" height="25" style="padding-right: 15px">
                                        <p class="mb-0"><span>Iniciar Sesión</span></p>
                                    </a>
                                </div>
                            </div>
                </div>                            
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Special Area End ***** -->

    <!-- *** unusedindex.blade.php -->

    <!-- ***** Contact Us Area Start ***** -->
    <section class="footer-contact-area section_padding_100 clearfix" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <!-- Heading Text  -->
                    <div class="section-heading">
                        <h2>Aún tienes dudas, no dudes en contactarnos</h2>
                        <div class="line-shape"></div>
                    </div>
                    <div class="footer-text">
                        <p></p>
                    </div>
                    <div class="address-text">
                        <p><span>Dirección:</span> Madero 133-2 Guadalajara Jalisco, MX</p>
                    </div>
                    <div class="phone-text">
                        <p><span>Teléfono:</span> +1-55-888-888-66</p>
                    </div>
                    <div class="email-text">
                        <p><span>Email:</span> info@car-e.mx</p>
                    </div>
                </div>
                <!--
                <div class="col-md-6">
                    <!-- Form Start
                    <div class="contact_from">
                        <form action="#" method="post">
                            <!-- Message Input Area Start 
                            <div class="contact_input_area">
                                <div class="row">
                                    <!-- Single Input Area Start 
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Your E-mail" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <div class="form-group">
                                            <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Your Message *" required></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-12">
                                        <button type="submit" class="btn submit-btn">Send Now</button>
                                    </div>
                                </div>
                            </div>
                            <-- Message Input Area End 
                        </form>
                    </div>
                </div>-->
            </div>
        </div>
    </section>
    <!-- ***** Contact Us Area End ***** -->

    <!-- ***** Footer Area Start ***** -->
    <footer class="footer-social-icon text-center section_padding_70 clearfix">
        <!-- footer logo -->
        <!--<div class="footer-text">
            <h2>Ca.</h2>
        </div>-->
        <!-- social icon-->
        <!--
        <div class="footer-social-icon">
            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
            <a href="#"><i class="active fa fa-twitter" aria-hidden="true"></i></a>
            <a href="#"> <i class="fa fa-instagram" aria-hidden="true"></i></a>
            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
        </div>
        <div class="footer-menu">
            <nav>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
        </div>-->
        <!-- Foooter Text-->
        <div class="copyright-text">
            <!-- ***** Removing this text is now allowed! This template is licensed under CC BY 3.0 ***** -->
            <p>Copyright ©2019 Car-E. <!--Designed by <a href="https://colorlib.com" target="_blank">Colorlib</a></p>-->
        </div>
    </footer>
    <!-- ***** Footer Area Start ***** -->

    <!-- Jquery-2.2.4 JS 
    <script src="js/jquery-2.2.4.min.js"></script>-->
    <script type="text/javascript" src="{{ secure_asset('/landing/js/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js
    <script src="js/popper.min.js"></script> -->
    <script type="text/javascript" src="{{ secure_asset('/landing/js/popper.min.js') }}"></script>
    <!-- Bootstrap-4 Beta JS 
    <script src="js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="{{ secure_asset('/landing/js/bootstrap.min.js') }}"></script>
    <!-- All Plugins JS 
    <script src="js/plugins.js"></script>-->
    <script type="text/javascript" src="{{ secure_asset('/landing/js/plugins.js') }}"></script>
    <!-- Slick Slider Js
    <script src="js/slick.min.js"></script>-->
    <script type="text/javascript" src="{{ secure_asset('/landing/js/slick.min.js') }}"></script>
    <!-- Footer Reveal JS
    <script src="js/footer-reveal.min.js"></script> -->
    <script type="text/javascript" src="{{ secure_asset('/landing/js/footer-reveal.min.js') }}"></script>
    <!-- Active JS 
    <script src="js/active.js"></script>-->
    <script type="text/javascript" src="{{ secure_asset('/landing/js/active.js') }}"></script>
</body>

</html>