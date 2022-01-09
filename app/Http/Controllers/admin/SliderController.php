<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Storage;
use App\SliderImage;

class SliderController extends Controller
{
    
    public function index()
    {
        $miga='Slider';
        return view('admin.slider')->with(compact('miga'));
    }

  
    public function store(Request $request)
    {
        $path=$request->file('file')->store('public/imagenesSlider');
        $nombreImagen = collect(explode('/', $path))->last();
        $extensionImagen = collect(explode('.', $path))->last();
        $imagen = Image::make(Storage::get($path));
        //pilas quite la redireccion
        //$imagen->resize(1920,506);
        Storage::put($path,$imagen->encode($extensionImagen, 100));
        $imagen=new SliderImage();
        $imagen->nombre = $nombreImagen;
        // Agregamos el orden de la nueva imagen
        $posicionFinal=SliderImage::max('orden');
        if(is_null($posicionFinal))
        {
            $orden=1;
        }else{
            $orden=($posicionFinal)+1;
        }
        //
        $imagen->orden=$orden;
        $imagen->save(); 
    }

  

    public function destroy($id)
    {
        $imagen=SliderImage::findOrFail($id);
        Storage::disk('public')->delete('/imagenesSlider/'.$imagen->nombre);
        $imagen->delete();
    }

    public function imagenesMostrarAxios()
    {
        $imagenes=SliderImage::all();
        foreach($imagenes->sortBy('orden') as $imagen)
        {          
            echo    '<div style="cursor:move; border: solid 1.5px; border-radius: 6px; margin-top: 2px; padding: 2" class="col-xs-6 col-xs-offset-3 imagen" id="'.$imagen->orden.'">
                        <img style="border-radius: 5px;" class="mover" width="150px" src="'.Storage::url('imagenesSlider/'.$imagen->nombre).'">
                        <img style="cursor: pointer; float: right; margin: 2px 2px 0px 0px" width="20px" onclick="eliminarImagen('.$imagen->id.')" src="'.asset('imagenes/admin/eliminar.png').'">
                    </div>';
        }
    }

    public function imagenesOrdenarAxios($posicionInicial,$posicionFinal,$ultimo)
    {
        if($ultimo=="false")
        {
            // Con la posición inicial sabemos que imagen se ha movido, con la posición final donde se va a colocar.
            // La persona está cambiando las imágenes de arriba hacia abajo.
            if($posicionInicial < $posicionFinal)
            {
                $imagenMovida = SliderImage::where('orden',$posicionInicial)->first();
                $posicionFinalReal=$posicionFinal-1;
                
                $inicio=$posicionInicial+1;
                for($inicio; $inicio <= $posicionFinalReal; $inicio++)
                {
                    $imagen = SliderImage::where('orden',$inicio)->first();
                    if($imagen!=null)
                    {
                        $ordenInicial=$imagen->orden;
                        $ordenFinal=$ordenInicial - 1;
                        $imagen->orden=$ordenFinal;
                        $imagen->save();
                    }
                }

                $imagenMovida->orden=$posicionFinalReal;
                $imagenMovida->save();
            }

            // La persona está cambiando las imágenes de abajo hacia arriba.
            if($posicionInicial > $posicionFinal)
            {
                $imagenMovida = SliderImage::where('orden',$posicionInicial)->first();
                
                $inicio=$posicionInicial-1;
                for($inicio; $inicio >= $posicionFinal; $inicio--)
                {
                    $imagen = SliderImage::where('orden',$inicio)->first();
                    if($imagen!=null)
                    {
                        $ordenInicial=$imagen->orden;
                        $ordenFinal=$ordenInicial+1;
                        $imagen->orden=$ordenFinal;
                        $imagen->save();
                    }
                }

                $imagenMovida->orden=$posicionFinal;
                $imagenMovida->save();
            }
        }
        if($ultimo=="true")
        {
            // Con la posición inicial sabemos que imagen se ha movido, con la posición final donde se va a colocar.
            // La persona está cambiando las imágenes de arriba hacia abajo.
                $imagenMovida = SliderImage::where('orden',$posicionInicial)->first();
                $posicionFinalReal=SliderImage::max('orden');
                
                $inicio=$posicionInicial+1;
                for($inicio; $inicio <= $posicionFinalReal; $inicio++)
                {
                    $imagen = SliderImage::where('orden',$inicio)->first();
                    if($imagen!=null)
                    {
                        $ordenInicial=$imagen->orden;
                        $ordenFinal=$ordenInicial - 1;
                        $imagen->orden=$ordenFinal;
                        $imagen->save();
                    }
                }

                $imagenMovida->orden=$posicionFinalReal;
                $imagenMovida->save(); 
        }
    }

}
