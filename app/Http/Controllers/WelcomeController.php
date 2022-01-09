<?php

namespace App\Http\Controllers;
use App\Tema;
use App\Universidad;
use App\SliderImage;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function welcome(){

        //$temasTodos = Tema::all();
        //$temasDestacados=Tema::where('destacado',1)->with(['articulos.imagenes'])->orderby('id','desc')->paginate(10);
        $nuestras = Universidad::all();
        $imagenes=SliderImage::all();
        return view('welcome')->with(compact('imagenes','nuestras'));
       
    }

}
