<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon">
    <meta name="description" content="">

    <title>@yield('titulo', 'Administrador')</title>

    <!-- Scripts -->


    <!-- Fonts -->

   
 

    <link rel="stylesheet" href="{{ asset('assets/web/assets/mobirise-icons/mobirise-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap-reboot.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/socicon/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dropdown/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/tether/tether.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/animatecss/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/theme/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mobirise.css') }}">
    <link rel="preload" as="style" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}" type="text/css">
  

   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<section class="menu cid-rPhnvPg5NQ" once="menu" id="menu1-0">

<nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
<div class="mbr-table-cell">
                 
</div>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <div class="hamburger">
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </button>
    <div class="menu-logo">
        <div class="navbar-brand">
            <span class="navbar-logo">
                
            <div class="navbar-brand">
                      <a  style="color: white; font-weight: bold" class="navbar-caption">&nbsp; @yield('rol',' Zona Moderador') / {{ $miga }}</a>
                  </div>
                
            </span>
            <span class="navbar-caption-wrap"><a class="navbar-caption text-primary display-4" href="{{ route('welcome') }}"><br></a></span>
        </div>
    </div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
            <li class="nav-item">
                <a class="nav-link link text-white display-4" href="/">
                    <span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>Blog</a>
            </li>
            <li class="nav-item">
                <a class="nav-link link text-white display-4" href="{{ url('/moderador/articulos')}}">
                    <span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>Artículos</a>
            </li>
            <!-- Inicio de autenticacion -->
          
                                <li class="nav-item dropdown"><a class="nav-link link text-white dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" aria-expanded="true"><span class="mbri-rocket mbr-iconfont mbr-iconfont-btn"></span>
                                {{ Auth::user()->name }} </a> 
                                        <div class="dropdown-menu">
                                       
                                        @if(auth()->user()->hasRole('moderador'))
                                            <a class="text-white dropdown-item display-4" href="{{ url('/moderador/articulos') }}">Zona Moderador</a>
                                        @endif
                            
                                            <a class="text-white dropdown-item display-4" href="{{ url('home') }}" >Zona Privada</a>
                                            <a class="text-white dropdown-item display-4" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Cerrar sesión</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                        </div>
                                </li>


      

            <!--Fin de autenticacion -->
        </ul>
        
    </div>
</nav>
</section>



@yield('content')


<section class="cid-rPhFeg4GIP" id="footer1-6">

    

    

<div class="container">
    <div class="media-container-row content text-white">
        <div class="col-12 col-md-3">
            <div class="media-wrap">
                <a href="https://mobirise.co/">
                    <img src="{{ asset('assets/images/logo2.png')}}" alt="Mobirise">
                </a>
            </div>
        </div>
        <div class="col-12 col-md-3 mbr-fonts-style display-7">
            <h5 class="pb-3">
                Address
            </h5>
            <p class="mbr-text">
                1234 Street Name
                <br>City, AA 99999
            </p>
        </div>
        <div class="col-12 col-md-3 mbr-fonts-style display-7">
            <h5 class="pb-3">
                Contacts
            </h5>
            <p class="mbr-text">
                Email: support@mobirise.com
                <br>Phone: +1 (0) 000 0000 001
                <br>Fax: +1 (0) 000 0000 002
            </p>
        </div>
        <div class="col-12 col-md-3 mbr-fonts-style display-7">
            <h5 class="pb-3">
                Links
            </h5>
            <p class="mbr-text">
                <a class="text-primary" href="https://mobirise.co/">Website builder</a>
                <br><a class="text-primary" href="https://mobirise.co/">Download for Windows</a>
                <br><a class="text-primary" href="https://mobirise.co/">Download for Mac</a>
            </p>
        </div>
    </div>
    <div class="footer-lower">
        <div class="media-container-row">
            <div class="col-sm-12">
                <hr>
            </div>
        </div>
        <div class="media-container-row mbr-white">
            <div class="col-sm-6 copyright">
                <p class="mbr-text mbr-fonts-style display-7">
                    © Copyright 2019 Mobirise - All Rights Reserved
                </p>
            </div>
            <div class="col-md-6">
                <div class="social-list align-right">
                    <div class="soc-item">
                        <a href="https://twitter.com/mobirise" target="_blank">
                            <span class="socicon-twitter socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://www.facebook.com/pages/Mobirise/1616226671953247" target="_blank">
                            <span class="socicon-facebook socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://www.youtube.com/c/mobirise" target="_blank">
                            <span class="socicon-youtube socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://instagram.com/mobirise" target="_blank">
                            <span class="socicon-instagram socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://plus.google.com/u/0/+Mobirise" target="_blank">
                            <span class="socicon-googleplus socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                    <div class="soc-item">
                        <a href="https://www.behance.net/Mobirise" target="_blank">
                            <span class="socicon-behance socicon mbr-iconfont mbr-iconfont-social"></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>

<div id="scrollToTop" class="scrollToTop mbr-arrow-up">
     <a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i>
    </a>
</div>
    <input name="animation" type="hidden">

<script src="{{ asset('assets/web/assets/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/popper/popper.min.js') }}"></script>
  <script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/smoothscroll/smooth-scroll.js') }}"></script>
  <script src="{{ asset('assets/dropdown/js/nav-dropdown.js') }}"></script>
  <script src="{{ asset('assets/dropdown/js/navbar-dropdown.js') }}"></script>
  <script src="{{ asset('assets/touchswipe/jquery.touch-swipe.min.js') }}"></script>
  <script src="{{ asset('assets/tether/tether.min.js') }}"></script>
  <script src="{{ asset('assets/viewportchecker/jquery.viewportchecker.js') }}"></script>
  <script src="{{ asset('assets/ytplayer/jquery.mb.ytplayer.min.js') }}"></script>
  <script src="{{ asset('assets/vimeoplayer/jquery.mb.vimeo_player.js') }}"></script>
  <script src="{{ asset('assets/mbr-testimonials-slider/mbr-testimonials-slider.js') }}"></script>
  <script src="{{ asset('assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js') }}"></script>
  <script src="{{ asset('assets/theme/js/script.js') }}"></script>
  <script src="{{ asset('assets/slidervideo/script.js') }}"></script>
  
 <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!--  @if($errors->any())-->
  @yield('include-login-modal')
   <!-- @endif-->


    

    
</body>
</html>
