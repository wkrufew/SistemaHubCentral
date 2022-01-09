<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miga='Usuarios';
       // $usuarios=User::with('roles')->whereNotNull('email_verified_at')->orderBy('id','desc')->paginate(10);
          $usuarios=User::with('roles')->whereNotNull('email_verified_at')->orderBy('id','desc')->paginate(10);
        return view("admin.usuarios.index")->with(compact('miga','usuarios'));
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
    public function edit(User $usuario)
    {
       
        $miga='Editar Usuario';
        return view('admin.usuarios.edit')->with(compact('usuario','miga'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $usuario)
    {
        $moderador=$request->moderador;
        if($moderador){
            $usuario->roles()->sync([1,2]);
        }
        
        else{
            $usuario->roles()->sync(1);
        }
        $usuario->bloqueado=$request->bloqueado;
        $usuario->save();
        $notificacion="El usuario se ha actualizado correctamente";
        return redirect('admin/usuarios')->with(compact('notificacion')); 
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
