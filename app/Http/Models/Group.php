<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
	public $timestamps = false;

	public function scopeName ($query, $name) {
		return $query->where('name', $name);
	}
}