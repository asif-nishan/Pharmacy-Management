<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseInvoice extends Model
{
    public function purchases()
    {
        return $this->hasMany('App\Purchase', 'purchase_invoice_id', 'id');
    }
}
