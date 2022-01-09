<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Cog\Contracts\Love\Liker\Models\Liker as LikerContract;
use Cog\Laravel\Love\Liker\Models\Traits\Liker;
use Jenssegers\Date\Date;


class User extends Authenticatable implements MustVerifyEmail, LikerContract
{

    use Notifiable, Liker;
    use TraductorFechas;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'alias', 'web', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getCreatedAtAttribute($date)
    {
        return new Date($date);
    }

    public function temas()
    {
        return $this->hasMany(Tema::class);
    }

    // $user->commentaries
    public function commentaries()
    {
        return $this->hasMany(Commentary::class);
    }
    // $user->articulos
    public function articulos()
    {
        return $this->hasMany(Articulo::class); 
    }

    
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /*public function getNameAttribute($valor) 
    {
        return ucfirst(strtolower($valor));
    } */

    /*public function setNameAttribute($value) 
    {
        $this->attributes['name']=ucfirst(mb_strtolower($value,'UTF-8'));
    }*/
    public function getUsuarioRolesAttribute()
    {
        $roles=$this->roles;
            foreach ($roles as $role)
            {
                    echo $role->nombre."<br>";
            }
    }

    public function getUsuarioBloqueadoAttribute()
    {
        $bloqueado=$this->bloqueado;
        if(!$bloqueado)
            return "Activo";
        return "Bloqueado";
    }


    public function hasRole($role)
    {
        $roles=$this->roles;
            foreach ($roles as $suRole)
            {
                if($suRole->nombre==$role)  // no se pueden llamar las dos variables iguales
                    return true;
            }
            return false;  
    }
}
