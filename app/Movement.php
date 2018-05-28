<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'value', 'start_balance', 'end_balance', 'account_id', 'date', 'movement_category_id', 'type',
    ];

    //protected $touches = ['account'];

    public function account()
    {
        return $this->belongsTo('App\Account');
    }
}
