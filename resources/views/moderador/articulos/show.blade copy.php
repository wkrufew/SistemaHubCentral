@extends('layouts.appModerador')

@section('content')
<div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="main.html"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Funciones del Moderador
                    </li>                   

                    <li class="nav-item">
                        <a class="nav-link" href="main.html" onclick="location='{{ url('moderador/articulos') }}'"><i class="icon-book-open"></i> Articulos</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="main.html"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <!-- Contenido Principal -->
        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Administración</a></li>
               
            </ol>
            <div class="container-fluid">
            <div class="card" style="margin-top:20px; margin-bottom:20px;">
                <div style="text-align:center; margin-top:40px; margin-bottom:40px;">

                <div style="margin-top:20px; margin-bottom:20px; text-align:center; FONT-SIZE:25px" >
                    <b>{{ $articulo->titulo }}</b>
                </div>

                <div class="row ">
            
                    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        @foreach($articulo->imagenes as $imagen)
                            <img width="230px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
                        @endforeach
                    </div>
                </div>
                <div style=" margin-top: 20px" class="row">
                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                        {!! $articulo->contenido !!}
                    </div>
                
                </div>
                <div style="margin-top:30px;">
                    <button style="border-radius: 40px" type="button" class="btn btn-perzonalizado" onclick="location='{{ url('moderador/articulos') }}'">Volver</button>
                
                    
                </div>
              
            </div>
            </div>
            
            
           
        </main>
       
    </div>

    </div>


@endsection

