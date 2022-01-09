@extends('layouts.appAdmin')

@section('content')

<<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Administración</a></li>
               
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Actualizar Tema&nbsp;&nbsp;
                       
                    </div>
                    <div class="card-body">
						
						<form method="POST" action="{{ route('tema.update',$tema) }}" enctype="multipart/form-data" class="temaFormuEdit">
							@csrf
							{{ method_field('PUT') }}	
							<div style="margin-top: 10px; margin-bottom: 10px;" class="container">
								@if(session('notificacion2'))   
									<div class="alert alert-danger" role="alert">
									{{session('notificacion2')}}
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
	    <div class="row">
	        <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
	        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	            <div class="form-group">
	                <label for="exampleInputPassword1"><b>Nombre</b></label>
	                <input type="text" class="form-control" name="nombre" value="{{ old('nombre',$tema->nombre) }}">
	            </div>
	            <hr>
	            <p><b>Destacado</b></p>
	            <div class="radio">
				  <label>
				    <input type="radio" name="destacado" value="1" @if((old('destacado',$tema->destacado))) checked @endif>
				    	Si
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="destacado" value="0" @if(!(old('destacado',$tema->destacado))) checked @endif>
				    	No
				  </label>
				</div>
				<hr>
				<p><b>Suscripción</b></p>
				<div class="radio">
				  <label>
				    <input type="radio" name="suscripcion" value="1" @if((old('suscripcion',$tema->suscripcion))) checked @endif>
				    	Si
				  </label>
				</div>
				<div class="radio">
				  <label>
				    <input type="radio" name="suscripcion" value="0" @if(!(old('suscripcion',$tema->suscripcion))) checked @endif>
				    	No
				  </label>
				</div>
				<hr>
				<div style="margin-top: 35px; margin-bottom: 20px; text-align:center;">
					
					<a href="{{ url('/admin/temas') }}"><button style="border-radius: 40px;  margin-right: 50px;" type="button" class="btn btn-danger" >Cancelar</button></a>
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