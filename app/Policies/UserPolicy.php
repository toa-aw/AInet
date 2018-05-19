<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function changePassword(User $user, User $model)
    {
      return $user->id == $model->id;
    }
}
