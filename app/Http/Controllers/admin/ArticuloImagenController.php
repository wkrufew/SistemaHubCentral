<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ArticuloImagen;
use Illuminate\Support\Facades\Storage;

class ArticuloImagenController extends Controller
{
    public function destroy(ArticuloImagen $imagen)
    {
        //return dd($imagen);
        Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
        $imagen->forceDelete();

        //$notificacion="Imágen eliminada correctamente correctamente";
        //return back()->with(compact('notificacion'));
    }
}
