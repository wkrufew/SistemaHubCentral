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
                        <button style="border-radius: 40px"   type="button" class="btn btn-perzonalizado" data-toggle="modal" data-target="#modalCrear">
                            <i  class="icon-plus"></i>&nbsp;Agregar Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class=" col-md-3">
                            <div class="input-group">
                                <span><b>Total de artículos: &nbsp;{{ $articulos->count()}}</b></span>
                                </div>
                              
                            </div>
                            <div class="col-md-6">
                               
                              
                            </div>
                            <div class="col-md-3">
                                
                                <div class="input-group">
                                <form class="form-inline" action="{{url('admin/buscador/articulos')}}" method="GET">
                                    @csrf
                                    <input style="border-radius: 40px; text-align:center;" type="text" id="exampleInputEmail2" name="busqueda" class="form-control" placeholder="Artículo/Autor/Tema">
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
                                    <th>Titulo</th>
                                    <th >Autor</th>
                                    <th>Tema</th>
                                    <th>Fecha</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($articulos as $articulo)
                                <tr>
                                    <td>
                                    
                                    <a href="{{  route('articulos.edit',$articulo->id) }}"><button  type="button" class="btn btn-primary btn-sm"><i class="icon-pencil"></i>
                                    </button></a>&nbsp;

                                    <button type="button" class="btn btn-perzonalizado btn-sm" data-toggle="modal" data-target="#modalVer{{$articulo->id}}">
                                          <i class="icon-eye"></i>
                                    </button>
                                                                <div class="modal fade" id="modalVer{{$articulo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-personalizado modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Detalles del Artículo</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="GET" action="{{ route('articulos.show',$articulo->id) }}" enctype="multipart/form-data" class="temaFormuEdit">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                           
                                                                                <div style="text-align:center; margin-top:5px; margin-bottom:5px;">

                                                                                <div style="margin-top:10px; margin-bottom:20px; text-align:center; FONT-SIZE:25px" >
                                                                                    <b>{{ $articulo->titulo }}</b>
                                                                                </div>

                                                                                <div >

                                                                                   
                                                                                    <div class="row" style="justify-content: center; display:inline-block ">
                                                                                        @foreach($articulo->imagenes as $imagen)
                                                                                            <img src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
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
                                                                &nbsp; 
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
                                                                    <p>Estas seguro de eliminar el Artículo?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" style="border-radius: 40px" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                                   

                                                                    <form method="POST" action="{{	route('articulos.destroy',$articulo->id) }}">
                                                                        @csrf
                                                                        {{ method_field('DELETE') }}
                                                                        <button class="btn btn-danger" style="border-radius: 40px" type="submit" >Eliminar</button>
                                                                        
                                                                    </form> 
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                       
                                                    </div>
                                                 
                                        </div>
                                        
                                           
                                    </td>
                                    <td>{{ $articulo->titulo }}</td>
                                    <td>{{ $articulo->user->name }}</td>
                                    <td>{{ $articulo->tema->nombre }}</td>
                                    <td>{{ $articulo->created_at->formatLocalized('%A %d %B %Y')  }}</td>
                                    
                                    @if($articulo->activo)
                                    <td>
                                        <span class="badge badge-success">Activo</span>
                                    </td>
                                    @else
                                    <td>
                                        <span class="badge badge-danger">Desactivado</span>
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