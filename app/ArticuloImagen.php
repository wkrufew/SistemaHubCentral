<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class ArticuloImagen extends Model
{
	use SoftDeletes;
    use SoftCascadeTrait;
    
    protected $dates = ['deleted_at'];
	//protected $softCascade = ['imagenes'];
	

    public function articulo()
	{
		return $this->belongsTo(Articulo::class);
	}
}
 