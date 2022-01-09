@extends('layouts.appAdmin')

@section('content')

<div style="margin-top: 150px; margin-bottom: 180px;" class="container">
	<button style="border-radius: 40px" type="button" class="btn-personalizado btn-sm"><a href="{{ route('tema.create') }}">Añadir Tema</a></button>
	<div style="margin-top: 20px">
       
       
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
	<table class="table table-hover">
		<thead class="thead-dark">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Nombre</th>
			  <th scope="col">Autor</th> 
			  <th scope="col">Fecha de creación</th>
			  <th scope="col">Subscripción</th>
			  <th scope="col">Destacado</th>
			  <th scope="col">Editar</th>
			  <th scope="col">Eliminar</th>
			</tr>
		</thead>
		@foreach($temas as $tema)
			<tbody>
				<tr>
				  <th scope="row">{{ $tema->id }}</th>
				  <td>{{ $tema->nombre }}</td>
				  <td>{{ $tema->user->name }}</td>
				  <td>{{ $tema->created_at->formatLocalized('%A %d %B %Y') }}</td>
				  <td>{{ $tema->EsSuscripcion }}</td>
				  <td>{{ $tema->EsDestacado }}</td>
				  <td>
				  	<a href="{{ route('tema.edit',$tema) }}">
				  		<img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="Editar" title="Editar">
				  	</a>
				  </td>
				  <td>
				  	
				  	<form method="POST" action="{{ route('tema.delete',$tema) }}">
                        @csrf
                        {{ method_field('DELETE') }} 		
                        <button style=" background-color:white ;border:0" type="submit" onclick="return confirm('¿Estás Seguro de eliminar este tema?')">
				  			<img width="25px" src="{{ asset('imagenes/admin/eliminar.png') }}" alt="Eliminar" title="Eliminar">
				  		</button>
				  	</form>

				  </td>
				</tr>
			</tbody>
		@endforeach
	</table>
</div>

@endsection