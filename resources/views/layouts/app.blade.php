<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon">
    <meta name="description" content="">

     <!--<title>@yield('titulo', 'HubCentro')</title>-->

    <title>@yield('titulo', config('app.name'))</title>
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
  
    <link rel="preload" as="style" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/mobirise/css/mbr-additional.css') }}" type="text/css">

    <!--ojo este es el plugin para la aplicacion de las imagenes-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="{{ asset('css/buscador-predictivo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/preloader.css') }}" type="text/css">   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
     
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<!--background="{{ asset('assets/images/fondo_pro.jpg') }}"-->
<body style="background-size: cover; background-repeat: no-repeat; background-position: center center;">

<div id="contenedor">
        <div id="carga">
        </div>
    </div>
<section class="menu cid-rPhnvPg5NQ" once="menu" id="menu1-0">
            
<nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm transparent">
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
                     <img src="{{ asset('assets/images/logo.jpg') }}" alt="Mobirise" title="" href="{{ route('welcome') }}" style="height: 3.3rem;">
            </span>
           
        </div>
    </div>
    
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline navbar-form navbar-right" action="{{ url('/buscador') }}" method="GET" style=" margin-right: 20px; ">
                @csrf
                <input id="buscador-predictivo" style="border-radius: 10px; width:75; font-size:12px; margin-top: 2px; background-color:transparent; color:white;" autocomplete="off" class="form-control" name="busqueda" type="text" placeholder="Busqueda" aria-label="Search">
                <button style="border-radius: 10px; margin-top: 8px" class="btn btn-outline-light" type="submit">Buscar <span class="mbri-search mbr-iconfont mbr-iconfont-btn "></span></button>
    </form>
          <!--inicio del ul o menu -->
        <ul class="navbar-nav nav-dropdown nav-right" data-app-modern-menu="true">
            <li class="nav-item" style=" margin-right: 20px; ">
                <a class="nav-link link text-white display-4" href="/">
                    <span class="mbri-home mbr-iconfont mbr-iconfont-btn"></span>Inicio</a>
            </li>
            <li style=" margin-right: 20px; " class="nav-item dropdown"><a class="nav-link link text-white dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" aria-expanded="true">
                    Eventos</a>
                    <div class="dropdown-menu">
                       @foreach($temasTodos as $tema)
                        <a class="text-white dropdown-item display-4" href="{{ route('tema.show',$tema) }}">{{ $tema->nombre}}</a> 
                       @endforeach
                    </div>
            </li>
            <li style=" margin-right: 20px; " class="nav-item">
                <a class="nav-link link text-white display-4" href="#">
                   
                    Servicios
                </a>
            </li>
            <!-- Inicio de autenticacion -->
            @guest
                <li style=" margin-right: 20px; " class="nav-item">
                    <a class="nav-link link text-white display-4" href="#" data-toggle="modal" data-target="#loginModal">{{ __('Acceder') }}</a>
                </li>
                @if (Route::has('register'))
                    <li style=" margin-right: 20px; " class="nav-item">
                        <a class="nav-link link text-white display-4" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                    </li>
                @endif
            @else
            <li style=" margin-right: 20px; " class="nav-item dropdown"><a class="nav-link link text-white dropdown-toggle display-4" href="#" data-toggle="dropdown-submenu" aria-expanded="true"><span class="mbri-user mbr-iconfont mbr-iconfont-btn"></span>
            {{ Auth::user()->name }} </a> 
                    <div class="dropdown-menu">
                    
                    @if(auth()->user()->hasRole('administrador'))
                        <a class="text-white dropdown-item display-4" href="{{ url('/admin/temas') }}">Zona Administrador</a>
                    @elseif(auth()->user()->hasRole('moderador'))
                        <a class="text-white dropdown-item display-4" href="{{ url('/moderador/articulos') }}">Zona Moderador</a>
                    @endif
        
                        <a class="text-white dropdown-item display-4" href="{{ url('home') }}" >Perfil</a>
                        <a class="text-white dropdown-item display-4" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar sesión</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                    </div>
            </li>
            @endguest
            <!--Fin de autenticacion -->
        </ul>
         <!--Fin de ul o menu -->
    </div>
</nav>
<!-- INICIO DE LA ANIMACION -->

<!--Hey! This is the original version
of Simple CSS Waves-->

<!--<div class="header">

   
    <div class="inner-header flex">
    
    <svg version="1.1" class="logo" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 500 500" xml:space="preserve">
    <path fill="#FFFFFF" stroke="#000000" stroke-width="10" stroke-miterlimit="10" d="M57,283" />
    <g><path fill="#fff"
    d="M250.4,0.8C112.7,0.8,1,112.4,1,250.2c0,137.7,111.7,249.4,249.4,249.4c137.7,0,249.4-111.7,249.4-249.4
    C499.8,112.4,388.1,0.8,250.4,0.8z M383.8,326.3c-62,0-101.4-14.1-117.6-46.3c-17.1-34.1-2.3-75.4,13.2-104.1
    c-22.4,3-38.4,9.2-47.8,18.3c-11.2,10.9-13.6,26.7-16.3,45c-3.1,20.8-6.6,44.4-25.3,62.4c-19.8,19.1-51.6,26.9-100.2,24.6l1.8-39.7		c35.9,1.6,59.7-2.9,70.8-13.6c8.9-8.6,11.1-22.9,13.5-39.6c6.3-42,14.8-99.4,141.4-99.4h41L333,166c-12.6,16-45.4,68.2-31.2,96.2	c9.2,18.3,41.5,25.6,91.2,24.2l1.1,39.8C390.5,326.2,387.1,326.3,383.8,326.3z" />
    </g>
    </svg>
    {{-- <h1>Simple CSS Waves</h1> --}}
    </div>
    
  
    <div>
    <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
    <defs>
    <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
    </defs>
    <g class="parallax">
    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
    </g>
    </svg>
    </div>
  
    
    </div>
    
    <div class="content flex">
   {{--  <p>Daniel Österman | 2019 | Free to use</p> --}}
    </div>-->
<!-- FIN DE LA ANIMACION -->
{{-- estilo de la animacion --}}
<style>
    @import url(//fonts.googleapis.com/css?family=Lato:300:400);

body {
  margin:0;
}

h1 {
  font-family: 'Lato', sans-serif;
  font-weight:300;
  letter-spacing: 2px;
  font-size:48px;
}
p {
  font-family: 'Lato', sans-serif;
  letter-spacing: 1px;
  font-size:14px;
  color: #333333;
}

.header {
  position:relative;
  text-align:center;
  background: linear-gradient(60deg, rgba(84,58,183,1) 0%, rgba(0,172,193,1) 100%);
  color:white;
}
.logo {
  width:50px;
  fill:white;
  padding-right:15px;
  display:inline-block;
  vertical-align: middle;
}

.inner-header {
  height:65vh;
  width:100%;
  margin: 0;
  padding: 0;
}

.flex { /*Flexbox for containers*/
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
}

.waves {
  position:relative;
  width: 100%;
  height:2vh;
  margin-bottom:-7px; /*Fix for safari gap*/
  min-height:100px;
  max-height:150px;
}

.content {
  position:relative;
  height:5vh;
  text-align:center;
  background-color: white;
}

/* Animation */

.parallax > use {
  animation: move-forever 25s cubic-bezier(.55,.5,.45,.5)     infinite;
}
.parallax > use:nth-child(1) {
  animation-delay: -2s;
  animation-duration: 7s;
}
.parallax > use:nth-child(2) {
  animation-delay: -3s;
  animation-duration: 10s;
}
.parallax > use:nth-child(3) {
  animation-delay: -4s;
  animation-duration: 13s;
}
.parallax > use:nth-child(4) {
  animation-delay: -5s;
  animation-duration: 20s;
}
@keyframes move-forever {
  0% {
   transform: translate3d(-90px,0,0);
  }
  100% { 
    transform: translate3d(85px,0,0);
  }
}
/*Shrinking for mobile*/
@media (max-width: 768px) {
  .waves {
    height:40px;
    min-height:40px;
  }
  .content {
    height:30vh;
  }
  h1 {
    font-size:24px;
  }
}
</style>
{{-- fin del estilo de la animacion --}}
</section>

 <!--Contenido principal -->
@yield('content')


<section class="cid-rPhFeg4GIP" id="footer1-6">

    

    

<div class="container">
    <div class="media-container-row content text-white">
        <div class="col-12 col-md-3">
            <div class="media-wrap">
                <a href="#">
                    <img src="{{ asset('assets/images/logo.jpg')}}" alt="HubCentro">
                </a>
            </div>
        </div>
        <div class="col-12 col-md-3 mbr-fonts-style display-7">
            <h5 class="pb-3">
                Direccion
            </h5>
            <p class="mbr-text">
                1223
                <br>Riobamba, AA 99999
            </p>
        </div>
        <div class="col-12 col-md-3 mbr-fonts-style display-7">
            <h5 class="pb-3">
                Contactos
            </h5>
            <p class="mbr-text">
                Email: support@hubcentro.com
                <br>Phone: +1 (0) 000 0000 001
                <br>Fax: +1 (0) 000 0000 002
            </p>
        </div>
        <div class="col-12 col-md-3 mbr-fonts-style display-7">
            <h5 class="pb-3">
                Links
            </h5>
            <p class="mbr-text">
                <a class="text-primary" href="https://mobirise.co/">Website </a>
                <br><a class="text-primary" href="https://mobirise.co/">Facebook</a>
                <br><a class="text-primary" href="https://mobirise.co/">Instagram</a>
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
                    © Copyright 2020 HubCentro - Todos Los Derechos Reservados
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
<script src="{{ asset('assets/web/assets/jquery/jquery.min.js') }}"></script>
</section> <script src="{{ asset('assets/popper/popper.min.js') }}"></script>
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
  <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
  <script src="{{ asset('js/buscador-predictivo.js') }}"></script>
  <script src="{{ asset('js/preloader.js') }}"></script>
  <!--<script src="{{ asset('js/app.js') }}" defer></script>-->
  
  <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>

  <script src="{{ asset('js/app.js') }}"></script> 

  <!--  @if($errors->any())
  @yield('comprobar-alias-js')-->
  @yield('include-login-modal')
   <!-- @endif-->
   
 <!--@yield('comentarios-js')-->
    
 <div id="scrollToTop" class="scrollToTop mbr-arrow-up">
     <a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i>
    </a>
</div>
    <input name="animation" type="hidden">
    
</body>
</html>
