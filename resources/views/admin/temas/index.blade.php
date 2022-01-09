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
                        <i class="fa fa-align-justify"></i> Temas&nbsp;&nbsp;
                        <button style="border-radius: 40px"   type="button" class="btn btn-perzonalizado" data-toggle="modal" data-target="#modalCrear">
                            <i  class="icon-plus"></i>&nbsp;Agregar Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class=" col-md-3">
                            <div class="input-group">
                                <span><b>Total de Temas: &nbsp;{{ $temas->count()}}</b></span>
                                </div>
                              
                            </div>
                            <div class="col-md-6">
                               
                              
                            </div>
                        </div>
                            @if(session('notificacion'))   
                                <div class="alert alert-success" role="alert">
                                {{session('notificacion')}}
                                </div>
                            @endif
                            @if(session('notificacion2'))   
                                <div class="alert alert-danger" role="alert">
                                {{session('notificacion2')}}
                                </div>
                            @endif
                          
	<table class="table table-bordered table-sm table-hover">
		<thead >
			<tr>
			  <th>Opciones</th>
			  <th>Nombre</th>
			  <th>Autor</th> 
			  <th>Fecha de creación</th>
			  <th>Subscripción</th>
			  <th>Destacado</th>

			</tr>
		</thead>
		
			<tbody>
			@foreach($temas as $tema) 
				<tr >
				  <td>
				  <a href="{{  route('tema.edit',$tema) }}"><button  type="button" class="btn btn-primary btn-sm"><i class="icon-pencil"></i>
                  </button></a>&nbsp;

				  <!--Inicio del boton de eliminar-->

				  
				  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalEliminar{{$tema->id}}">
                                          <i class="icon-trash"></i>
                                        </button>
                                                    <!-- Inicio del modal Eliminar -->
                                                    <div class="modal fade" id="modalEliminar{{$tema->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                                        <div class="modal-dialog modal-danger" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Eliminar Tema</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Estas seguro de eliminar el Tema?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" style="border-radius: 40px" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                   

                                                                    <form method="POST" action="{{	route('tema.delete',$tema) }}">
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
				  
				  
				  
				  
				  <!--fin del boton de eliminar-->
				  </td>
				  <td>{{ $tema->nombre }}</td>
				  <td>{{ $tema->user->name }}</td>
				  <td>{{ $tema->created_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $tema->created_at->locale('es')->isoFormat('YYYY, h:mm a') }}</td>
			


				  @if(  $tema->suscripcion)
                                    <td>
                                        <span class="badge badge-success">Si</span>
                                    </td>
                                    @else
                                 
                                    <td>
                                        <span class="badge badge-danger">No</span>
                                    </td>
                                    @endif
			

				  @if(  $tema->destacado)
                                    <td>
                                        <span class="badge badge-success">Si</span>
                                    </td>
                                    @else
                                 
                                    <td>
                                        <span class="badge badge-danger">No</span>
                                    </td>
                                    @endif
				  
				
				</tr>
				@endforeach
			</tbody>
	
	</table>

				<nav>
                        
                        </nav>
                    </div>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>
            <!--Inicio del modal agregar/actualizar-->
            
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            
            <!-- Fin del modal Eliminar -->
        </main>

		@include('includes.createAdminTema-modal')

@endsection

@if($errors->any())
  @section('include-createAdminTema-modal')
  <script src="{{ asset('js/createAdminTema-modal.js') }}" defer></script>
  @endsection
@endif



@if(session('notificacion2'))
  @section('include-createAdminTema-modal')
  <script src="{{ asset('js/createAdminTema-modal.js') }}" defer></script>
  @endsection
@endif