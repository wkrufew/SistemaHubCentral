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
                <script src="//cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>
                <form method="POST" action="{{ url('admin/correo-masivo') }}"  class="form-horizontal">
                    @csrf        
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Correo Masivos&nbsp;&nbsp;
                        <button style="border-radius: 40px"   type="submit" class="btn btn-perzonalizado">
                            <i  class="icon-envelope"></i>&nbsp;Enviar Correo
                        </button>
                    </div>
                    <div class="card-body">
                            
                            @if(session('notificacion'))   
                                <div class="alert alert-success" role="alert">
                                {{session('notificacion')}}
                                </div>
                            @endif
                        
                            @if($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach
                                    </ul>
                                </div>    
                            @endif
                            
                                
                                <div class="form-group row" style="margin-top: 15px; margin-bottom: 20px;">
                                <div class="col-md-2"> </div>
                                    <label class="col-md-1 form-control-label" for="text-input"><b>Asunto</b></label>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}">
                                    </div>
                                </div>
                                <div class="form-group row" style="margin-top: 15px; margin-bottom: 20px;">
                                <div class="col-md-2"></div>
                                    <label class="col-md-1 form-control-label" for="text-input"><b>Contenido</b></label>
                                    <div class="col-md-6">
                                        <textarea class="form-control" rows="3" name="contenido">{{ old('contenido') }}</textarea>
                                        <script>
                                        CKEDITOR.replace( 'contenido' );
                                        </script>
                                    </div>
                                </div>
                               
                               
                               
                                <div style="margin-top: 45px; margin-bottom: 15px; text-align:center;" class="">
                                   
                                    <button style="border-radius: 40px" type="submit" class="btn btn-perzonalizado">Enviar</button>                                   
                                </div>
                           
                       
                    </div>
                    </form>
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>  
            <!--Inicio del modal agregar/actualizar-->
            
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            
            <!-- Fin del modal Eliminar -->
        </main>

     

@endsection


