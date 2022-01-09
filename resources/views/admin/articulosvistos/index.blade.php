@extends('layouts.appAdmin')

@section('content')
<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style=" color:#941b94;" href="#">Dashboard</a></li>
               
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    {{-- <div class="card-header">
                        <i class="fa fa-align-justify"></i> Publicaciones con reacción&nbsp;&nbsp;
                    </div>  --}}
                  
                    <div class="card-body table-responsive">
                        
                        <div class="row center">
                            <div class="col-sm-3">
                              <div style="border-radius: 5px; border-color: black; border-width: 3px" class="card bg-success">
                                <div style="text-align: center; font-size: 17px" class="card-body">
                                    <i class="icon-user"></i>&nbsp;&nbsp;Usuarios: <strong>{{ $usuario }}</strong>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-3">
                              <div style="border-radius: 5px;border-color: black; border-width: 3px " class="card bg-primary">
                                <div style="text-align: center; font-size: 17px" class="card-body">
                                    <i  class="icon-book"></i>&nbsp;&nbsp; Publicaciones: <strong>{{ $articulo }} </strong>
                                </div>
                              </div>
                            </div>
                           
                            <div class="col-sm-3">
                                <div style="border-radius: 5px; ; background: #941b94; border-color: black; border-width: 3px" class="card text-white">
                                  <div style="text-align: center; font-size: 17px" class="card-body">
                                    <i class="icon-building"></i>&nbsp;&nbsp;Instituciones: <strong>{{ $universidad }}</strong>
                                  </div>
                                </div>
                              </div>
                              <div class="col-sm-3">
                                <div style="border-radius: 5px; " class="card bg-dark text-white">
                                  <div style="text-align: center; font-size: 17px" class="card-body">
                                    <i class="icon-comments"></i>&nbsp;&nbsp; Comentarios: <strong>{{ $comentario }}</strong>
                                  </div>
                                </div>
                              </div>
                           
                        </div>
                          
                        <div class="row">
                            <div class="col-7">
                                {!! Charts::assets() !!}
                                <div class="container">
                                    {!! $chart->render() !!}
                                </div>
                            </div>

                            <div class="col-5">
                                <table style="border: white 5px solid" class="table table-bordered table-sm table-hover">
                                    <thead style="background:#29363d ; color: white; border: white 4px solid">
                                        <tr  style="border: white 8px solid">
                                            <th style="border: white 5px solid; text-align: center"><strong>#</strong></th>
                                            <th style="border: white 5px solid">Titulo de la publicación</th>
                                            {{-- <th style="border: white 5px solid">Autor de la publicación</th> --}}
                                            <th style="border: white 5px solid">Tema</th>
                                            <th style="border: white 5px solid">Likes</th>
                                            {{-- <th style="border: white 5px solid">Fecha de la ultima reacción</th> --}}
                                          {{--   <th style="border: white 5px solid">Estado</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @foreach($articulos as $key => $articulo)
                                    <tr style="border: white 5px solid" @if(  $articulo->count <= 5 ) class="table-danger" @else class="table-primary" @endif>
                                            <td style="border: white 5px solid; text-align: center"><strong>{{ $key+1 }}</strong></td>
                                            <td style="border: white 5px solid">{{ $articulo->titulo }}</td>
                                            {{-- <td style="border: white 5px solid">{{ $articulo->user->name }}</td> --}}
                                            <td style="border: white 5px solid">{{ $articulo->tema->nombre }}</td>
                                            <td style="border: white 5px solid; text-align: center"><strong>{{ $articulo->count }}</strong></td>
                                        {{--  <td style="border: white 5px solid">{{ $articulo->created_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $articulo->created_at->locale('es')->isoFormat('YYYY, h:mm a') }}</td> --}}
                                           {{--  @if(  $articulo->activo)
                                            <td style="border: white 5px solid; text-align: center">
                                                <span class="badge badge-success">Activo</span>
                                            </td>
                                            @else
                                        
                                            <td style="border: white 5px solid; text-align: center">
                                                <span class="badge badge-danger">Desactivado</span>
                                            </td>
                                            @endif --}}
        
        
                                        
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                <nav>
                                    <div class="row">
                                        <div class="col-xs-12 col-lg-12 col-lg-offset-1">
                                            {{ $articulos->links() }}
                                        </div>
                                        <div class=" col-4">
                                            <div class="input-group">
                                                <span><b>Total de likes: &nbsp;{{ $suma}}</b></span>
                                                </div>
                                            </div>
                                    </div> 
                                    </nav>
                            </div>
                            
                        </div>
                       
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>  

        </main>

@endsection

