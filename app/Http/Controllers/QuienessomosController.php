<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GrupoHubcentro;

class QuienessomosController extends Controller
{
      public function quienessomos()
      {
            $somos = GrupoHubcentro::all();
            return view('quienessomos')->with(compact('somos'));
      }

      public function muestrashistorias()
      {
            $nuestras = GrupoHubcentro::all();
            return view('muestrashistorias')->with(compact('nuestras'));
      }
}
