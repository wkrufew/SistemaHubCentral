<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage; 
use App\Articulo;
use App\ArticuloImagen;


class ArticuloDeleteController extends Controller
{
    public function index()
    {
        $miga='Artículos Borrados';
        $articulos=Articulo::withoutGlobalScope('activo')->onlyTrashed()->with(['user','tema'])->orderBy('id','desc')->get();
        $imagenes=ArticuloImagen::onlyTrashed()->get();
        return view('admin.articulosBorrados.index')->with(compact('miga','articulos','imagenes'));
    }  

    public function show($id)
    {
        $articulo=Articulo::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);
        $imagenes=ArticuloImagen::where('articulo_id',$id)->onlyTrashed()->get();
        $miga='Mostrar Artículo';
        return view('admin.articulosBorrados.show')->with(compact('miga','articulo','imagenes'));
    }

    public function restaurar($id)
    {
        $articulo=Articulo::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);
        $articulo->restore();
        $notificacion="El articulo se ha restaurado";
        return back()->with(compact('notificacion'));
    }

   	public function destroy($id)
    {
        $articulo=Articulo::withoutGlobalScope('activo')->onlyTrashed()->findOrFail($id);
        $imagenes=ArticuloImagen::where('articulo_id',$id)->onlyTrashed()->get();
        foreach($imagenes as $imagen)
        {
            // lo borramos físicamente
            Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
        }
        $articulo->forceDelete();
        $notificacion2="El articulo se ha eliminado";
        return back()->with(compact('notificacion2'));
    }
}
