@extends('layouts.app')



@section('content')


<section class="engine"><a href=""></a>
</section>
<section class="carousel slide cid-rPhydiGJ5A justify-content-center" data-interval="false" id="slider1-1">
            <div class="full-screen">
                <div  class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="5000">
                        
                        <ol class="carousel-indicators">
                            @foreach($imagenes->sortBy('orden') as $ordenar)
                                <li data-app-prevent-settings="" data-target="#slider1-1" class="@if ($loop->first) active @endif" data-slide-to="{{$ordenar->orden}}"></li>
                            @endforeach
                        </ol>

                        <div class="carousel-inner" role="listbox">
                                @foreach($imagenes->sortBy('orden') as $imagen)
                                <div class="carousel-item slider-fullscreen-image @if ($loop->first) active @endif" data-bg-video-slide="false" style="background-image: url({{ Storage::url('imagenesSlider/'.$imagen->nombre) }});">
                                    <div class="container container-slide">
                                        <div class="image_wrapper"><img src="{{ Storage::url('imagenesSlider/'.$imagen->nombre) }}" alt="" title="">
                                            <div class="carousel-caption justify-content-center">
                                                <div class="col-10 align-center"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                        </div>
                        <a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider1-1">
                            <span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider1-1">
                            <span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
                            <span class="sr-only">Next</span>
                        </a>
                </div>
            </div>

</section>



<section class="features3 cid-rPhPXVhNu6" id="features3-8">

    <div class="container">
        <div style="text-align:center" class="row justify-content-center">
        <!-- INICIO DEL PRIMER ROW BOTONES -->
            <!-- INICIO DE LOS BOTONES PARA IR AL QUIENES SOMOS NUESTRA VISIO  -->
            <div class="col-md-4 center-block">
               <!-- BOTON QUIENES SOMOS -->
               <a href="/quienessomos">
                    <button style="border-radius:16px; width:90%; margin-left:0px; margin-right:0px" type="button" class="btn btn-primary"> <label style="font-size:15px"> QUIENES SOMOS</label> </button>   
                </a>  
            </div>
           <div class="col-md-4 center-block">
                <!-- BOTON  MISION VISON -->
                <a href="/misionvision">
                <button style="border-radius:16px; width:90%; margin-left:0px; margin-right:0px" type="button" class="btn btn-primary"><label style="font-size:15px"> NUESTRA MISION/VISION</label></button>   
                </a> 
            </div>
           <div class="col-md-4 center-block">
                <!-- BOTON  NUESTRAS HISTORIAS -->
                <a href="/muestrashistorias"> 
                <button style="border-radius:16px; width:90%; margin-left:0px; margin-right:0px" type="button" class="btn btn-primary"><label style="font-size:15px"> HISTORIAS DE EXITO</label></button>   
                </a> 
            </div>
            <!-- FIN DE LOS BOTONES PARA IR AL QUIENES SOMOS NUESTRA VISIO  -->
        
        <!-- FIN DEL ROW -->
        </div>
        <div style="text-align:center; margin-top:25px" class="row justify-content-center">
              <label style="color:#941b94; font-size:19px"><b>INSTITUCIONES MIEMBROS</b></label>
        </div>

    </div>
    <!-- FIN DEL CONTAINER -->

   
</section>
<section style="margin-top:-45px" >
<div >
<style>
    .swiper-container1 {
      width: 100%;
      padding-top: 5px;
      padding-bottom: 5px;
    }

    .swiper-slide1 {
      background-position: center;
      background-size: cover;
      width: 300px;
      height: 150px;
    }
  </style>
    

      <div class="container-fluid">
        <div class="swiper-container swiper-container1">
              <div class="swiper-wrapper">
                  @foreach($nuestras as $nuestra)
                      <div class="swiper-slide swiper-slide1"><a onclick="window.open('{{ $nuestra->url }}', '_blank');"> <img  style=" width:270px; height:100px" src="{{ Storage::url('ImagenesUniversidades/'.$nuestra->imagen) }}" alt="" title=""></a></div>
                  @endforeach
              </div>
        <!-- Add Pagination -->
            
        </div>
      </div>


  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>

  <!-- Initialize Swiper -->
  <script>
     var swiper = new Swiper('.swiper-container', {
     
      loop: true,
      grabCursor: false,
      centeredSlides: true,
      slidesPerView: 'auto',
      speed: 1500,
      autoplay: {
        delay: 2000,
        speed: 1500,
        disableOnInteraction: true,
      },
      pagination: {
        el: '.swiper-pagination',
      },
    });
  </script>

</div>

   
    </section>
@include('includes.login-modal')
@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}" defer></script>
  @endsection
@endif