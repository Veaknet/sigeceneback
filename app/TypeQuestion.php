<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeQuestion extends Model
{
	protected $table = 'type_question';

	protected $fillable = [
        'name'
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
