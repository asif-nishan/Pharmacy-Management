<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
    public function sales()
    {
        return $this->hasMany('App\Sale', 'sale_invoice_id', 'id');
    }

    public static function getTodayProfit($date)
    {
        $total_profit = 0;
        $saleInvoices = self::whereDate('selling_date', $date->toDateString())->get();
        foreach ($saleInvoices as $saleInvoice) {
            foreach ($saleInvoice->sales as $sale) {
                $saleInvoice->sales;
                $purchase = Purchase::where([['product_id', '=', $sale->product_id], ['id', '=', $sale->purchase_id]])->first();
                $total_profit += ($sale->selling_unit_price - $purchase->buying_price) * $sale->selling_quantity;
            }
            $total_profit = $total_profit - $saleInvoice->discount;
        }
        return $total_profit;
    }

    public static function getTodaySales($date)
    {
        $total_sales = 0;
        $sale_invoices = self::whereDate('selling_date', $date->toDateString())->get();
        foreach ($sale_invoices as $sale_invoice) {
            $total_sales += $sale_invoice->grand_total - $sale_invoice->discount;
        }
        return $total_sales;
    }
}
