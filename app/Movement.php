<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\MovementCategory;

class Movement extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'value', 'start_balance', 'end_balance', 'account_id', 'date', 'movement_category_id', 'type',
    ];
    
    public function getCategoryName($movement_category_id)
    {
        $category = MovementCategory::where('id', $movement_category_id)->get();
        
        return $category['0']['name']; 
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function movement_category(){
        return $this->hasOne('App\MovementCategory', 'id', 'movement_category_id');
    }
}
