@extends('layouts.app')



@section('content')


<section class="engine"><a href=""></a>

</section>




<section class="carousel slide testimonials-slider cid-rPhEktC2uU" data-interval="false" id="testimonials-slider1-4">
    
    <div class="mbr-overlay" style="opacity: 0.9; background-color: rgb(255, 255, 255);">
    </div>
    <div class="container">

        <div style=" margin-top:100px;" class="row">
        <div style="color: #941b94; font-size:25px; text-align:center" class="col-xs-12 col-sm-4"><label style="color: #941b94; font-size:25px; text-align:right"><b>Quienes Somos</b></label>
                        </div>
        <div style="color: #941b94; font-size:25px; text-align:center" class="col-xs-12 col-sm-6 "> 
            <iframe class="col-xs-12 col-sm-12" height="315" src="https://www.youtube.com/embed/wlykHD0-_qk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
        </div>
        <div class="col-xs-12 col-sm-2"></div>
        </div>

        <div class="row">
        <div class="col-xs-12 col-sm-4"></div>
        <div class="col-xs-12 col-sm-6 container"> 
            <p style="text-align:justify; margin: 10px">Trabajamos colaborativamente para incrementar la productividad y diversificacion 
                de la economia del centro del pais, atraves de la generacion del emprendimiento basados en los resultados 
                del I+D creados en el IES y en articulacion con el sector Productivo
            </p></div>
        <div class="col-xs-12 col-sm-2"></div>
        </div>

    </div>
    <div class="container text-center" style=" margin-top:50px;">
        <h2 style="color: #941b94; font-size:25px;" class="pb-5 mbr-fonts-style display-2"><b>GRUPO DE INNOVACIÓN HUB CENTRO </b></h2>

        <div class="carousel slide" role="listbox" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="4000">
            <div class="carousel-inner">
            @foreach($somos as $somo)     
           <div class="carousel-item">
           
                    <div class="user col-md-8">
                        <div class="user_image">
                            <img src="{{ Storage::url('ImagenesGrupo/'.$somo->imagen) }}">
                        </div>
                        <div class="user_text pb-3">
                            <p style="color: #941b94; font-size:16px;" class="mbr-fonts-style display-7">
                               {{ $somo->descripcion }} </p>
                        </div>
                        <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                        {{ $somo->nombre }} 
                        </div>
                        <div class="user_desk mbr-light mbr-fonts-style display-7">
                        {{ $somo->cargo }} 
                        </div>
                    </div>
                   
            
            </div>
                    @endforeach
                    
            <div class="carousel-controls">
                <a class="carousel-control-prev" role="button" data-slide="prev">
                  <span aria-hidden="true" class="mbri-arrow-prev mbr-iconfont"></span>
                  <span class="sr-only">Previous</span>
                </a>
                
                <a class="carousel-control-next" role="button" data-slide="next">
                  <span aria-hidden="true" class="mbri-arrow-next mbr-iconfont"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>

</section>

@include('includes.login-modal')
@endsection

@if($errors->any())
  @section('include-login-modal')
  <script src="{{ asset('js/login-modal.js') }}" defer></script>
  @endsection
@endif