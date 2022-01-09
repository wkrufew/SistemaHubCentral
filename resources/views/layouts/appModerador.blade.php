<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.jpg') }}" type="image/x-icon">
    <meta name="description" content="">

    <title>@yield('titulo', 'Moderador')</title>


    
    <!-- Icons -->
    <link href="{{ asset('admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/simple-line-icons.min.css') }}" rel="stylesheet">
    <!-- Main styles for this application -->
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
    <header class="app-header navbar">
        <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
          <span class="navbar-toggler-icon"></span>
        </button>
        <ul class="nav navbar-nav d-md-down-none">
            <li class="nav-item px-3">
            
            <a  style="font-weight: bold; color:#941b94;" class="navbar-caption">&nbsp; @yield('rol',' Zona Moderador') / {{ $miga }}</a>
       
            </li>
           
        </ul>
        <ul class="nav navbar-nav ml-auto">
            
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <img src="{{ asset('admin/img/avatars/logo_corto.jpg') }}" class="img-avatar" alt="Error en la imagen">
                    <span style="color:#941b94;" class="d-md-down-none"> <b> {{ Auth::user()->name }}</b></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-header text-center">
                        <strong>Cuenta</strong>
                    </div>
                    <a class="dropdown-item" href="{{ url('home') }}" onclick="location='{{ url('home') }}'"><i class="fa fa-user"></i>Perfil</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> 
                        Cerrar sesión</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>&nbsp;&nbsp;&nbsp;&nbsp;
        </ul>
    </header>
   

    
        @yield('content')
        <!-- Contenido Principal -->
        
        <!-- /Fin del contenido principal -->
   

    

    <footer class="app-footer">
        <img width="20px" style="margin-right: 4px" src="{{ asset('admin/img/icono_facebook_full.png') }}" class="img-avatar" alt="Error en la imagen">
        <span style=" color:#941b94;"><a style=" color:#941b94;" href="https://www.facebook.com/hubcentro.ec.3">HubCentro</a> &copy; 2020</span>

        
        <span style=" color:#941b94;" class="ml-auto"><img width="20px" style="margin-right: 4px" src="{{ asset('admin/img/icono_facebook_full.png') }}" alt="Error en la imagen"> Desarrollado por <a style=" color:#941b94;" href="https://www.facebook.com/smith.aviles3/">S.V.A.M.</a></span>
    </footer>

    <!-- Bootstrap and necessary plugins -->
    <script src="{{ asset('admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/js/pace.min.js') }}"></script>
    <!-- Plugins and scripts required by all views -->
    <script src="{{ asset('admin/js/Chart.min.js') }}"></script>
    <!-- GenesisUI main scripts -->
    <script src="{{ asset('admin/js/template.js') }}"></script>
    @yield('include-createModerador-modal')

</body>

</html>