@extends('layouts.app')



@section('content')


<section class="engine"><a href=""></a>

</section>



<section class="features3 cid-rPhPXVhNu6" style="text-align:center; margin-bottom:150px" id="features3-8">
<style>
    
   

    .swiper-container {
      width: 300px;
      height: 300px;
      position: relative;
      left: 50%;
      top: 50%;
      margin-left: -150px;
      margin-top: -150px;
    }

    .swiper-slide {
      background-position: center;
      background-size: cover;
    }
  </style>
    <div class="container">
        <div style="text-align:center; margin-top:150px" class="row justify-content-center">
        <!-- INICIO DEL PRIMER ROW BOTONES -->
           YA CASI SALE HISTORIAS
        
        <!-- FIN DEL ROW -->
        </div>

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

  <!-- Swiper JS -->
  <script src="https://unpkg.com/swiper/js/swiper.min.js"></script>

  <!-- Initialize Swiper -->
  <script>
    var swiper = new Swiper('.swiper-container', {
      effect: 'cube',
      //loop: true,
      slidesPerView: 4,
      spaceBetween: 46,
      speed: 1000,
      grabCursor: true,
      autoplay: {
        delay: 2000,
        speed: 1000,
        disableOnInteraction: true,
      },
      cubeEffect: {
        shadow: true,
        slideShadows: true,
        shadowOffset: 20,
        shadowScale: 0.94,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
    });
  </script>
</div>

    </div>
    <!-- FIN DEL CONTAINER -->
   
</section>

@include('includes.login-modal')
@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}" defer></script>
  @endsection
@endif