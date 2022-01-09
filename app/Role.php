<?php

namespace App;
use Jenssegers\Date\Date;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use TraductorFechas;

    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
        //return $this->belongsToMany(User::class)->withTimestamps();
    }
}
