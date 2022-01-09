@extends('layouts.appAdmin')

@section('content')
<main class="main">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a style=" color:#941b94;" href="#">Administración</a></li>
               
            </ol>
            <div class="container-fluid">
			<div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Slider&nbsp;&nbsp;
                    </div>
                    <div class="card-body">
					<div style="margin-top: 0px; margin-bottom: 5px;" class="container">
						<h6>Resolución recomendada: 1920x1080 (HD)</h6>
						<form style="text-align:center;"  action="{{ url('admin/slider') }}" class="dropzone" id="my-awesome-dropzone">
							@csrf
						</form>
						<hr>

						<div class="row">
						<div class="col-xs-12 col-sm-4"></div>
						<div style="text-align:center;"  class="col-xs-12 col-sm-4">
						<button style="border-radius: 40px;margin-bottom: 6px;" type="button"id="refresh" class="btn btn-perzonalizado">Refrescar</button>
						<div id="imagenesv" class="col">
						
							{{-- Aquí mostramos las imágenes --}}
						</div>
						</div>
						<div class="col-xs-12 col-sm-4"></div>
						</div>

						
					</div>
						
					</div>
            </div>
               
            </div>
        </main>
		
	{{-- CSS --}}
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dragula.css') }}">

	
   
	{{-- js--}}
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js'></script>
	
	<script>

	$(document).ready(function() {
		$('#refresh').click(function(){
			mostrarImagenes();
		});
	});
	function mostrarImagenes()
	{
		var imagenesMostrar = document.getElementById('imagenesv');
        axios.get('/admin/imagenes-slider',{responseType:'text'}).then(response => {
        	imagenesMostrar.innerHTML=response.data;
			//alert('mostrando papu');
	    }).catch(error => {
	        console.log(error);
			alert(error);
	    });
	}

	function eliminarImagen(id)
	{
		var url='/admin/slider/'+id;
        axios.delete(url).then(response =>{ //eliminamos
        	mostrarImagenes();
			toastr.error('La imagen ha sido eliminada','¡Bien!', {
					"progressBar": true,
					"positionClass": "toast-top-right",
				});
        }).catch(error => {
        	alert(error);
        }); 
	}

	$(document).ready(function() {
		mostrarImagenes();
		Dropzone.options.myAwesomeDropzone = {
		    paramName: "file", // Las imágenes se van a usar bajo este nombre de parámetro
		    maxFilesize: 2, // Tamaño máximo en MB
		    success: function (file, response) {
		        mostrarImagenes();
		    }
		};

		dragula([document.getElementById('imagenesv')])
		  .on('drop', function (el) {
		  	var ultimo=false;
		  	var posicionInicial=el.id;
		  	var posicionFinal=$('#'+el.id).next().attr('id');
		  	if(posicionFinal==undefined){
		  		posicionFinal=false;
		  		ultimo=true; // Cuando idSecundario=0, tomará la última posición.
		  	}
		  	axios.get('/admin/imagenes-ordenar/'+ posicionInicial +'/'+ posicionFinal +'/'+ ultimo,{responseType:'text'}).then(response => {
				
		  		mostrarImagenes();
				
		  		toastr.info('La imagen a cambiado su posición','¡Bien!', {
					"progressBar": true,
					"positionClass": "toast-top-right",
				});
		    }).catch(error => {
		        console.log(error);
		    });
		  });
	});
	</script>
@endsection
