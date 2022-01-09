@extends('layouts.app')

@section('content')
<div class="container">
    <div style=" margin-top: 120px; margin-bottom:100px" class="row justify-content-center">
        <div class="col-md-8">
            <form method="POST" action="{{ url('/usuario-actualizar') }}">
                @csrf
                {{ method_field('PUT') }}
                @if($errors->any())
                    <div  style="background:#F96666; color:white;" class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach
                        </ul>
                    </div>    
                @endif
                @if(session('notificacion'))   
                    <div class="alert alert-success" role="alert">
                      {{session('notificacion')}}
                    </div>
                @endif
                <div class="form-group">
                    <label for="exampleInputNombrel1">Nombres</label>
                    <input type="text" class="form-control" name="nombre" value="{{ old('nombre') ?? auth()->user()->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputAlias1">Alias</label>
                    <input type="text" class="form-control" name="alias"  value="{{ old('alias') ?? auth()->user()->alias }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputWeb1">Web</label>
                    <input type="text" class="form-control" name="web" value="{{ old('web') ?? auth()->user()->web }}" placeholder="">
                </div>
            <!-- <div class="form-group">
                    <label for="exampleInputWeb1">Video</label>

                    <a class="iframe" data-fancybox="gallery" id="open_video" href="{{auth()->user()->web }}">
                        Mira el video papi
                    </a>
                </div>-->
                <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" name="password"  placeholder="Ingresa tu vieja contraseña o ingresa una nueva">
                </div>
                
                <button type="submit" class="btn btn-primary">Guardar cambios</button>
            </form>
        </div>
    </div>
</div>
@endsection




