<?php

namespace App\Policies;

use App\Models\Clase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClasePolicy
{
    use HandlesAuthorization;

    /**
     * Determina si el usuario puede actualizar una clase.
     */
    public function update(User $user, Clase $clase)
    {
        return $user->hasRole('Admin');  // Permitir si el usuario es Admin
    }

    /**
     * Determina si el usuario puede eliminar una clase.
     */
    public function delete(User $user, Clase $clase)
    {
        return $user->hasRole('Admin');  // Solo Admin puede eliminar
    }

    /**
     * Determina si el usuario puede crear una clase.
     */
    public function create(User $user)
    {
        return $user->hasRole('Admin');  // Solo Admin puede crear
    }

    /**
     * Determina si el usuario puede generar PDF.
     */
    public function generatePdf(User $user)
    {
        return $user->hasRole('Admin');  // Solo Admin puede generar PDFs
    }
}
