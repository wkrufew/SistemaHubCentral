<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Commentary extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $dates = ['deleted_at'];

	// $commentary->articulo
    public function articulo()
	{
		return $this->belongsTo(Articulo::class);
	}

	// $commentary->user
    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
