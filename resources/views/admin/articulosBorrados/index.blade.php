@extends('layouts.appAdmin')

@section('content')
<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style=" color:#941b94;" href="#">Administración</a></li>
               
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Articulos Borrados&nbsp;&nbsp;
                        
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class=" col-md-3">
                            <div class="input-group">
                                <span><b>Artículos borrados: &nbsp;{{ $articulos->count()}}</b></span>
                                </div>
                            </div>
                        </div>
                            @if(session('notificacion'))   
                                <div class="alert alert-success" role="alert">
                                {{session('notificacion')}}
                                </div>
                            @endif
                            @if(session('notificacion2'))   
                                <div class="alert alert-success" role="alert">
                                {{session('notificacion2')}}
                                </div>
                            @endif
                          
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Titulo</th>
                                    <th>Autor</th>
                                    <th>Tema</th>
                                    <th>Fecha creación</th>
                                    <th>Fecha de eliminación</th> 
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($articulos as $articulo)
                                <tr>
                                    <td>
                                    
                                    <button  type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalRestaurar{{$articulo->id}}"><i class="icon-undo"></i>
                                    </button>
                                                    <!-- Inicio del modal Restaurar -->
                                                    <div class="modal fade" id="modalRestaurar{{$articulo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-personalizado" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Restaurar Artículo</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Estas seguro de restaurar el Artículo ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" style="border-radius: 40px" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                   

                                                                    <form method="POST" action="{{	route('articulos-borrados.restaurar',$articulo->id) }}">
                                                                        @csrf
                                                                        {{ method_field('PUT') }}
                                                                        <button class="btn btn-perzonalizado" style="border-radius: 40px" type="submit" >Restaurar</button>
                                                                        
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- Fin del modal Restaurar -->


                                    <button type="button" class="btn btn-perzonalizado btn-sm" data-toggle="modal" data-target="#modalVer{{$articulo->id}}">
                                          <i class="icon-eye-open"></i>
                                    </button>
                                             <!-- Inicio del modal ver -->
                                             <div class="modal fade" id="modalVer{{$articulo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-personalizado modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Detalles del Artículo</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="GET" action="" enctype="multipart/form-data" class="temaFormuEdit">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                           
                                                                                <div style="text-align:center; margin-top:5px; margin-bottom:5px;">

                                                                                <div style="margin-top:10px; margin-bottom:20px; text-align:center; FONT-SIZE:25px" >
                                                                                    <b>{{ $articulo->titulo }}</b>
                                                                                </div>
c                                                                                                                                                                                                                                                   
                                                                                <div>
                                                                                    <div class="row" style="justify-content: center; display:inline-block ">
                                                                                        @foreach($imagenes as $imagen)
                                                                                            @if($articulo->id === $imagen->articulo_id)
                                                                                            <img style="width:250px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>

                                                                                <div style=" margin-top: 20px" class="row">
                                                                                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
                                                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                                                        {!! $articulo->contenido !!}
                                                                                    </div>

                                                                                </div>

                                                                          
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button style="border-radius: 40px"  type="button" class="btn btn-perzonalizado" data-dismiss="modal">Salir</button>
                                                                            
                                                                            </div>
                                                                        </div>
                                                                        </form>
                                                                        <!-- /.modal-content -->
                                                                    </div>
                                                                    <!-- /.modal-dialog -->
                                                                </div>
                                                                </div>
                                                                
                                                    <!-- Fin del modal ver -->

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar{{$articulo->id}}">
                                        <i class="icon-trash"></i>
                                    </button>
                                                    <!-- Inicio del modal Eliminar -->
                                                    <div class="modal fade" id="modalEliminar{{$articulo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-danger" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Eliminar Artículo</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Estas seguro de eliminar permanentemente el Artículo ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" style="border-radius: 40px" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                   

                                                                    <form method="POST" action="{{	route('articulos-borrados.destroy',$articulo->id) }}">
                                                                        @csrf
                                                                        {{ method_field('DELETE') }}
                                                                        <button class="btn btn-danger" style="border-radius: 40px" type="submit" >Eliminar</button>
                                                                        
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>
                                                    <!-- Fin del modal Eliminar -->
                                      
                                        
                                           
                                    </td>
                                    <td>{{ $articulo->titulo }}</td>
                                    <td>{{ $articulo->user->name }}</td>
                                    <td>{{ $articulo->tema->nombre }}</td>
                                    <td>{{ $articulo->created_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $articulo->created_at->locale('es')->isoFormat('YYYY, h:mm a') }}</td>
                                    <td>{{ $articulo->deleted_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $articulo->deleted_at->locale('es')->isoFormat('YYYY, h:mm a') }}</td>
                                    
                                    @if(  $articulo->deleted_at=== '')
                                    <td>
                                        <span class="badge badge-success">Activo</span>
                                    </td>
                                    @else
                                 
                                    <td>
                                        <span class="badge badge-danger">Eliminado</span>
                                    </td>
                                    @endif


                                  
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                       
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>  
            <!--Inicio del modal agregar/actualizar-->
            
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            
            <!-- Fin del modal Eliminar -->
        </main>

        

@endsection
