<?php

namespace App\Http\Models;


use Illuminate\Database\Eloquent\Model;

class navigation extends Model
{
    public function scopeAllSorted($query)
    {
        return $query->orderBy('position');
    }

}
