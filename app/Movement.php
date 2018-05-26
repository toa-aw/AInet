<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{

    protected $fillable = [
        'value', 'start_balance', 'end_balance', 'account_id', 'date', 
    ];

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
}
