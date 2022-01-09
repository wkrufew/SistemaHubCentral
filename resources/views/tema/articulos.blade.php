@extends('layouts.app')



@section('titulo') {{$tema->nombre}}  @endsection

@section('content')

<section  class="features3 cid-rPhPXVhNu6" id="features3-8" style="padding-top: 180px">
<div class="mbr-overlay" style="opacity: 0.8; background-color: #e4e5e6">
    </div>
    @if($usuarioAutenticado && !$usuarioBloqueado && $usuarioVerificado)

    <div class="container">
       <div class="row" style="margin-top: 0px">
            <div class="card p-3 col-6 col-md-6 col-lg-2" style="text-align : justify; FONT-SIZE: 14px; background:black" >
                <div style="text-align : justify; FONT-SIZE: 14px; color: white;"> {{$tema->nombre}}:&nbsp;{{$articulos->count()}}</div>
            </div>
       </div>
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
        <div class="card p-3 col-6 col-md-6 col-lg-2" class="card-wrapper sm">
            <div>
                {{ $articulos->links() }}
            </div>
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
                                <div style="text-align : center;" class="justify-content-center d-block d-sm-block d-md-none">
                                       
                                    @foreach($articulo->imagenes as $imagen)
                                        <a data-fancybox="gallery3{{ $imagen->articulo_id }}" href="{{ Storage::url('imagenesArticulos/'.$imagen->nombre) }}">
                                    @endforeach
                                    <img class="img-responsive" style="width:100%" src=" {{ Storage::url('imagenesArticulos/'.$articulo->imagenDestacada()) }}" ></a> 
                                        
                                </div>
                            </div>
                        @endif
                            <div class="modal-body" id="mandaid">
                            <div class="row">
                                <div  class="col-xs-12 col-sm-8">
                                    <h5 class="modal-title mandaid" articulo="{{ $articulo->id }}">{{ $articulo->titulo}}</h5>
                                </div>
                                <div style="text-align: right;" class="col-xs-12 col-sm-4">
                                    <p class="mbr-section-text lead" style="text-align : right; FONT-SIZE: 11px;">  <span class="mbri-clock mbr-iconfont mbr-iconfont-btn "></span> {{ $articulo->created_at->locale('es')->isoFormat('dddd D MMMM') }} del {{ $articulo->created_at->locale('es')->isoFormat('YYYY, h:mm a') }}</p>
                                </div>
                              
                            </div>
                              <p style="text-align : justify; FONT-SIZE: 14px; " class="mbr-section-text lead"> {!! $articulo->contenido !!}</p>  
                                
                            </div>
                            <div class="container col-xs-3 col-md-2">
                                <!--PILAS AQUI INICIA LOS LIKES-->
                               <!--   <p articulo="{{ $articulo->id }}"  id="likeCount{{ $articulo->id }}"><i class="fa fa-heart" style="color:red"></i> {{ $articulo->likesCount}}</p>-->
                               <p articulo="{{ $articulo->id }}" id="likeCount{{ $articulo->id }}" style="color:#941b94;  text-align:center; border-radius:50%; font-size: 18px;">{{ $articulo->likesCount}}</p>
                                @guest
                            
                                @else
                                    @if($articulo->liked)
                                     <p class="like" style="text-align:center; cursor:pointer; font-size: 14px" articulo="{{ $articulo->id }}" id="unlike{{ $articulo->id }}">&nbsp;&nbsp;&nbsp;&nbsp;te gusta&nbsp;<i class="fa fa-thumbs-up" style="color:#941b94"></i> </p>
                                     <p class="like" style="text-align:center; display:none; cursor:pointer; font-size: 14px" articulo="{{ $articulo->id }}" id="like{{ $articulo->id }}">&nbsp;&nbsp;&nbsp;&nbsp;Me gusta&nbsp;<i class="fa fa-thumbs-up" style="color:blue"></i></p>
                                    @else
                                    <p class="like" style="text-align:center; display:none; cursor:pointer; font-size: 14px" articulo="{{ $articulo->id }}" id="unlike{{ $articulo->id }}">&nbsp;&nbsp;&nbsp;&nbsp;Te gusta&nbsp;<i class="fa fa-thumbs-up" style="color:#941b94"></i></p>
                                     <p class="like" style="text-align:center; cursor:pointer; font-size: 14px" articulo="{{ $articulo->id }}" id="like{{ $articulo->id }}">&nbsp;&nbsp;&nbsp;&nbsp;Me gusta&nbsp;<i class="fa fa-thumbs-up" style="color:blue"></i></p>
                                    
                                    @endif
                                @endguest
                                
                            
                                <!--PILAS AQUI TERMINA LO DE LOS LIKES-->
                            </div>
                           
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
    

   
 
        <div style="" class="swiper-container">
                                        <!-- Additional required wrapper -->
                                        <div class="swiper-container">
                                                    <div class="swiper-wrapper">
                                                    @foreach($nuestras as $nuestra)       
                                                        <div class="swiper-slide" style="background-image:url({{Storage::url('ImagenesGrupo/'.$nuestra->imagen)}})"></div>
                                                    @endforeach
                                                    </div>
                                                    <!-- Add Pagination -->
                                                    <div class="swiper-pagination"></div>
                                                    <!-- Botones  next y prev  -->
                                        </div> 
                                        </div>  
    </div>      


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <script src="{{ asset('assets/web/assets/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>  
    
 
  
   
    
   <!-- INICIO DEL SCRIPT-->
   <script type="text/javascript">            
                
                                       
        @guest

        @else

        $('.like').on('click', function (){
            var arti=$(this).attr('articulo'); //traido el valor del id del articulo
            var user = {{ Auth::user()->id }};
         
            var urlpro = '/temas/'+arti+'/toggleLike'
           
            $.ajax({
                
                type: 'get',
                url: urlpro,
                data: user,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data){
                    //alert('pilas la url');
                    if(data.like.isLiked) {
                      
                        $('#like'+arti).hide();
                        $('#unlike'+arti).show();
                        $('#likeCount'+arti).html(data.like.likes);
                       // $('#likeCount'+arti).html('<i class="fa fa-user" style="color:red"></i>' + data.like.likes);
                    }else {
                      
                        $('#unlike'+arti).hide();
                        $('#like'+arti).show();
                        $('#likeCount'+arti).html(data.like.likes);
                        //$('#likeCount'+arti).html('<i class="fa fa-user" style="color:red"></i>' + data.like.likes);
                    }
                }
            });
        });
        @endguest
        /*FIN DE LOS LIKES */   
        
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




    @elseif(!$usuarioAutenticado)
	    <div style="width: 500px; margin: 20px auto 50px auto;  ">
	        <div style="background:#F96666; color:white;" class="alert alert-danger" role="alert">
	          <h4 class="alert-heading">Para, Por favor!</h4>
	          <p >Para acceder a este contenido debes suscribirte primero y luego iniciar sesión</p>
	          <hr>
	          <p class="mb-0" ><a href="{{url('/register')}}">Suscribirse</a></p>
	        </div>
	    </div>
 
    @elseif($usuarioBloqueado)
	    <div style="width: 500px; margin: 20px auto 50px auto;">
	        <div style="background:#F96666; color:white;" class="alert alert-danger" role="alert">
	          <h4 class="alert-heading">Para, Por favor!</h4>
	          <p>Has sido bloqueado</p>        
	        </div>
	    </div>

    @elseif(!$usuarioVerificado)
	    <div style="width: 500px; margin: 20px auto 50px auto;">
	        <div style="background:#F96666; color:white;" class="alert alert-danger" role="alert">
	          <h4 class="alert-heading">Para, Por favor!</h4>
	          <p>Aun no has verificado tu cuenta</p>        
	        </div>
	    </div>
    @endif
    <!--<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>-->
  
</section>

@include('includes.login-modal')
@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}" defer></script>
  @endsection
@endif

