@extends('layouts.appAdmin')

@section('content')

<form method="POST" action="{{ route('usuarios.update',$usuario) }}" class="temaFormuEdit">
	@csrf
	{{ method_field('PUT') }}	
	<div style="margin-top: 150px; margin-bottom: 180px; " class="container">
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
	            
                <div style="margin-top: 35px; margin-bottom: 20px; text-align:center;">
					<button style="border-radius: 40px" type="submit" class="btn btn-primary">Actualizar</button>
					<button style="border-radius: 40px" type="button" class="btn btn-secondary"><a href="{{ url('/admin/usuarios') }}">Cancelar</a></button>
				</div>
	        </div>
	    </div>
	</div>
</form>

@endsection