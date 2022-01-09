<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class SearchUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $miga='Buscador de Usuarios';
    	$busqueda=$request->busqueda;
    	$usuariosBD=User::with('roles')->get();
    	if($busqueda=="moderadores")
    	{
	    	$usuarios=collect();
	    	foreach($usuariosBD as $usuario)
	    	{
	    		if($usuario->hasRole('moderador'))
	    			$usuarios->push($usuario);
	    	}
	    	return view('admin.usuarios.buscador')->with(compact('miga','usuarios'));
    	}

    	$usuarios=User::where('alias','like',"%$busqueda%")->orWhere('email','like',"%$busqueda%")->orWhere('name','like',"%$busqueda%")->get();
    	return view('admin.usuarios.buscador')->with(compact('miga','usuarios'));
    
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
