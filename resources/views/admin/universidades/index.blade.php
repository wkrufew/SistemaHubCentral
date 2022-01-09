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
                        <i class="fa fa-align-justify"></i> Instituciones&nbsp;&nbsp;
                        <button style="border-radius: 40px"   type="button" class="btn btn-perzonalizado" data-toggle="modal" data-target="#modalCrear">
                            <i  class="icon-plus"></i>&nbsp;Agregar Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class=" col-md-3">
                            <div class="input-group">
                                <span><b>Total de Intituciones: &nbsp; {{ $universidades->count()}}</b></span>
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
                                    <th>url</th>
                                    <th>Imagen</th>
                                    <th>Fecha de creación</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                            
                            @foreach($universidades as $uni)
                                <tr>
                                    <td>
                                   
                                    <a href="{{  route('universidades.edit',$uni->id) }}"><button  type="button" class="btn btn-primary btn-sm"><i class="icon-pencil"></i>
                                    </button></a>                                                             
                                    &nbsp;
                                       <form method="POST" action="{{	route('universidades.destroy',$uni->id) }}">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button type="button" class="btn btn-danger btn-sm eliminar">
                                                        <i class="icon-trash"></i>
                                                    </button>  
                                            </form> 
                                       
                                    
                                    </td>
                                    <td>{{ $uni->url }}</td>
                                    <td style="text-align:center; "><img style="width:80px" src="{{ Storage::url('ImagenesUniversidades/'.$uni->imagen) }}"></td>
                                    <td>{{ $uni->created_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $uni->created_at->locale('es')->isoFormat('YYYY, h:mm a') }}</td>
                                    

                                  
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
                                    toastr.success('La institucion ha sido eliminado','¡Bien!', {
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
                            toastr.error('Has cancelado la eliminacion de la institucion','¡En hora buena!', {
                                        "progressBar": true,
                                        "positionClass": "toast-top-right",
                                    });
                            })
                        
                    });
                });
            </script>
        </main>

        @include('includes.createAdminUniversidad-modal')

@endsection

@if($errors->any())
  @section('include-createAdminUniversidad-modal')
  <script src="{{ asset('js/createAdminUniversidad-modal.js') }}" defer></script>
  @endsection
@endif

