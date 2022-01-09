@extends('layouts.appModerador')

@section('content')
<div class="app-body">
        <div class="sidebar">
            <nav class="sidebar-nav">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="main.html"><i class="icon-speedometer"></i> Escritorio</a>
                    </li>
                    <li class="nav-title">
                        Funciones del Moderador
                    </li>                   

                    <li class="nav-item">
                        <a class="nav-link" href="main.html" onclick="location='{{ url('moderador/articulos') }}'"><i class="icon-book-open"></i> Articulos</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="main.html"><i class="icon-info"></i> Acerca de...<span class="badge badge-info">IT</span></a>
                    </li>
                </ul>
            </nav>
            <button class="sidebar-minimizer brand-minimizer" type="button"></button>
        </div>

        <!-- Contenido Principal -->
        <main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Administración</a></li>
               
            </ol>
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Actualizar Artículo&nbsp;&nbsp;
                       
                    </div>
                    <div class="card-body">
						<script src="//cdn.ckeditor.com/4.11.2/full/ckeditor.js"></script>
						<form method="POST" action="{{ route('moderador.articulos.update',$articulo->id) }}" enctype="multipart/form-data" class="temaFormuEdit">
							@csrf
							{{ method_field('PUT') }}	
							<div style="margin-top: 10px; margin-bottom: 20px;" class="container">
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
							<div class="row">
							@can('edit', $articulo)
								<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
								<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
									<div class="form-group">
										<label for="exampleInputPassword1">Titulo</label>
										<input type="text" class="form-control" name="titulo" value="{{ old('titulo',$articulo->titulo) }}">
									</div>
									<hr>
									<div class="form-group">
										<label for="exampleInputPassword1">Categoria</label>
										<select class="form-control" name="tema_id">
											@foreach($temasTodos as $tema)
											<option value="{{ $tema->id }}" {{ old('tema_id', $articulo->tema_id) == $tema->id ? 'selected' : '' }}>
												{{ $tema->nombre }}
											</option>
											@endforeach
										</select>
									</div>
									<hr>
									<div class="form-group">
										<label for="exampleInputPassword1">Contenido</label>
										<textarea class="form-control" rows="5" name="contenido">{{ old('contenido',$articulo->contenido) }}</textarea>
										<script>
										CKEDITOR.replace( 'contenido' );
										</script>
									</div>
									<hr>
									@foreach($articulo->imagenes as $imagen)
										<img width="190px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
											<a href="{{ route('moderador.imagen.delete',$imagen) }}">
												<img style="cursor:pointer; margin-left: -5px; margin-top: -200px" width="20px" src="{{asset('imagenes/admin/eliminar.png')}}">
											</a>
									@endforeach
									@if($articulo->imagenes->count()<3)
										<p><h6>Añadir imágenes (máximo 3 imágenes por artículo)</h6></p>
									@endif
									<div class="container">
										@for($i=3;$i>$articulo->imagenes->count();$i--)
											<div style="margin-top: 20px" class="row">  
											<div style="margin-top: 20px" class="col-1">
												<input type="file" name="foto{{$i}}"></input>
											</div>
											</div>
										@endfor
									</div>
									<hr>
									<!--@can('edit', $articulo)
										<button type="submit" class="btn btn-info btn-sm">Actualizar</button>
									@endcan-->
									
									
									<div style="margin-top: 35px; margin-bottom: 20px; text-align:center;">
											

									<a href="{{ url('/moderador/articulos') }}"><button style="border-radius: 40px;  margin-right: 50px;" type="button" class="btn btn-danger" >Cancelar</button></a>
                                    		<button style="border-radius: 40px" type="submit" class="btn btn-perzonalizado">Actualizar</button>
									</div>
								</div>
							</div>
							@else
							<p><h6>Detente no tienes acceso a este articulo ..!!!</h6></p>
							@endcan 
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
        <!-- /Fin del contenido principal -->
    </div>



@endsection

