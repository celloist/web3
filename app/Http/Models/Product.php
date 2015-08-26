<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];

    public function categories (){
        return $this->hasOne('App\Http\Models\Categorie', 'id', 'Categories_id');
    }

    public function scopeWithCategory ($query, $id) {
    	return $query->where('Categories_id', $id);
    }

    public function scopeWithSearchable($query, $value) {
    	return $query->where('name', 'LIKE', '%'.$value.'%')
        ->OrWhere('detail', 'LIKE', '%'.$value.'%');
    }
}
