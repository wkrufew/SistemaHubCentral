@extends('layouts.appAdmin')

@section('content')

<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
	@if(session('notificacion'))   
        <div class="alert alert-success" role="alert">
          {{session('notificacion')}}
        </div>
    @endif
    <div style="margin-top: 20px">
        <form class="form-inline" action="{{url('admin/buscador/usuarios')}}" method="GET">
            @csrf
            <div class="form-group">
            <input style=" border-radius: 40px; text-align:center;" type="text" class="form-control" id="exampleInputEmail2" name="busqueda" placeholder="Buscar usuario">
            </div>
            <button style=" border-radius: 40px" type="submit" class="btn btn-primary btn-sm">Buscar</button>
        </form>
    </div>
	
    <div style="margin-top: 45px; margin-bottom: 20px;">
        <h5><strong>Total de usuarios: {{ $usuarios->count()}} </strong</h5>
    </div>
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Nombre</th>
			  <th scope="col">Alias</th>
			  <th scope="col">Rol</th>
			  <th scope="col">Web</th>
			  <th scope="col">Email</th>
			  <th scope="col">Fecha Subscripción</th>
			  <th scope="col">Estado</th>
			  <th scope="col">Editar</th>
			</tr>
		</thead>
		@foreach($usuarios as $key => $usuario)
			<tbody>
				<tr>
				  <th scope="row">{{ $key+1 }}</th>
				  <td>{{ $usuario->name }}</td>
				  <td>{{ $usuario->alias }}</td>
				  <td>{{ $usuario->UsuarioRoles }}</td>
				  <td>{{ $usuario->web }}</td>
				  <td>{{ $usuario->email }}</td>
				  <td>{{ $usuario->created_at->formatLocalized('%A %d %B %Y') }}</td>
				  <td>{{ $usuario->UsuarioBloqueado }}</td>
				  <td>
				  	<a href="{{ route('usuarios.edit',$usuario) }}">
				  		<img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="Actualizar" title="Actualizar">
				  	</a>
				  </td>
				</tr>
			</tbody>
		@endforeach
	</table>
	<div class="row">
    	<div class="col-xs-12 col-lg-10 col-lg-offset-1">
    		{{ $usuarios->links() }}
		</div>
	</div>
</div>

@endsection