<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'profile_photo'
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

    public function isAdmin (){
        return (bool)$this->admin;
    }

    public function isBlocked ()
    {
        return (bool)$this->blocked;
    }

    public function scopeFindUsersByName($query, $name)
    {
        return $query->where('name', 'like', '%'. $name.'%');
    }

    public function scopeFindUsersByRank($query, $admin)
    {
        if($admin == "admin"){
            return $query->where('admin', 1);
        }else if($admin == "normal"){
             return $query->where('admin', 0); 
        }  
    }

    public function scopeFindUsersByStatus($query, $status)
    {
        if($status == "blocked"){
            return $query->where('blocked', 1);
        }else if($status == "unblocked"){
            return $query->where('blocked', 0);
        }    
    }

    public static function buildQuery(Request $request){
        // dd($request->name);
        $query = User::query();
        dd($query);
        $query->where('name','like', $request->input('name'));
        if($request->input('type') == "1"){
            $query = $query->where('admin', 1);
        }

        if($request->input('type') == "0"){
            $query = $query->where('admin', 0);
        }

        if($request->input('status') == "1"){
            $query = $query->where('blocked', 1);
        }

        if($request->input('status') == "0"){
            $query = $query->where('blocked', 0);
        }

        $users = $query->paginate();

        return $users;
    }
}
