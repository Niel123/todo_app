<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name'];

    /*public function user()
	{
	    return $this->belongsTo('App\User');
	}*/

	public function user()
	{
	    return $this->belongsTo('App\User');
	}
}
