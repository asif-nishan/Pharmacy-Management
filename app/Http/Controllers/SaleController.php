<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase;
use App\PurchaseInvoice;
use App\Sale;
use App\SaleInvoice;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $sale_invoices = SaleInvoice::orderBy('id', 'desc')->get();
        return view('sales.index', [
            'sale_invoices' => $sale_invoices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        $invoice_number = SaleInvoice::count() + 1;
        $products = Product::select('id','name','weight','unit_id')->where('status', 1)->get();
        $first_product = $products->first();
        $purchases = Purchase::where([['product_id', '=', $first_product->id], ['stock', '!=', 0]])->get();
        return view('sales.create', [
            'products' => $products,
            'invoice_number' => $invoice_number,
            'purchases' => $purchases
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->data, true);
        $validator = Validator::make($data, [
            'product_ids' => 'required|array',
            'product_ids.*' => 'integer',
            'purchase_ids' => 'required|array',
            'purchase_ids.*' => 'integer',
            'row_quantities' => 'required|array',
            'row_quantities.*' => 'integer',
            'row_unit_prices' => 'required|array',
            'row_unit_prices.*' => 'numeric',
            'discount' => 'required|numeric',
            'selling_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(false);
        }
        $sale_invoice = new SaleInvoice();
        $sale_invoice->user_id = Auth::user()->id;
        $sale_invoice->selling_date = Carbon::createFromFormat('d-m-Y', $data['selling_date'])->format('Y-m-d');;
        $sale_invoice->grand_total = $data['grand_total'];
        $sale_invoice->discount = $data['discount'];
        $sale_invoice->save();
        for ($i = 0; $i < count($data['product_ids']); $i++) {
            $sale = new Sale();
            $sale->sale_invoice_id = $sale_invoice->id;
            $sale->product_id = $data['product_ids'][$i];
            $sale->purchase_id = $data['purchase_ids'][$i];
            $sale->selling_quantity = $data['row_quantities'][$i];
            $sale->selling_unit_price = $data['row_unit_prices'][$i];
            $sale->selling_unit_price = $data['row_unit_prices'][$i];
            $sale->selling_date = Carbon::createFromFormat('d-m-Y', $data['selling_date'])->format('Y-m-d');;
            $sale->save();
            //update purchase stock
            $purchase = Purchase::find($sale->purchase_id);
            $purchase->reduceStock($sale->selling_quantity)->save();
            //update product stock
            $purchase->product->reduceStock($sale->selling_quantity)->save();
        }
        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sale $sale
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(SaleInvoice $sale)
    {
        $sales = Sale::where('sale_invoice_id', $sale->id)->get();
        return view('sales.show', [
            'sales' => $sales,
            'sale_invoice' => $sale,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sale $sale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function getProductInfo(Request $request)
    {

        $data = json_decode($request->data, true);
        $validator = Validator::make($data, [
            'product_id' => 'required|integer',
            // 'product_id.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(false);
        }

        //get batch
        $purchases = Purchase::where([['product_id', '=', $data['product_id']], ['stock', '!=', 0]])->get();
        $unit_price = Product::find($data['product_id'])->getActivePrice();
        //get selling unit price
        return response()->json(['purchases' => $purchases, 'unit_price' => $unit_price]);
    }

    public function getStockByPurchase(Request $request)
    {

        $data = json_decode($request->data, true);
        $validator = Validator::make($data, [
            'row_purchase_id' => 'required|integer',
            // 'product_id.*' => 'integer',
        ]);

        if ($validator->fails()) {
            return response()->json(false);
        }

        //get batch
        $purchase_stock = Purchase::find($data['row_purchase_id'])->stock;
        //get selling unit price
        return response()->json(['purchase_stock' => $purchase_stock]);
    }
}
