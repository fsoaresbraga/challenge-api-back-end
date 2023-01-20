<?php

namespace App\Policies;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SalePolicy
{
    use HandlesAuthorization;

    /**
     * Verifica se o usuario autenticado é um venddor
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function isSalesman(User $user)
    {

        return  $user->profile_id == User::SALESMAN;
    }

    /**
     * Verifica se o usuario autenticado é um gerente
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function isManager(User $user)
    {

        return  $user->profile_id == User::MANAGER;
    }

    /**
     * Verifica se o usuario autenticado é um diretor
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function isDirector(User $user)
    {

        return  $user->profile_id == User::DIRECTOR;
    }

    /**
     * Verifica se o usuario autenticado é um diretor geral
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function isGeneralManager(User $user)
    {

        return  $user->profile_id == User::GENERAL_MANAGER;
    }

}
