<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tema;
use App\Articulo;
use App\GrupoHubcentro;

class TemaController extends Controller
{
    
    public function show(Tema $tema)
    {

        $usuarioAutenticado=true;
        $usuarioBloqueado=false;
        $usuarioVerificado=true;

        if($tema->suscripcion)
        {
            if(auth()->check())
            {
                if(!is_null(auth()->user()->email_verified_at))
                {
                    if(auth()->user()->bloqueado)
                    {
                        $usuarioBloqueado=true;
                        return view('tema.articulos')->with(compact('tema','usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));
                    }
                    $nuestras = GrupoHubcentro::all();
                    $articulos=$tema->articulos()->with(['imagenes'])->orderBy('id','desc')->paginate(9);
                    return view('tema.articulos')->with(compact('tema', 'articulos', 'usuarioAutenticado','usuarioBloqueado','usuarioVerificado','nuestras'));  
               }
                $usuarioVerificado=false;
                return view('tema.articulos')->with(compact('tema', 'usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));         
            }
            $usuarioAutenticado=false;
            return view('tema.articulos')->with(compact('tema','usuarioAutenticado','usuarioBloqueado','usuarioVerificado'));
        }
        $nuestras = GrupoHubcentro::all();
        $articulos=$tema->articulos()->with(['imagenes'])->orderBy('id','desc')->paginate(9);
        return view('tema.articulos')->with(compact('tema', 'articulos', 'usuarioAutenticado','usuarioBloqueado','usuarioVerificado','nuestras'));  
    }

    public function toggleLike($id) 
    {
      
        $articulo = Articulo::findOrFail($id);
        
        $articulo->toggleLikeBy();

        if($articulo->liked){
            return response()->json([
                'like' => [
                    'isLiked' => true,
                    'likes' => $articulo->likesCount
                ]
            ]);
        }else{
            return response()->json([
                'like' => [
                    'isLiked' => false,
                    'likes' => $articulo->likesCount
                ]
            ]);
        }
    }

}
