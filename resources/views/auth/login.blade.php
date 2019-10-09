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
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/')}}">Inicio</a></li>
                                </ul>
                            </div>
                            <div class="collapse navbar-collapse" id="ca-navbar">
                                <ul class="navbar-nav ml-auto" id="nav">
                                    <li class="nav-item"><a class="nav-link" href="{{ url('/register')}}">Registrarse como arrendador</a></li>
                                </ul>
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
        <div class="container h-20">
           <p style="padding-top:100px; color:white; size:16;"></p>
        </div>
      
    

<div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="contact_from">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                            <div class="contact_input_area">
                                <div class="row">
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" id="email" placeholder="Correo Electrónico" required>
                                        </div>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="password" placeholder="Contraseña" required>
                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="col-12">
                                        <button type="submit" class="btn submit-btn">Iniciar Sesión</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                </div>
                </section>

    <!-- ***** Footer Area Start ***** -->
    <footer class="footer-social-icon text-center section_padding_70 clearfix">
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
