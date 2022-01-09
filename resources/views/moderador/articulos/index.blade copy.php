@extends('layouts.appModerador')

@section('content')
<div style="margin-top: 140px; margin-bottom: 180px;" class="container">
    <div style="margin-top: 5px; margin-bottom: 20px; text-align:center;">
   
        <button type="submit" style="border-radius: 40px"  class="btn btn-primary" onclick="location='{{ url('moderador.articulos.create') }}'"><a href="{{ route('moderador.articulos.create') }}">Añadir Artículo</a></button>
	    <button id="eliminar" style="margin-left: 450px; border-radius: 40px" type="submit" onclick="return confirm('¿Estás Seguro de eliminar todos lor articulos?')" class="btn btn-secondary">Eliminar Todo</button>
    </div>
	
    <div style="margin-top: 20px; margin-left: 35%;">
        <form class="form-inline" action="{{url('moderador/buscador/articulos')}}" method="GET">
            @csrf
            <div class="form-group">
            <input style="border-radius: 40px; text-align:center;" type="text" class="form-control input-sm " id="exampleInputEmail2" name="busqueda" placeholder="Buscar por tema o usuario">
            </div>
            <button style="margin-top: 8px; border-radius: 40px" type="submit" class="btn btn-primary">Buscar</button>
        </form>
        
       
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
	<div style="margin-top: 45px; margin-bottom: 16px;">
        <h5>Total de artículos {{ $todosArticulos}}</h5>
    </div>
	<table id="articulos" class="table table-hover">
		<thead class="thead-dark responsive">
			<tr>
			  <th scope="col">#</th>
			  <th scope="col">Título</th>
			  <th scope="col">Autor</th>
			  <th scope="col">Tema</th>
			  <th scope="col">Fecha de creación</th>
			  <th scope="col">Activado</th>
			  <th scope="col">Ver Contenido</th>
			  <th scope="col">Editar</th>
			  <th scope="col">Eliminar</th>
			</tr>
		</thead>

			<tbody>
				@foreach($articulos as $articulo)
				<tr>
				  <th scope="row">{{ $articulo->id }}</th>
				  <td>{{ $articulo->titulo }}</td>
				  <td>{{ $articulo->user->name }}</td>
				  <td>{{ $articulo->tema->nombre }}</td> 
				  <td>{{ $articulo->created_at->formatLocalized('%A %d %B %Y')  }}</td>
				  <!--<td>{{ $articulo->created_at->format('l d, F Y') }}</td>-->
				  <td>{{ $articulo->EstaActivado}}</td>
				  <td>
				  	<a href="{{	route('moderador.articulos.show',$articulo->id) }}">
				  		<img width="25px" src="{{ asset('imagenes/admin/ver.png') }}" alt="Ver" title="Ver">
				  	</a>
				  </td>
				  <td>
				  	<a href="{{ route('moderador.articulos.edit',$articulo->id) }}">
				  		<img width="25px" src="{{ asset('imagenes/admin/editar.png') }}" alt="Editar" title="Editar">
				  	</a>
				  </td>
				  <td>
				  	<form method="POST" action="{{	route('moderador.articulos.destroy',$articulo->id) }}">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button class="eliminar" style="background-color:white ;border:0" type="submit" onclick="return confirm('¿Estás Seguro de eliminar este artículo?')">
				  			<img width="25px" src="{{ asset('imagenes/admin/eliminar.png') }}" alt="Eliminar" title="Eliminar">
				  		</button>
                      </form>
                      
				  </td>
				</tr>
				@endforeach
			</tbody>
		
	</table>
	<div class="row">
    	<div class="col-xs-12 col-lg-10 col-lg-offset-1">
    		{{ $articulos->links() }}
		</div>
	</div> 
</div>
@endsection
<!--
@section('articulos-css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
@endsection

@section('articulos-js')
<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function() {
	$('#articulos').DataTable({
        "serverSide": true,
        "ajax": "{{ url('/admin/articulos-datatable') }}",
        "columns":[
        	{data:'id'},
        	{data:'titulo'},
        	{data:'user.name'},
        	{data:'theme.nombre'},
        	{data:'created_at.date',
                render: function ( data, type, row ) {
                    let current_datetime = new Date(data);
                    let formatted_date = current_datetime.getDate() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getFullYear() + " " + current_datetime.getHours() + ":" + current_datetime.getMinutes() + ":" + current_datetime.getSeconds(); 
                    return formatted_date;        
                }
            },
            {data:'activo',
                render: function ( data, type, row ) {
                    if(data==1) return "Si";
                    else        return "No";                    
                }
            },
            {data:'id',
                render: function ( data, type, row ) {
                    return "<a href='/admin/articulos/"+data+"'><img width='25px' src='{{ asset('imagenes/admin/ver.png') }}'' alt='title 1' title='title 1'></a><a href='/admin/articulos/"+data+"/edit'><img width='25px' src='{{ asset('imagenes/admin/editar.png') }}' alt='title 1' title='title 1'></a><button class='eliminar' onclick='eliminar("+data+")' id='"+data+"' style='background-color:white ;border:0'><img width='25px' src='{{ asset('imagenes/admin/eliminar.png') }}'></button>"; 
                }
            }
        ],
        
    	/*"scrollY":        "1000px",*/
        /*"paging":         false,*/
        "lengthMenu": [[10,25,50,100,200,-1], [10,25,50,100,200, "Todos"]],
    	"language": {
            "lengthMenu": " _MENU_ artículos por página",
            /*"lengthMenu": 'Mostrar <select>'+
            				'<option value="10">10</option>'+
            				'<option value="25">25</option>'+
            				'<option value="50">50</option>'+
            				'<option value="100">100</option>'+
            				'<option value="-1">Todos</option>'+
            				'</select> Registros',*/
            "zeroRecords": "No he encontrado nada, lo siento",
            "info": "Mostrando _TOTAL_ Entradas",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ total archivos)",
            "search":"Buscar",
            "paginate":{
            	"next":"Siguiente",
            	"previous":"Anterior"
            }
		}
    });
   
    $('#eliminar').click(function(){
        if(!confirm("¿Estás seguro?")){
            return false;
        }
        var url='/admin/eliminar-todos-articulos';
        toastr.info('Espere mientras se eliminan todos los artículos', {
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        });
        axios.delete(url).then(response =>{ //eliminamos
            toastr.success('Todos los artículos han sido eliminados','¡Bien!', {
                "progressBar": true,
                "positionClass": "toast-bottom-right",
            }); 
            $('#articulos').DataTable().ajax.reload(); 
        }).catch(error => {
            alert(error);
        });
    });
});

function eliminar(id){
    var url='/admin/articulos/'+ id;
    axios.delete(url).then(response =>{ //eliminamos
        toastr.success('El artículo ha sido eliminado','¡Bien!', {
            "progressBar": true,
            "positionClass": "toast-bottom-right",
        });
        $('#articulos').DataTable().ajax.reload();   
    }).catch(error => {
        alert(error);
    });
}
</script>
@endsection  -->