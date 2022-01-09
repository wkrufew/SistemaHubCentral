@extends('layouts.appModerador')

@section('content')
<div style="margin-top:150px; margin-bottom:180px;" class="container">
<div style="text-align:center;">
    <div style="margin-top:20px; margin-bottom:20px; text-align:center; FONT-SIZE:25px" >
        <b>{{ $articulo->titulo }}</b>
    </div>

	<div class="row ">
   
	    <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>
	    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	    	@foreach($articulo->imagenes as $imagen)
	    		<img width="230px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
	    	@endforeach
	    </div>
	</div>
	<div style=" margin-top: 20px" class="row">
		<div class="col-xs-12 col-sm-12 col-md-1 col-lg-1"></div>
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
			{!! $articulo->contenido !!}
		</div>
       
	</div>
    <div style="margin-top:30px;">
        <button style="border-radius: 40px" type="button" class="btn-personalizado btn-sm"><a href="{{ url('/moderador/articulos') }}">Volver</a></button>
       
        
    </div>
    </div>
</div>
@endsection