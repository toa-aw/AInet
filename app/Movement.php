<?php

namespace App;

use App\MovementCategory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    public $timestamps = false;
    //public $updated_at = false;

    protected $fillable = [
        'value', 'start_balance', 'end_balance', 'account_id', 'date', 'movement_category_id', 'type', 'document_id', 'description', 'created_at',
    ];

    public function getCategoryName($movement_category_id)
    {
        $category = MovementCategory::where('id', $movement_category_id)->first();
        return $category->name;  
    }

    public function account()
    {
        return $this->belongsTo('App\Account');
    }

    public function movement_category()
    {
        return $this->hasOne('App\MovementCategory', 'id', 'movement_category_id');
    }

    public function document()
    {
        return hasOne('App\Document');
    }

    public function hasDocument()
    {
        if($this->document_id != null){
            return (bool)true;
        }
        return (bool)false;
    }
}
