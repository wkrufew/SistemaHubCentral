<?php

namespace App\Http\Controllers\moderador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Articulo;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use App\ArticuloImagen;
use Illuminate\Validation\Rule;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $miga='Artículos';
        $usuario=auth()->user();
        $todosArticulos=$usuario->articulos()->withoutGlobalScope('activo')->count();
        $articulos=$usuario->articulos()->withoutGlobalScope('activo')->with(['user','tema'])->orderBy('id','desc')->paginate(10);
        return view('moderador.articulos.index')->with(compact('miga','articulos','todosArticulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $miga='Añadir Articulo';
        return view('moderador.articulos.create')->with(compact('miga'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages=[
            'titulo.required'=>'El campo Título no puede quedar vacio',
            'titulo.unique'=>'El Título de este articulo ya existe',
            'contenido.required'=>'El campo Contenido no puede quedar vacio',
            'foto0.mimes'=>'No es una imagen',
            'foto0.max'=>'Archivo demasiado grande',
            'foto1.mimes'=>'No es una imagen',
            'foto1.max'=>'Archivo demasiado grande',
            'foto2.mimes'=>'No es una imagen',
            'foto2.max'=>'Archivo demasiado grande'
        ];

        $rules=[
            'titulo'=> array('required', 'unique:articulos'),
            'contenido'=> array('required'),
            'foto0' => array('mimes:jpeg,png','max:10240'),
            'foto1' => array('mimes:jpeg,png','max:10240'),
            'foto2' => array('mimes:jpeg,png','max:10240')
        ];

        $this->validate($request, $rules, $messages);

        $articulo=new Articulo();
        $articulo->titulo=$request->titulo;
        $articulo->tema_id=$request->tema_id;
        $articulo->contenido=$request->contenido;
        $articulo->user_id=auth()->user()->id;
        $articulo->save();
        
        // Guardar la imgagen en nuestro proyecto

        for($i=0;$i<3;$i++)
        {
            if($request->hasFile('foto'.$i))
            {
               $path=$request->file('foto'.$i)->store('public/imagenesArticulos');
               $nombreImagen = collect(explode('/', $path))->last();
               $extensionImagen = collect(explode('.', $path))->last();
               $imagen = Image::make(Storage::get($path));
              // $imagen->resize(250,250);
               Storage::put($path,$imagen->encode($extensionImagen, 80));
               $imagen=new ArticuloImagen();
               $imagen->nombre = $nombreImagen;
               $imagen->articulo_id = $articulo->id;
               $imagen->save(); 
            }
        }
        

        $articuloTitulo = $articulo->titulo;
        $notificacion="El artículo $articuloTitulo se ha añadido correctamente";
        return redirect('moderador/articulos')->with(compact('notificacion'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $articulo=Articulo::withoutGlobalScope('activo')->findOrFail($id);
        $this->authorize('view', $articulo);
        $miga='Mostrar Artículo';
        return view('moderador.articulos.index')->with(compact('miga','articulo'));

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo=Articulo::withoutGlobalScope('activo')->findOrFail($id);
        $this->authorize('edit', $articulo);
        $miga='Editar Artículo';
        return view('moderador.articulos.edit')->with(compact('articulo','miga'));
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
        $articulo=Articulo::withoutGlobalScope('activo')->findOrFail($id);
        $this->authorize('update', $articulo);
        $messages=[
            'titulo.required'=>'El campo Título no puede quedar vacio',
            'titulo.unique'=>'El Título de este articulo ya existe',
            'contenido.required'=>'El campo Contenido no puede quedar vacio',
            'foto1.mimes'=>'No es una imagen',
            'foto1.max'=>'Archivo demasiado grande',
            'foto2.mimes'=>'No es una imagen',
            'foto2.max'=>'Archivo demasiado grande',
            'foto3.mimes'=>'No es una imagen',
            'foto3.max'=>'Archivo demasiado grande'
        ];

        $rules=[
            'titulo' => array('required',Rule::unique('articulos')->ignore($articulo->id)),
            'contenido'=>array('required'),
            'foto1' => array('mimes:jpeg,png','max:10240'),
            'foto2' => array('mimes:jpeg,png','max:10240'),
            'foto3' => array('mimes:jpeg,png','max:10240')
        ];

        $this->validate($request, $rules, $messages);

        $articulo->titulo=$request->titulo;
        $articulo->tema_id=$request->tema_id;
        $articulo->contenido=$request->contenido;
        $articulo->save();
        
        // Guardar la imgagen en nuestro proyecto

        for($i=1;$i<4;$i++)
        {
            if($request->hasFile('foto'.$i))
            {
               $path=$request->file('foto'.$i)->store('public/imagenesArticulos');
               $nombreImagen = collect(explode('/', $path))->last();
               $extensionImagen = collect(explode('.', $path))->last();
               $imagen = Image::make(Storage::get($path));
                //$imagen->resize(250,250);
               Storage::put($path,$imagen->encode($extensionImagen, 80));
               $imagen=new ArticuloImagen();
               $imagen->nombre = $nombreImagen;
               $imagen->articulo_id = $articulo->id;
               $imagen->save(); 
            }
        }
        
        $miga='Artículos';
        $notificacion="El artículo se ha actualizado correctamente";
        return redirect('moderador/articulos')->with(compact('notificacion','miga'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $articulo=Articulo::withoutGlobalScope('activo')->findOrFail($id);
        $this->authorize('delete', $articulo);
        /*foreach($articulo->imagenes as $imagen)
        {
            // lo borramos físicamente
            Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
        }*/ 
        $articulo->delete();

        $notificacion2="El articulo se ha eliminado";
        return back()->with(compact('notificacion2'));

/*

        $articulo=Articulo::withoutGlobalScope('activo')->findOrFail($id);
        foreach($articulo->imagenes as $imagen)
        {
            // lo borramos físicamente
            Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
        }
        $articulo->forceDelete();

        $notificacion2="El articulo se ha eliminado";
        return back()->with(compact('notificacion2'));*/
    }
}
