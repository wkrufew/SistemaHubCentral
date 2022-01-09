<?php

namespace App\Policies;

use App\User;
use App\ArticuloImagen;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticuloImagenPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function delete(User $user, ArticuloImagen $imagen)
    {
        return $user->id === $imagen->articulo->user_id;
    }
}
