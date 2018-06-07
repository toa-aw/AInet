<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_type_id', 'date', 'code', 'description', 'start_balance', 'owner_id', 'current_balance', 'document_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    public function hasMovements()
    {
        return $this->last_movement_date != null;
    }

    public function isOpen()
    {
        return $this->deleted_at == null;
    }

    public function accountTypeToStr()
    {
        switch ($this->account_type_id) {
            case 1:
                return 'Bank Account';
            case 2:
                return 'Pocket Money';
            case 3:
                return 'PayPal Account';
            case 4:
                return 'Credit Card';
            case 5:
                return 'Metal Card';
        }

        return 'unknown';
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function movements()
    {
        return $this->hasMany('App\Movement');
    }
}
