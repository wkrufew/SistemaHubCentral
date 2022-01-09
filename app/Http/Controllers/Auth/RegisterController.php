<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    protected function registered(Request $request, $user)
    {
        $user->roles()->sync(1);
        return redirect($this->redirectPath()); 
    }
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function comprobarAlias($alias = null)
    {
        $alias=User::where('alias',$alias)->first();
        if($alias)
            return json_encode(true);
        return json_encode(false);
    }
    protected function validator(array $data)
    {
        $mensaje = array(
            'name.required' => 'Campo nombre requerido',
            'name.max' => 'Campo nombre demasiado largo',

            'email.required' => 'Campo email requerido',
            'email.max' => 'Campo email demasiado largo',
            'email.unique' => 'Campo email ya existe en nuestros registros',
            'email.email' => 'Campo email debe ser un email valido',

            'alias.required' => 'Campo alias requerido',
            'alias.min' => 'Campo alias demasiado corto',
            'alias.max' => 'Campo alias demasiado largo',
            'alias.unique' => 'Campo alias ya existe en nuestros registros',

            'web.max' => 'Campo web demasiado largo',

            'password.required' => 'Campo password requerido',
            'password.confirmed' => 'Los campos password no coinciden',
            'password.regex' => 'La contraseña debe tener minimo 8, contener al menos una mayuscula, minuscula y un numero o caracter especial',
        );

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],

            'alias' => ['required', 'string', 'min:3', 'max:20', 'unique:users'],
            'web' => ['max:50'],

            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password' => ['required', 'string', 'confirmed','regex:/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/'],
        ], $mensaje);
    }
  //  /(?=)
   // ^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'alias' => $data['alias'],
            'web' => $data['web'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
