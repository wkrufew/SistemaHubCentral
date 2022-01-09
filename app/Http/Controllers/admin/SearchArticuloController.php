<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articulo;
use App\Tema;
use App\User;

class SearchArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $miga='Buscador Artículos';
    	$busqueda=$request->busqueda;
    	$tema=Tema::where('nombre','like',"$busqueda")->first();
        $usuario=User::where('name','like',"$busqueda")->first();
        if($usuario)
        {
        	foreach($usuario->roles as $role)
            {
                if($role->nombre=="administrador" || $role->nombre=="moderador") 
                {
                    // preguntamos si el usuario tiene articulos. $provincias = Provincia::has('anexos')->get();
	        		$articulos=$usuario->articulos()->withoutGlobalScope('activo')->with(['user','tema'])->orderBy('id','desc')->get();
	                return view('admin.articulos.buscador')->with(compact('miga','articulos'));
                }
            }
        }
    	
    	if($tema)
    	{

    		$articulos=$tema->articulos()->withoutGlobalScope('activo')->with(['user','tema'])->orderBy('id','desc')->get();
			return view('admin.articulos.buscador')->with(compact('miga','articulos'));
    	}

    	$articulos=Articulo::withoutGlobalScope('activo')->with(['user','tema'])->where('titulo','like',"%$busqueda%")->orderBy('id','desc')->get();
    	return view('admin.articulos.buscador')->with(compact('miga','articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
