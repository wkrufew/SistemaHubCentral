<?php

namespace App\Policies;

use App\User;
use App\Articulo;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticuloPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the articulo.
     *
     * @param  \App\User  $user
     * @param  \App\Articulo  $articulo
     * @return mixed
     */
    public function view(User $user, Articulo $articulo)
    {
        return $user->id === $articulo->user_id;
    }

    /**
     * Determine whether the user can create articulos.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the articulo.
     *
     * @param  \App\User  $user
     * @param  \App\Articulo  $articulo
     * @return mixed
     */

    public function edit(User $user, Articulo $articulo)
    {
        return $user->id === $articulo->user_id;
    }

    public function update(User $user, Articulo $articulo)
    {
        return $user->id === $articulo->user_id;
    }

    /**
     * Determine whether the user can delete the articulo.
     *
     * @param  \App\User  $user
     * @param  \App\Articulo  $articulo
     * @return mixed
     */
    public function delete(User $user, Articulo $articulo)
    {
        return $user->id === $articulo->user_id;
        
    }

    /**
     * Determine whether the user can restore the articulo.
     *
     * @param  \App\User  $user
     * @param  \App\Articulo  $articulo
     * @return mixed
     */
    public function restore(User $user, Articulo $articulo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the articulo.
     *
     * @param  \App\User  $user
     * @param  \App\Articulo  $articulo
     * @return mixed
     */
    public function forceDelete(User $user, Articulo $articulo)
    {
        //
    }
}
