<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Universidad;

class UniversidadController extends Controller
{
    public function index()
    { 
        $miga='Logos de las Instituciones';
        $universidades=Universidad::all();
        return view('admin.universidades.index')->with(compact('miga','universidades'));
    }

    public function create()
    {
        $miga='Añadir Integrante';
        return view('admin.universidades.create')->with(compact('miga'));
    }


  
    public function store(Request $request)
    {
        $messages=[
            'url.required'=>'El campo url no puede quedar vacio',
            'foto.required'=>'La imagen es requerida',
            'foto.mimes'=>'No es una imagen',
            'foto.max'=>'Archivo demasiado grande',
        ];

        $rules=[
            'url'=> array('required'),
            'foto' => array('mimes:jpeg,png','max:10240','required'),
        ];

        $this->validate($request, $rules, $messages);

        $universidad=new Universidad($request->only('url'));

        $path=$request->file('foto')->store('public/ImagenesUniversidades');
        $nombreImagen = collect(explode('/', $path))->last();
        $extensionImagen = collect(explode('.', $path))->last();
        $imagen = Image::make(Storage::get($path));
        Storage::put($path,$imagen->encode($extensionImagen, 100));

        $universidad->imagen=$nombreImagen;

        $universidad->save();

        $notificacion="El logo se ha añadido correctamente";
        return redirect('admin/universidades')->with(compact('notificacion'));
    }

    public function edit($id)
    {
        $universidad=Universidad::findOrFail($id);
        $miga='Editar datos del logo';
        return view('admin.universidades.edit')->with(compact('universidad','miga'));
    }

    public function update(Request $request, $id)
    {
        $universidad=Universidad::findOrFail($id);
        $messages=[
            'url.required'=>'El campo url no puede quedar vacio',
            'foto.mimes'=>'No es una imagen',
            'foto.max'=>'Archivo demasiado grande',
        ];

        $rules=[
            'url'=> array('required'),
            'foto' => array('mimes:jpeg,png','max:10240'),
        ];

        $this->validate($request, $rules, $messages);

        if($request->hasFile('foto'))
        {
            $path=$request->file('foto')->store('public/ImagenesUniversidades');
            $nombreImagen = collect(explode('/', $path))->last();
            $extensionImagen = collect(explode('.', $path))->last();
            $imagen = Image::make(Storage::get($path));
           // $imagen->resize(250,800);
            Storage::put($path,$imagen->encode($extensionImagen,100));
            $universidad->imagen=$nombreImagen;
        }
 
        $universidad->update($request->only('url','imagen'));

        // Guardar la imgagen en nuestro proyecto

        $miga='Datos de la Institucion';
        $notificacion="Los dato se han actualizado correctamente";
        return redirect('admin/universidades')->with(compact('notificacion','miga'));
    }

    public function destroy($id)
    {
        $imagen=Universidad::findOrFail($id);
        Storage::disk('public')->delete('/ImagenesUniversidades/'.$imagen->imagen);
        $imagen->delete();
    }
}
