@extends('layouts.app')

@section('content')
<div class="fluid">

<div class="container" >
    <div style=" margin-top: 120px; margin-bottom:100px" class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-bordered" >
                <div style=" background:#D29FD2; color:white; text-align: center; font-size: x-large" class="card-header">{{ __('Registro') }}</div>

                    @if($errors->any())
                        <div style=" background:#DA5054; color:white;" class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" autocomplete="off" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                      
                                        $foreach ($errors->get('name') as $errors)
                                            <li> {{$errors}}</li>
                                        $endforeach
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" autocomplete="off" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="alias" class="col-md-4 col-form-label text-md-right">{{ __('Alias') }}</label>

                            <div class="col-md-6">
                                <script src="{{ asset('assets/web/assets/jquery/jquery.min.js') }}"></script>
                                <input id="alias" type="text" class="form-control{{ $errors->has('alias') ? ' is-invalid' : '' }}" autocomplete="off" name="alias" value="{{ old('alias') }}" placeholder="Min 3 y Max 20 caracteres" required autofocus>
                                
                                <div id="alias-alert" style="margin-top:15px; margin-bottom:0px; display:none;  background-color:#E8806A" class="alert alert-danger" role="alert">
                                    Este Alias ya existe, introduce uno nuevo.
                                </div>
                                 

                                    @if ($errors->has('alias'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alias') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="web" class="col-md-4 col-form-label text-md-right">{{ __('Sitio Web') }}</label>

                            <div class="col-md-6">
                                <input id="web" autocomplete="off" type="email" class="form-control{{ $errors->has('web') ? ' is-invalid' : '' }}" name="web" value="{{ old('web') }}">
                                    
                                @if ($errors->has('web'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('web') }}</strong>
                                    </span> 
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                <div id="password-alert" style="margin-top: 15px; margin-bottom: 0px; display:none; background-color:#54B7DA" class="mt-2 alert alert-info" role="alert">
                                    La contraseña debe tener una mayuscula, una minúscula, un número y una longitud mínima de 8 caracteres.<strong>Puede cerrar este mensaje cuando quiera.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                <div id="password-confirm-alert" style="margin-top: 15px; margin-bottom: 0px;display: none; background-color:#E8806A" class="alert alert-danger" role="alert">
                                    No se preocupe, este mensaje desaparecerá cuando las contraseñas coincidan.
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button style=" color:white;" type="submit" class="btn btn-primary">
                                    {{ __('Registrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    var coincidenciaAlias= false;
    var alias;
    var password1;
    var password2;
    $(document).ready(function(){
        $('#alias').keyup(function(){
            alias=$(this).val();
            var urlComprobarAlias = '/comprobar-alias-js/' + alias;
            axios.get(urlComprobarAlias)
            .then(response => {
                coincidenciaAlias = response.data;
                if(coincidenciaAlias){
                    $('#alias-alert').show('slow');
                } else {
                    $('#alias-alert').hide('slow');
                }
            })
            .catch(e => {
                // Podemos mostrar los errores en la consola
                console.log(e);
            })
        });

        $('#password').click(function(){
            $('#password-alert').show('slow');
        });

        $('#password-confirm').click(function(){
            password1=$('#password').val();
        });

        $('#password-confirm').keyup(function(){
            password2=$('#password-confirm').val();
            if(password1!=password2){
                $('#password-confirm-alert').show('slow');
            }else{
                $('#password-confirm-alert').hide('slow');
            }
        });
    });
</script>

@endsection
