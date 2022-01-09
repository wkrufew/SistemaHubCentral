<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        //$busqueda = $request->busqueda;
        //return dd($busqueda);
        //$articulos=Articulo::where('titulo','like',"%$busqueda%")->with(['imagenes'])->orderBy('id','desc')->get();
        //return view('buscador')->with(compact('articulos'));


        $articulosPermitidos=collect();
        $busqueda=$request->busqueda;
        if(auth()->check())
        { 
            if(!is_null(auth()->user()->email_verified_at))
            { 
                    if(!auth()->user()->bloqueado)
                    {
                        $articulos=Articulo::where('titulo','like',"%$busqueda%")->with(['imagenes'])->orderBy('id','desc')->get();
                        return view('buscador')->with(compact('articulos'));
                    }
                
                    $articulos=Articulo::where('titulo','like',"%$busqueda%")->with(['imagenes'])->orderBy('id','desc')->get();
                    foreach($articulos as $articulo)
                    {
                        if(!$articulo->tema->suscripcion)
                            $articulosPermitidos->push($articulo);    		
                    }
                    return view('buscador')->with(compact('articulosPermitidos'));
            }
            $articulos=Articulo::where('titulo','like',"%$busqueda%")->with(['imagenes'])->orderBy('id','desc')->get();
            foreach($articulos as $articulo)
            {
                if(!$articulo->tema->suscripcion)
                    $articulosPermitidos->push($articulo);    		
            }
            return view('buscador')->with(compact('articulosPermitidos'));
    	}

        $articulos=Articulo::where('titulo','like',"%$busqueda%")->with(['imagenes'])->orderBy('id','desc')->get();
    	foreach($articulos as $articulo)
    	{
    		if(!$articulo->tema->suscripcion)
    			$articulosPermitidos->push($articulo);    		
    	}
    	return view('buscador')->with(compact('articulosPermitidos'));

    }

    public function buscadorPredictivo()
    {   
        $articulos=Articulo::pluck('titulo');
        return $articulos;
    }
}
