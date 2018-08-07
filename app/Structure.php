<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Structure extends Model
{
    protected $fillable = [
        'name'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function questions()
    {
        return $this->belongsToMany('App\Question');
    }
}
