<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\GrupoHubcentro;


class GrupoHubcentroController extends Controller
{
    public function index()
    { 
        $miga='Integrantes del Grupo';
        $grupos=GrupoHubcentro::all();
        return view('admin.grupos.index')->with(compact('miga','grupos'));
    }

    public function create()
    {
        $miga='Añadir Integrante';
        return view('admin.grupos.create')->with(compact('miga'));
    }


  
    public function store(Request $request)
    {
        $messages=[
            'nombre.required'=>'El campo Nombre no puede quedar vacio',
            'cargo.required'=>'El campo cargo no puede quedar vacio',
            'descripcion.required'=>'El campo descripcion no puede quedar vacio',
            'foto.required'=>'La imagen es requerida',
            'foto.mimes'=>'No es una imagen',
            'foto.max'=>'Archivo demasiado grande',
        ];

        $rules=[
            'nombre'=> array('required'),
            'cargo'=>array('required'),
            'descripcion'=>array('required'),
            'foto' => array('mimes:jpeg,png','max:10240','required'),
        ];

        $this->validate($request, $rules, $messages);

       

        $grupo=new GrupoHubcentro($request->only('nombre','cargo','descripcion'));
        /*$grupo->titulo=$request->titulo;
        $grupo->contenido=$request->contenido;
        $grupo->activo=$request->activar;*/
        $path=$request->file('foto')->store('public/ImagenesGrupo');
        $nombreImagen = collect(explode('/', $path))->last();
        $extensionImagen = collect(explode('.', $path))->last();
        $imagen = Image::make(Storage::get($path));
        $imagen->resize(250,250);
        Storage::put($path,$imagen->encode($extensionImagen, 80));
        $grupo->imagen=$nombreImagen;

        $grupo->save();

        $notificacion="El integrante se ha añadido correctamente";
        return redirect('admin/grupos')->with(compact('notificacion'));
    }

    public function edit($id)
    {
        $grupo=GrupoHubcentro::findOrFail($id);
        $miga='Editar datos del Integrante';
        return view('admin.grupos.edit')->with(compact('grupo','miga'));
    }

    public function update(Request $request, $id)
    {
        $grupo=GrupoHubcentro::findOrFail($id);
        $messages=[
            'nombre.required'=>'El campo Nombre no puede quedar vacio',
            'cargo.required'=>'El campo Cargo no puede quedar vacio',
            'descripcion.required'=>'El campo Descripcion no puede quedar vacio',
            'foto.mimes'=>'No es una imagen',
            'foto.max'=>'Archivo demasiado grande',
        ];

        $rules=[
            'nombre'=> array('required'),
            'cargo'=>array('required'),
            'descripcion'=>array('required'),
            'foto' => array('mimes:jpeg,png','max:10240'),
        ];

        $this->validate($request, $rules, $messages);

        if($request->hasFile('foto'))
        {
            $path=$request->file('foto')->store('public/ImagenesGrupo');
            $nombreImagen = collect(explode('/', $path))->last();
            $extensionImagen = collect(explode('.', $path))->last();
            $imagen = Image::make(Storage::get($path));
           // $imagen->resize(250,800);
            Storage::put($path,$imagen->encode($extensionImagen,100));
            $grupo->imagen=$nombreImagen;
        }
      
        
        

       
        $grupo->update($request->only('nombre','cargo','descripcion','imagen'));
       

        // Guardar la imgagen en nuestro proyecto

        
        
        $miga='Integrantes del Grupo';
        $notificacion="Los datos del integrante se han actualizado correctamente";
        return redirect('admin/grupos')->with(compact('notificacion','miga'));
    }


    public function destroy($id)
    {
        $imagen=GrupoHubcentro::findOrFail($id);
        Storage::disk('public')->delete('/ImagenesGrupo/'.$imagen->imagen);
        $imagen->delete();
    }

}
