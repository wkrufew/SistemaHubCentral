<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\User;


class UserController extends Controller
{
    public function _construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request)
    {
        $usuario=auth()->user();

        $messages=[
            'nombre.required' => 'Campo nombre requerido',
            'nombre.max' => 'Campo nombre demasiado largo',
            'nombre.string' => 'Campo de caracteres no de numeros',

            'alias.required' => 'Campo alias requerido',
            'alias.min' => 'Campo alias demasiado corto',
            'alias.max' => 'Campo alias demasiado largo',
            'alias.unique' => 'Campo alias ya existe en nuestros registros',

            'web.max' => 'Campo web demasiado largo',

            'password.required' => 'Campo password requerido',  
            'password.regex' => 'La contraseña debe tener minimo 8 caracteres, contener al menos una mayuscula, minuscula y un numero o caracter especial'
        ];

        $rules=[
            'nombre' => array('required','string','max:50'),
          //  'alias' => array('required', 'string', 'min:3', 'max:15', 'unique:users'),
          'alias' => array('required', 'string', 'min:3', 'max:15', Rule::unique('users')->ignore($usuario->id) ),
            'web' => 'max:30',


            'password' => array('required', 'string', 'regex:/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/')
        ];

        $this->validate($request, $rules, $messages);

       
        //return dd($usuario); //es para poder ver que me trae el objeto en pantalla
        $usuario->name=$request->nombre;
        $usuario->alias=$request->alias;
        $usuario->web=$request->web;
        $usuario->password=bcrypt($request->password);
        $usuario->update();
        $notificacion="Los datos de $request->nombre fueron actualizados correctamente";
        return back()->with(compact('notificacion')); //retrocede a la pagina anterior
        //return redirect('/'); //redirige al index
    }
}
