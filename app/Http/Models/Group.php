<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	public $timestamps = false;
	/**
     * Get the phone record associated with the user.
     */
    public function users()
    {
        return $this->hasMany('App\Http\Models\User');
    }
    //
}
