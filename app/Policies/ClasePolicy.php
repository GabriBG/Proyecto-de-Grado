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
        // Permitir si el usuario tiene el rol de Admin o Director
        return $user->hasRole('Admin') || $user->hasRole('Director');
    }

    /**
     * Determina si el usuario puede eliminar una clase.
     */
    public function delete(User $user, Clase $clase)
    {
        // Permitir si el usuario tiene el rol de Admin o Director
        return $user->hasRole('Admin') || $user->hasRole('Director');
    }

    /**
     * Determina si el usuario puede crear una clase.
     */
    public function create(User $user)
    {
        // Permitir si el usuario tiene el rol de Admin o Director
        return $user->hasRole('Admin') || $user->hasRole('Director') || $user->hasRole(roles: 'Docente');
    }

    /**
     * Determina si el usuario puede generar PDF.
     */
    public function generatePdf(User $user)
    {
        // Permitir si el usuario tiene el rol de Admin o Director
        return $user->hasRole('Admin') || $user->hasRole('Director');
    }
}
