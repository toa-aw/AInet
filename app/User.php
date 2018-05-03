<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function blockToStr()
    {
        switch ($this->blocked) {
            case 0:
                return 'Open.';
            case 1:
                return 'Blocked.';
        }

        return 'unknown';
    }
    public function adminToStr()
    {
        switch ($this->admin) {
            case 0:
                return 'User.';
            case 1:
                return 'Admin.';
        }

        return 'unknown';
    }
}
