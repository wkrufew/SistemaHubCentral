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
                        <i class="fa fa-align-justify"></i> Grupos&nbsp;&nbsp;
                        <button style="border-radius: 40px"   type="button" class="btn btn-perzonalizado" data-toggle="modal" data-target="#modalCrear">
                            <i  class="icon-plus"></i>&nbsp;Agregar Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class=" col-md-3">
                            <div class="input-group">
                                <span><b>Total de artículos: &nbsp; {{ $grupos->count()}}</b></span>
                                </div>
                              
                            </div>
                            
                            
                        </div>
                            @if(session('notificacion'))   
                                <div class="alert alert-success" role="alert">
                                {{session('notificacion')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(session('notificacion2'))   
                                <div class="alert alert-success" role="alert">
                                {{session('notificacion2')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                          
                        <table class="table table-bordered table-sm table-hover">
                            <thead>
                                <tr>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Cargo</th>
                                    <th>Descripcion</th>
                                    <th>Imagen</th>
                                    <th>Fecha de creación</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($grupos as $grupo)
                                <tr>
                                    <td>
                                   
                                    <a href="{{  route('grupos.edit',$grupo->id) }}"><button  type="button" class="btn btn-primary btn-sm"><i class="icon-pencil"></i>
                                    </button></a>&nbsp;

                                    <button type="button" class="btn btn-perzonalizado btn-sm" data-toggle="modal" data-target="#modalVer{{$grupo->id}}">
                                          <i class="icon-eye-open"></i>
                                    </button>
                                                                <div class="modal fade" id="modalVer{{$grupo->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                                                                    <div class="modal-dialog modal-personalizado modal-lg" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Detalles del Integrante</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">×</span>
                                                                                </button>
                                                                            </div>
                                                                            <form method="GET" action="" enctype="multipart/form-data" class="temaFormuEdit">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                           
                                                                                <div style="text-align:center; margin-top:5px; margin-bottom:5px;">

                                                                                <div style="margin-top:10px; margin-bottom:20px; text-align:center; FONT-SIZE:25px" >
                                                                                    <b>{{ $grupo->nombre }}</b>
                                                                                </div>

                                                                                <div >
                                                                                   
                                                                                    <div class="row" style="justify-content: center; display:inline-block ">
                                                                                       
                                                                                            <img style="width:150px" src="{{ Storage::url('ImagenesGrupo/'.$grupo->imagen) }}">
                                                                                      
                                                                                    </div>
                                                                                </div>

                                                                                <div style="margin-top:10px; margin-bottom:20px; text-align:center; FONT-SIZE:25px" >
                                                                                    <b>{{ $grupo->cargo }}</b>
                                                                                </div>
                                                                                <div style=" margin-top: 20px" class="row">
                                                                                    <div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
                                                                                    <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
                                                                                        {{$grupo->descripcion}}
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
                                       <form method="POST" action="{{	route('grupos.destroy',$grupo->id) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="button" class="btn btn-danger btn-sm eliminar">
                                                        <i class="icon-trash"></i>
                                                    </button>  
                                            </form> 
                                       
                                    
                                    </td>
                                    <td>{{ $grupo->nombre }}</td>
                                    <td>{{ $grupo->cargo }}</td>
                                    <td>{{ $grupo->descripcion }}</td>
                                    <td style="text-align:center; "><img style="width:80px" src="{{ Storage::url('ImagenesGrupo/'.$grupo->imagen) }}"></td>
                                    <td>{{ $grupo->created_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $grupo->created_at->locale('es')->isoFormat('YYYY, h:mm a') }}</td>
                                    

                                  
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
              
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
            <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
            
            <script>
                $(document).ready(function() {
                    $('.eliminar').click(function(e){
                        e.preventDefault();
                        Swal.fire({
                            title: 'Estas seguro de eliminar a este integrante?',
                            text: "No se prodran revertir los cambios!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            cancelButtonText: 'No, cancelar!',
                            confirmButtonText: 'Si, eliminar esto!'
                            }).then((result) => {
                            if (result.value) {
                                var url = $(this).parents("form").attr('action');
                                axios.delete(url).then(response =>{ //eliminamos
                                    toastr.success('El integrante ha sido eliminado','¡Bien!', {
                                        "progressBar": true,
                                        "positionClass": "toast-top-right",
                                    }); 
                                }).catch(error => {
                                    toastr.error('Error');
                                });
                                var row = $(this).parents('tr');
                                row.fadeOut();
                                /* Swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )*/
                            } else
                            toastr.error('Has cancelado la eliminacion del integrante','¡En hora buena!', {
                                        "progressBar": true,
                                        "positionClass": "toast-top-right",
                                    });
                            })
                        
                    });
                });
            </script>
        </main>

        @include('includes.createAdminGrupo-modal')

@endsection

@if($errors->any())
  @section('include-createAdminGrupo-modal')
  <script src="{{ asset('js/createAdminGrupo-modal.js') }}" defer></script>
  @endsection
@endif

