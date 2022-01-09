<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Articulo;
use App\Tema;
use App\Universidad;
use App\GrupoHubcentro;
use App\User;
use App\Commentary;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Charts;

class MasVistoController extends Controller
{
    public function index()
    { 
        $miga='Publicaciones mas vistas';

        /*GRAFICO*/
        $comentario = Commentary::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $likes = DB::table('love_like_counters')->where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();
        $chart = Charts::multiDatabase('line', 'highcharts')
			      ->title("Actividad de Usuarios")
                  ->elementLabel("Total de Publicaciones")
                  ->colors(['#941b94', '#2EFE2E', '#FF0000'])
                  ->responsive(true)
                  ->dataset('Comentarios', $comentario)
                  ->dataset('Publicaciones con reacciones', $likes)
                  ->groupByMonth(date('Y'), true);
        /*FIN DEL GRAFICO */

        $articulo = Articulo::count();
        $universidad = Universidad::count();
        $grupo = GrupoHubcentro::count();
        $usuario = User::count();
        $comentario = Commentary::count();
        $suma = DB::table('love_like_counters')->sum('count');
        $articulos=Articulo::join('love_like_counters', 'love_like_counters.likeable_id', '=' , 'articulos.id')->with(['user','tema'])
        ->select('articulos.titulo', 'articulos.tema_id', 'articulos.user_id' , 'love_like_counters.count', 'love_like_counters.created_at')
        ->where('love_like_counters.count', ">", '0')->orderBy('count','desc')->paginate(10);
        return view('admin.articulosvistos.index')->with(compact('miga','articulos','articulo','universidad','grupo','usuario','comentario','suma','chart'));


        //$arti = Articulo::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))->get();

        


        //dd($arti);
    }
}
