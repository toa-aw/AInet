<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
        protected $fillable = [
        'original_name', 'type', 'description'
    ];

    public $updated_at = false;

    public function movement()
    {
        return $this->belongsTo('App\Movement');
    }
}
