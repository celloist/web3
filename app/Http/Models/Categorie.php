<?php

namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Categorie extends Model
{
    use SoftDeletes;
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $dates = ['deleted_at'];
    //
    public function products(){
        return $this->hasMany('Product');
    }

    public function scopeWithProductThumb ($query) {
        return $query->select(DB::Raw('categories.*'), DB::Raw('(SELECT CONCAT(artikelnr, "/", small_image_link) FROM products WHERE products.Categories_id = categories.id LIMIT 1) AS thumb'));
    }

    public function scopeHavingProducts ($query) {
        return $query->having(DB::Raw('(SELECT COUNT(*) FROM products WHERE products.Categories_id = categories.id)'), '>', 0);
    }
}
