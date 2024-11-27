<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase;
use App\Sale;
use App\SaleInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $total_sales = SaleInvoice::getTodaySales(Carbon::now());
        $total_profit = SaleInvoice::getTodayProfit(Carbon::now());
        $product_sold = $this->getTodayProductSold();
        $low_stock = $this->getLowStock();
        return view('welcome', [
            'total_sales' => $total_sales,
            'total_profit' => $total_profit,
            'product_sold' => $product_sold,
            'low_stock' => $low_stock,
        ]);
    }

    private function getTodayProductSold()
    {
        $total_product_sold = 0;
        $sales = Sale::whereDate('selling_date', Carbon::today())->get();
        foreach ($sales as $sale) {
            $total_product_sold += $sale->selling_quantity;
        }
        return $total_product_sold;
    }

    private function getLowStock()
    {
        $low_stock = 0;
        $products = Product::all();

        foreach ($products as $product) {
            if ($product->stock < $product->low_stock_amount) {
                $low_stock++;
            }
        }

        return $low_stock;
    }
}
