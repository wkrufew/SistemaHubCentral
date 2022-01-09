@extends('layouts.appAdmin')

@section('content')
<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Administración</a></li>
               
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Actualizar Usuario&nbsp;&nbsp;
                       
                    </div>
                    <div class="card-body">
<form method="POST" action="{{ route('usuarios.update',$usuario) }}" class="temaFormuEdit">
	@csrf
	{{ method_field('PUT') }}	
	<div style="margin-top: 20px; margin-bottom: 20px; text-align:center;" class="container">
	    <div class="row">
	        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
	        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	            <p><b>Bloqueado</b></p>
	            <div class="radio">
				  <label>
				    <input type="radio" name="bloqueado" value="1" @if($usuario->bloqueado) checked @endif>
				    	Si
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="bloqueado" value="0" @if(!$usuario->bloqueado) checked @endif>
				    	No
				  </label>
				</div>
				<hr>
				<p><b>Moderador</b></p>
				<div class="radio">
				  <label>
				    <input type="radio" name="moderador" value="1" @if($usuario->hasRole('moderador')) checked @endif>
				    	Si
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="moderador" value="0" @if(!$usuario->hasRole('moderador')) checked @endif>
				    	No
				  </label>
				</div>
	            <hr>
                <div style="margin-top: 35px; margin-bottom: 20px; text-align:center;">


					<a href="{{ url('/admin/usuarios') }}"><button style="border-radius: 40px;  margin-right: 50px;" type="button" class="btn btn-danger" >Cancelar</button></a>
					<button style="border-radius: 40px" type="submit" class="btn btn-perzonalizado">Actualizar</button>
					
                    
										

				</div>
	        </div>
	    </div>
	</div>
</form>
</div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
            <!-- Inicio del modal Eliminar -->
            
            <!-- Fin del modal Eliminar -->
        </main>
@endsection