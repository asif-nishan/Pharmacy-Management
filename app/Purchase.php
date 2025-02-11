<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function reduceStock($amount)
    {
        $this->stock -= $amount;
        return $this;
    }
}
