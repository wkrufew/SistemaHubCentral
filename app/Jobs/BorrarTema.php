<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Storage;
use App\Tema;

class BorrarTema implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $tema;
    
    public function __construct(Tema $tema)
    {
        $this->tema=$tema;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
       $tema=$this->tema;
        $articulos=$tema->articulos()->with(['imagenes'])->get();
        foreach ($articulos as $articulo)
        {
            foreach($articulo->imagenes as $imagen)
            {
                // lo borramos físicamente
                Storage::disk('public')->delete('/imagenesArticulos/'.$imagen->nombre);
            }
            //$articulo->imagenes()->delete();
            //$articulo->delete();
        }
        
        $tema->delete();
    }
}
