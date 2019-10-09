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
    <link rel="icon" type="image/icon" href="{{  asset('/landing/img/core-img/favicon.ico') }}"/>

    <!-- Core Stylesheet 
    <link href="style.css" rel="stylesheet">-->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css" >

    <!-- Responsive CSS 
    <link href="css/responsive.css" rel="stylesheet">-->
    <link href="{{ asset('/landing/css/slick.css') }}" rel="stylesheet" type="text/css" >

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
                                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
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


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cellphone" class="col-md-4 col-form-label text-md-right">{{ __('Cellphone') }}</label>

                            <div class="col-md-6">
                                <input id="cellphone" type="cellphone" class="form-control{{ $errors->has('cellphone') ? ' is-invalid' : '' }}" name="cellphone" required>

                                @if ($errors->has('cellphone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cellphone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

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
    <script type="text/javascript" src="{{ asset('/landing/js/jquery-2.2.4.min.js') }}"></script>
    <!-- Popper js
    <script src="js/popper.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('/landing/js/popper.min.js') }}"></script>
    <!-- Bootstrap-4 Beta JS 
    <script src="js/bootstrap.min.js"></script>-->
    <script type="text/javascript" src="{{ asset('/landing/js/bootstrap.min.js') }}"></script>
    <!-- All Plugins JS 
    <script src="js/plugins.js"></script>-->
    <script type="text/javascript" src="{{ asset('/landing/js/plugins.js') }}"></script>
    <!-- Slick Slider Js
    <script src="js/slick.min.js"></script>-->
    <script type="text/javascript" src="{{ asset('/landing/js/slick.min.js') }}"></script>
    <!-- Footer Reveal JS
    <script src="js/footer-reveal.min.js"></script> -->
    <script type="text/javascript" src="{{ asset('/landing/js/footer-reveal.min.js') }}"></script>
    <!-- Active JS 
    <script src="js/active.js"></script>-->
    <script type="text/javascript" src="{{ asset('/landing/js/active.js') }}"></script>
</body>

</html>









 <!--/*****   REGISTRATION ACUALY ****//-->

 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cellphone" class="col-md-4 col-form-label text-md-right">{{ __('Cellphone') }}</label>

                            <div class="col-md-6">
                                <input id="cellphone" type="cellphone" class="form-control{{ $errors->has('cellphone') ? ' is-invalid' : '' }}" name="cellphone" required>

                                @if ($errors->has('cellphone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cellphone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection