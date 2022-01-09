<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Commentary;
use App\Articulo;
use Illuminate\Support\Facades\Gate;

class CommentaryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified'], ['except' => 'comentariosMostrarAxios']);
    }

    public function storeAxios(Request $request)
    {
        $rules=[
            'texto'=> array('required','max:1000'),
        ];

        $this->validate($request, $rules);

        //sleep(1);

        $comentario=new Commentary();
        $comentario->comentario=$request->texto;
        $comentario->articulo_id=$request->articulo_id;
        $comentario->user_id=auth()->user()->id;
        $comentario->save();
    }

    public function destroyAxios($id_comentario)
    {
        $comentario=Commentary::findOrFail($id_comentario);
        if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('moderador')) // Administrador o Moderador pueden borrar todos los comentarios
        {
            $comentario->forceDelete();
        }else{
            if (Gate::allows('comentario-borrar', $comentario)) { // Si el comentario pertenece al usuario puede borrarse
    		    $comentario->forceDelete();
    		}
        }
    }

    public function comentariosMostrarAxios($articulo_id)
    {
        $articulo=Articulo::findOrFail($articulo_id);
        foreach($articulo->commentaries->sortByDesc('id') as $comentario)
        {
            echo '<div style="padding: 0px; padding-right: 20px;"  id="'.$comentario->id.'" class="container">';
                if(auth()->user())
                {
                    if(auth()->user()->hasRole('administrador') || auth()->user()->hasRole('moderador') || auth()->user()->id==$comentario->user_id)
                    {
                        echo '<a href="#" onclick="eliminarComentario('.$comentario->id.')"><img style="float:right;" width="10px; padding:5px" src="'.asset('imagenes/admin/eliminar.png').'"></a>';
                    }
                }
                
                echo '<p style="color:#941b94; FONT-SIZE: 12px; padding: 0px; margin-right:10px;margin-left:10px"><i>Escrito por : <strong>'.$comentario->user->alias.' | '.$comentario->created_at->diffForHumans().'</strong></i></p>';
                echo '<p style="FONT-SIZE: 12px; padding: 0px; margin-right:10px;margin-left:10px">'.$comentario->comentario.'</p>';
                
                    echo '<hr style="padding: 0px; margin:5px; display:@if ($loop->last) none @endif">';
                
              
            echo '</div>';
        }
    }
}
