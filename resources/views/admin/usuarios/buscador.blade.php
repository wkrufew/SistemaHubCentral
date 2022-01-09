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
                        <i class="fa fa-align-justify"></i> Artículos&nbsp;&nbsp;
                       
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class=" col-md-3">
                            <div class="input-group">
                                <span><b>Total de Usuarios: &nbsp;{{ $usuarios->count() }}</b></span>
                                </div>
                              
                            </div>
                            <div class="col-md-6">
                               
                              
                            </div>
                            <div class="col-md-3">
                                
                                <div class="input-group">
                                <form class="form-inline" action="{{url('admin/buscador/usuarios')}}" method="GET">
                                    @csrf
                                    <input style="border-radius: 40px; text-align:center;" type="text" id="exampleInputEmail2" name="busqueda" class="form-control" placeholder="Usuario/correo">
                                    &nbsp;&nbsp; <button style="border-radius: 40px" type="submit" class="btn btn-perzonalizado"><i class="fa fa-search"></i> Buscar</button>
                                </form>
                                    
                                   
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
									<th>Nombre</th>
									<th>Alias</th>
									<th>Rol</th>
									<th>Web</th>
									<th>Correo</th>
									<th>Fecha Subscripción</th>
									<th>Estado</th>
									
									</tr>
								</thead>
								
									<tbody>
									@foreach($usuarios as $key => $usuario)
										<tr>
										<td>
										 <a href="{{  route('usuarios.edit',$usuario) }}"><button  type="button" class="btn btn-primary btn-sm"><i class="icon-pencil"></i>
                                    		</button></a>
										</td>
										<td>{{ $usuario->name }}</td>
										<td>{{ $usuario->alias }}</td>
										<td>{{ $usuario->UsuarioRoles }}</td>
										<td>{{ $usuario->web }}</td>
										<td>{{ $usuario->email }}</td>
										<td>{{ $usuario->created_at->formatLocalized('%A %d %B %Y') }}</td>
									
										@if(  !$usuario->bloqueado)
                                    <td>
                                        <span class="badge badge-success">Activo</span>
                                    </td>
                                    @else
                                 
                                    <td>
                                        <span class="badge badge-danger">Bloqueado</span>
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

@endsection