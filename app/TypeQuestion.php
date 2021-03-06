<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeQuestion extends Model
{
	protected $table = 'type_questions';

	protected $fillable = [
        'name','status'
    ];

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
}
