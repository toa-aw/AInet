<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function list(User $user)
    {
        return $user->isAdmin();        
    }

    public function alterStatus(User $user, User $model)
    {
        return $user->isAdmin()  && $user->id != $model->id; 
    }
    
    public function alterRank(User $user, User $model)
    {
        return $user->isAdmin() && $user->id != $model->id;  
    }

}
