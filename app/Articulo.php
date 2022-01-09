<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cog\Contracts\Love\Likeable\Models\Likeable as LikeableContract;
use Cog\Laravel\Love\Likeable\Models\Traits\Likeable;
use Jenssegers\Date\Date;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;



class Articulo extends Model implements LikeableContract
{
    
    use Likeable;

    use TraductorFechas;
    use SoftDeletes;
    use SoftCascadeTrait;
    
    
    protected $dates = ['deleted_at'];
    protected $softCascade = ['imagenes'];
    protected $fillable=['titulo','contenido','activo','tema_id'];
    
   //use TraductorFechas;
   
    public function getCreatedAtAttribute($date)
   {
       return new Date($date);
   }

    
    public function tema()
    {
        return $this->belongsTo(Tema::class); 
    }

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

       // $articulo->imagenes
       public function imagenes()
       {
           return $this->hasMany(ArticuloImagen::class);
       }

       public function imagenDestacada()
       {
           $imagenDestacada=$this->imagenes->first();
           if(!$imagenDestacada)
               return 'imagen_no.png';
           return $imagenDestacada->nombre;
       }
   
     /*public function scopeArticulosActivos($consulta)
        {
           return $consulta->where('activo','=',1);
        }*/

        protected static function boot()
        {
            parent::boot();
            
            static::addGlobalScope('activo', function ($query) {
                return $query->where('activo', true);
            });
        }



        public function getEstaActivadoAttribute()
        {
            $estaActivado=$this->activo;
            if($estaActivado)
                return 'Si';
            return 'No';
        }
      // $article->commentaries
        public function commentaries()
        {
            return $this->hasMany(Commentary::class);
        }
}
