<?php

namespace App\Policies;

use App\User;
use App\Movement;
use Illuminate\Auth\Access\HandlesAuthorization;

class MovementPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the movement.
     *
     * @param  \App\User  $user
     * @param  \App\Movement  $movement
     * @return mixed
     */
    public function view(User $user, Movement $movement)
    {
        $account = Account::id($movement->account_id);
        return $user->isAdmin() || $account->owner_id == $user->id;
    }

    /**
     * Determine whether the user can create movements.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the movement.
     *
     * @param  \App\User  $user
     * @param  \App\Movement  $movement
     * @return mixed
     */
    public function update(User $user, Movement $movement)
    {
        //
    }

    /**
     * Determine whether the user can delete the movement.
     *
     * @param  \App\User  $user
     * @param  \App\Movement  $movement
     * @return mixed
     */
    public function delete(User $user, Movement $movement)
    {
        //
    }
}
