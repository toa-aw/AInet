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
        //$category = MovementCategory::with('movement');
        //$category = $category->where('id', $movement_category_id)->first();
        //dd(MovementCategory::with('movement')->get());
        return $category;  
    }

    public function account()
    {
        return $this->belongsTo('App\Account', 'id', 'account_id');
    }

    public function movement_category(){
        return $this->hasOne('App\MovementCategory', 'id', 'movement_category_id');
    }
}
