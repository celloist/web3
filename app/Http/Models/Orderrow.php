<?php

namespace App\Http\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Orderrow extends Model
{
    public function product () {
    	return $this->hasOne('App\Http\Models\Product', 'id', 'Products_id');
    }

    /**
     * [vatTotals description]
     * @param  integer $orderId [description]
     * @return [type]           [description]
     */
    public function scopeVatTotals ($query, $orderId = 0) {
        return $query->select('vat', DB::raw('(SUM(quantity * price) / (100 + vat) * vat) AS total'))->where('Orders_id', $orderId)->groupBy('vat')->orderBy('vat');
    }
}
