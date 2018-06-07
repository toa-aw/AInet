<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovementCategory extends Model
{
    protected $table = 'movement_categories';  
    public $timestamps = false;
    
protected $fillable = [
        'name',
    ];

    public function movement(){
        return $this->belongsToMany('App\Movement', 'movement_category_id');
    }
}
