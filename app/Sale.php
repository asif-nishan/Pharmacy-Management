<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    public function saleInvoice()
    {
        return $this->belongsTo('App\SaleInvoice','sale_invoice_id');
    }
}
