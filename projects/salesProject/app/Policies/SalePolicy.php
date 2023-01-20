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

    /**
     * Verifica se o usuario autenticado pode ver detalhes da venda
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function canViewSale(User $user, Sale $sale)
    {

        if($this->isGeneralManager($user)) {
            return true;
        }

        if($this->isDirector($user) && $sale->user->company->unity->director->id == $user->company->unity->director->id) {

            return true;
        }

        if($this->isGeneralManager($user) && $sale->user->company->unity->id == $user->company->unity->id) {
            return true;
        }

        if($this->isGeneralManager($user) && $sale->user->company->unity->id == $user->company->unity->id) {
            return true;
        }

        if($this->isSalesman($user) &&  $sale->user->id == $user->id) {
            return true;
        }

        return false;
    }
}
