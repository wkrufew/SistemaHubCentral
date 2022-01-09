@extends('layouts.app')

@section('titulo', 'Buscador')

@section('content')


<section class="features3 cid-rPhPXVhNu6" id="features3-8" style="padding-top: 180px">
<div class="mbr-overlay" style="opacity: 0.8; background-color: #e4e5e6">
    </div>
    @if(!isset($articulosPermitidos))
        <div class="container">
        
            <div class="row">
                
                @foreach($articulos as $articulo)
                <div class="card p-4 col-12 col-md-6 col-lg-4">
                    <div class="card-wrapper img-fluid" madal-id="#a{{$articulo->id}}" style="border-radius: 30px">
                        <div class="card-img img-fluid">
                            <a data-fancybox href="{{ Storage::url('imagenesArticulos/'.$articulo->imagenDestacada()) }}">
                                <img class="cadr-img-top img-fluid" style="border-radius: 30px; height: 13rem;" src=" {{ Storage::url('imagenesArticulos/'.$articulo->imagenDestacada()) }}" >
                            </a>
                        </div>
                        <div class="card-box">
                            <h4 class="card-title">
                            {{ $articulo->titulo}}
                            </h4>
                        <!--   <p  style="text-align : justify; FONT-SIZE: 12px; overflow:hidden; white-space:nowrap; text-overflow: ellipsis;"  class="mbr-text mbr-fonts-style display-7">
                            {{ $articulo->contenido}}
                            </p>-->
                        </div>
                        <div class="card-box" style="text-align : justify;">
                            <p class="mbr-section-text lead" style="text-align : justify; FONT-SIZE: 12px;">  <span class="mbri-clock mbr-iconfont mbr-iconfont-btn "></span> {{ $articulo->created_at->locale('es')->diffForHumans()   }}</p>  
                        </div>
                        <div class="mbr-section-btn text-center">
                            <a class="btn btn-primary btn-sm display-4" data-toggle="modal" data-target="#a{{$articulo->id}}">
                                Ver mas
                            </a>
                        </div>
                        
                    </div>
                </div>

            @endforeach
            </div>
            

            @foreach($articulos as $articulo)
        <!--INICIO DEL MODAL-->
        <div class="modal fade" id="a{{$articulo->id}}" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="dialog">
                                <div class="modal-content justify-content-center">
                                @if($articulo->imagenes->first())
                                    <div class="modal-header justify-content-center">
                                    
                                        <div class="justify-content-center d-none d-sm-none d-md-block" style="justify-content: center; display:inline-block ">
                                            @foreach($articulo->imagenes as $imagen)
                                                @if($imagen->articulo_id === $articulo->id)  
                                                    <a data-fancybox="gallery2{{ $imagen->articulo_id }}" href="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
                                                @endif
                                                <img style="width:250px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}" class="img-responsive" alt="Imgen dañada"/> 
                                            @endforeach 
                                            </a> 
                                        </div>
                                    </div>
                                    <div style="text-align : center;" class="justify-content-center d-block d-sm-block d-md-none">
                                
                                    @foreach($articulo->imagenes as $imagen)
                                        <a data-fancybox="gallery3{{ $imagen->articulo_id }}" href="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
                                    @endforeach
                                    <img class="img-responsive" style="width:100%" src=" {{ Storage::url('imagenesArticulos/'.$articulo->imagenDestacada()) }}" ></a> 
                                </div>
                                <!--<img style="width:250px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}" class="img-responsive" alt="Imgen dañada"/> -->
                                @endif
                                    <div class="modal-body">
                                    <div class="row">
                                        <div  class="col-xs-12 col-sm-6">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $articulo->titulo}}</h5>
                                        </div>
                                        <div style="text-align: right;" class="col-xs-12 col-sm-6">
                                            <p class="mbr-section-text lead" style="text-align : right; FONT-SIZE: 11px;">  <span class="mbri-clock mbr-iconfont mbr-iconfont-btn "></span> {{ $articulo->created_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $articulo->created_at->locale('es')->isoFormat('YYYY, h:mm a') }}</p>
                                        </div>
                                    
                                    </div>
                                        <p style="text-align : justify; FONT-SIZE: 14px; " class="mbr-section-text lead"> {!! $articulo->contenido !!}</p>  
                                        
                                    </div>
                                <!--  <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cerrar</button>
                                        
                                    </div>-->
                                <!-- INICIO DEL COMENTARIO-->
                                {{-- Comentarios --}}
                                    <div class="row">
                                        <div style="float: left;"  class="col-xs-6 col-sm-8">
                                            <div style="float: left;"  class="modal-footer">
                                                <strong style="FONT-SIZE: 12px;">Comentarios : </strong>
                                                                        @auth<a  style="float: left; FONT-SIZE: 13px;" href="#" class="nuevo-comentario">Agregar/Ocultar comentario</a>
                                                                        @else <a style="float: left; FONT-SIZE: 13px;"  href="{{ route('register') }}">Debe registrarse</a>
                                                                        @endauth
                                                <div id="success-enviar-comentario{{ $articulo->id }}" role="alert" class="alert alert-success" style="display: none; padding: 4px; FONT-SIZE: 12px;">Comentario se añadido con Éxito
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="error-enviar-comentario{{ $articulo->id }}" role="alert" class="alert alert-danger" style="background:#F96666; color:white; display: none; padding: 15px; FONT-SIZE: 12px;">El comentario esta vacio
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="caja-comentario{{ $articulo->id }}" class="caja-comentario" style="display: none; margin-top: 15px">
                                                    <form style="border-radius:25px;" method="POST" articulo="{{ $articulo->id }}">
                                                        <label style="text-align: right; FONT-SIZE: 12px;"> Caracteres restantes: <span></span></label>
                                                            <textarea style="width:100%; height:60px; border-radius:25px; padding:10px; FONT-SIZE: 12px;" maxlength="500"></textarea>
                                                        <button style="border-radius:50px" class="enviar-comentario btn btn-primary btn-sm" type="submit">Enviar</button> 
                                                    </form>
                                                    
                                                
                                                </div>
                                            </div>
                                            <div class="loading" style="display:none"  id="loading{{ $articulo->id }}">
                                                <img width="0px" src="{{asset('imagenes/loading.gif')}}">
                                            </div>
                                        </div>
                                        <div style="text-align: right;" class="col-xs-6 col-sm-4">
                                            <div style="text-align: right;" class="modal-footer">
                                                <a href="#" style="text-align: right; FONT-SIZE: 13px;" class="comentarios-ver" articulo="{{ $articulo->id }}">Ver Comentarios</a>
                                            </div>
                                        </div>
                                    </div>
                                        
                                        <div style="margin-top:15px;" class="comentarios-mostrar" id="comentarios{{ $articulo->id }}">
                                            {{-- Aquí se van a mostrar todos los comentarios del articulo. Lo que está abajo comentado --}}
                                        </div>  
                                        {{-- Comentarios --}}
                                <!-- FIN DEL COMENTAIRO-->
                                    <div class="modal-footer">
                                        
                                        <button type="button" style="border-radius: 50px" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cerrar</button>
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                        <!-- FIN DEL MODAL-->
            @endforeach
                
            </div>
            @else
            <div class="container">
        
            
            <div class="row">
                
            
                @foreach($articulosPermitidos as $articulo)
                <div class="card p-3 col-12 col-md-6 col-lg-4">
                    <div class="card-wrapper img-fluid" madal-id="#a{{$articulo->id}}" style="border-radius: 30px">
                        <div class="card-img img-fluid">
                            <a data-fancybox href="{{ Storage::url('imagenesArticulos/'.$articulo->imagenDestacada()) }}">
                                <img class="cadr-img-top img-fluid" style="border-radius: 30px; height: 13rem;" src=" {{ Storage::url('imagenesArticulos/'.$articulo->imagenDestacada()) }}" >
                            </a>
                        </div>
                        <div class="card-box">
                            <h4 class="card-title">
                            {{ $articulo->titulo}}
                            </h4>
                            <!-- <p  style="text-align : justify; FONT-SIZE: 12px; overflow:hidden; white-space:nowrap; text-overflow: ellipsis;"  class="mbr-text mbr-fonts-style display-7">
                            {{ $articulo->contenido}}
                            </p>-->
                        </div>
                        <div class="card-box" style="text-align : justify;">
                            <p class="mbr-section-text lead" style="text-align : justify; FONT-SIZE: 12px;">  <span class="mbri-clock mbr-iconfont mbr-iconfont-btn "></span> {{ $articulo->created_at->locale('es')->diffForHumans()   }}</p>  
                        </div>
                        <div class="mbr-section-btn text-center">
                            <a class="btn btn-primary btn-sm display-4" data-toggle="modal" data-target="#a{{$articulo->id}}">
                                Ver mas
                            </a>
                        </div>
                        
                    </div>
                </div>
                    @endforeach
                

            
            </div>
            
        

        @foreach($articulosPermitidos as $articulo)
        <!--INICIO DEL MODAL-->
        <div class="modal fade" id="a{{$articulo->id}}" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="dialog">
                                <div class="modal-content justify-content-center">
                                @if($articulo->imagenes->first())
                                    <div class="modal-header justify-content-center">
                                    
                                        <div class="justify-content-center d-none d-sm-none d-md-block" style="justify-content: center; display:inline-block ">
                                            @foreach($articulo->imagenes as $imagen)
                                                @if($imagen->articulo_id === $articulo->id)  
                                                    <a data-fancybox="gallery2{{ $imagen->articulo_id }}" href="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
                                                @endif
                                                <img style="width:250px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}" class="img-responsive" alt="Imgen dañada"/> 
                                            @endforeach 
                                            </a> 
                                        </div>
                                    </div>
                                    <div style="text-align : center;" class="justify-content-center d-block d-sm-block d-md-none">
                                
                                    @foreach($articulo->imagenes as $imagen)
                                        <a data-fancybox="gallery3{{ $imagen->articulo_id }}" href="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
                                    @endforeach
                                    <img class="img-responsive" style="width:100%" src=" {{ Storage::url('imagenesArticulos/'.$articulo->imagenDestacada()) }}" ></a> 
                                </div>
                                <!--<img style="width:250px" src="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}" class="img-responsive" alt="Imgen dañada"/> -->
                                @endif
                                    <div class="modal-body">
                                    <div class="row">
                                        <div  class="col-xs-12 col-sm-6">
                                            <h5 class="modal-title" id="exampleModalLabel">{{ $articulo->titulo}}</h5>
                                        </div>
                                        <div style="text-align: right;" class="col-xs-12 col-sm-6">
                                            <p class="mbr-section-text lead" style="text-align : right; FONT-SIZE: 11px;">  <span class="mbri-clock mbr-iconfont mbr-iconfont-btn "></span> {{ $articulo->created_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $articulo->created_at->locale('es')->isoFormat('YYYY, h:mm a') }}</p>
                                        </div>
                                    
                                    </div>
                                        <p style="text-align : justify; FONT-SIZE: 14px; " class="mbr-section-text lead"> {!! $articulo->contenido !!}</p>  
                                        
                                    </div>
                                <!--  <div class="modal-footer">
                                        
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cerrar</button>
                                        
                                    </div>-->
                                <!-- INICIO DEL COMENTARIO-->
                                {{-- Comentarios --}}
                                    <div class="row">
                                        <div style="float: left;"  class="col-xs-6 col-sm-8">
                                            <div style="float: left;"  class="modal-footer">
                                                <strong style="FONT-SIZE: 12px;">Comentarios : </strong>
                                                                        @auth<a  style="float: left; FONT-SIZE: 13px;" href="#" class="nuevo-comentario">Agregar/Ocultar comentario</a>
                                                                        @else <a style="float: left; FONT-SIZE: 13px;"  href="{{ route('register') }}">Debe registrarse</a>
                                                                        @endauth
                                                <div id="success-enviar-comentario{{ $articulo->id }}" role="alert" class="alert alert-success" style="display: none; padding: 4px; FONT-SIZE: 12px;">Comentario se añadido con Éxito
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="error-enviar-comentario{{ $articulo->id }}" role="alert" class="alert alert-danger" style="background:#F96666; color:white; display: none; padding: 15px; FONT-SIZE: 12px;">El comentario esta vacio
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div id="caja-comentario{{ $articulo->id }}" class="caja-comentario" style="display: none; margin-top: 15px">
                                                    <form style="border-radius:25px;" method="POST" articulo="{{ $articulo->id }}">
                                                        <label style="text-align: right; FONT-SIZE: 12px;"> Caracteres restantes: <span></span></label>
                                                            <textarea style="width:100%; height:60px; border-radius:25px; padding:10px; FONT-SIZE: 12px;" maxlength="500"></textarea>
                                                        <button style="border-radius:50px" class="enviar-comentario btn btn-primary btn-sm" type="submit">Enviar</button> 
                                                    </form>
                                                    
                                                
                                                </div>
                                            </div>
                                            <div class="loading" style="display:none"  id="loading{{ $articulo->id }}">
                                                <img width="0px" src="{{asset('imagenes/loading.gif')}}">
                                            </div>
                                        </div>
                                        <div style="text-align: right;" class="col-xs-6 col-sm-4">
                                            <div style="text-align: right;" class="modal-footer">
                                                <a href="#" style="text-align: right; FONT-SIZE: 13px;" class="comentarios-ver" articulo="{{ $articulo->id }}">Ver Comentarios</a>
                                            </div>
                                        </div>
                                    </div>
                                        
                                        <div style="margin-top:15px;" class="comentarios-mostrar" id="comentarios{{ $articulo->id }}">
                                            {{-- Aquí se van a mostrar todos los comentarios del articulo. Lo que está abajo comentado --}}
                                        </div>  
                                        {{-- Comentarios --}}
                                <!-- FIN DEL COMENTAIRO-->
                                    <div class="modal-footer">
                                        
                                        <button type="button" style="border-radius: 50px" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cerrar</button>
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                        <!-- FIN DEL MODAL-->
        @endforeach
            
        </div>

    @endif 


    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <script src="{{ asset('assets/web/assets/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>  
    
 
  
   
    
   <!-- INICIO DEL SCRIPT-->
   <script>
		function eliminarComentario(comentario_id){
			var url='/comentario-borrar/'+ comentario_id;
            axios.delete(url).then(response =>{ //eliminamos
            	$('#'+comentario_id).addClass("animated zoomOutRight");     // Eliminar con efecto
            	$('#'+comentario_id).fadeOut(1000);	   // Eliminar con efecto
            }).catch(error => {
            	alert(error);
            }); 
		}

		$(document).ready(function() {
			// Hace aparecer la caja del comentario
			$('.nuevo-comentario').click(function(){
				$(this).siblings('.caja-comentario').toggle('fast');
                
			});

			// Mostrar Comentario
			$('.comentarios-ver').click(function(){
				var articulo_id=$(this).attr('articulo');
			    var comentariosMostrar = document.getElementById('comentarios'+articulo_id);
	            axios.get('/comentarios-mostrar/' + articulo_id,{responseType:'text'}).then(response => {
		        	comentariosMostrar.innerHTML = response.data;
			    }).catch(error => {
			        console.log(error);
			    });
			});

			// Enviar comentario
			$('.enviar-comentario').click(function(e){
		    	e.preventDefault();					// Para que la página no se actualice ya que la acción se realiza dentro de un formulario.
		    	var articulo_id = $(this).parents('form').attr('articulo');
		    	var texto=$(this).siblings('textarea').val();

		    	var loading = document.getElementById('loading'+articulo_id);
		    	loading.style.display='block';

				axios.post('/comentario-aniadir',{responseType:'text',texto,articulo_id}).then(response =>{ // Añadimos el comentario.
					$('#success-enviar-comentario'+articulo_id).hide('slow');
					$('#error-enviar-comentario'+articulo_id).hide('slow');
					$('#caja-comentario'+articulo_id).hide('slow');
                    var texto=$(this).siblings('textarea').val('');
                    toastr.success('El comentario a sido añadido con exito','¡Bien!', {
                                        "progressBar": true,
                                        "positionClass": "toast-top-right",
                                    });
                }).catch(error => {
                	$('#error-enviar-comentario'+articulo_id).hide('slow');
                	$('#success-enviar-comentario'+articulo_id).hide('slow');
                    toastr.error('Error al enviar un comentario vacio','¡Falló!', {
                                        "progressBar": true,
                                        "positionClass": "toast-top-right",
                                    });
                           
                }).then(function() {
				    loading.style.display = 'none';
				});

                // Una vez metido el comentario, refrescamos todos los comentarios
                var comentariosMostrar = document.getElementById('comentarios'+articulo_id);
                axios.get('/comentarios-mostrar/' + articulo_id,{responseType:'text'}).then(response => {
		        	comentariosMostrar.innerHTML = response.data;
			    }).catch(error => {
			        console.log(error);
			    });
		    });
		});
		// Contador caracteres
		var inputs = "input[maxlength], textarea[maxlength]";
	    $(document).on('keyup', "[maxlength]", function (e) {
        var este = $(this),
            maxlength = este.attr('maxlength'),
            maxlengthint = parseInt(maxlength),
            textoActual = este.val(),
            currentCharacters = este.val().length;
            remainingCharacters = maxlengthint - currentCharacters,
            espan = este.prev('label').find('span');            
            if (document.addEventListener && !window.requestAnimationFrame) {
                if (remainingCharacters <= -1) {
                    remainingCharacters = 0;            
                }
            }
            espan.html(remainingCharacters); 
        });
	</script>
   <!-- FIN DEL SCRIPT-->
</section>

@include('includes.login-modal')
@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}" defer></script>
  @endsection
@endif

