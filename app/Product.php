<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'upc',
        'weight',
        'description',
        'low_stock_amount',
        'brand_id',
        'unit_id',
        'product_type_id',
        'status',
    ];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function productType()
    {
        return $this->belongsTo('App\ProductType');
    }

    public function getActivePrice()
    {
        $price = 0;
        $product_price = ProductPrice::where([
            ['product_id', '=', $this->id],
            ['status', '=', '1']
        ])->first();
        if ($product_price != null) {
            $price = $product_price->selling_price;
        }
        return $price;
    }

    public function updateStock($amount)
    {
        $this->stock += $amount;
        return $this;
    }
    public function reduceStock($amount)
    {
        $this->stock -= $amount;
        return $this;
    }
}
