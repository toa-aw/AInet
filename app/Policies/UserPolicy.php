<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function editUser(User $user, User $model)
    {
        // dd($user->id, $model->id);
      return $user->id == $model->id;
    }

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
