<?php

namespace App\Http\Controllers;

use App\Product;
use App\Purchase;
use App\PurchaseInvoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
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
        $invoice_number = PurchaseInvoice::count() + 1;
        $products = Product::select('id','name','weight','unit_id')->where('status', 1)->get();
        return view('purchases.index', [
            'products' => $products,
            'invoice_number' => $invoice_number
        ]);
    }

    public function invoices()
    {
        $purchase_invoices = PurchaseInvoice::orderBy('id', 'desc')->get();
        return view('purchases.invoices', [
            'purchase_invoices' => $purchase_invoices,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'row_quantities' => 'required|array',
            'row_quantities.*' => 'integer',
            'row_unit_prices' => 'required|array',
            'row_unit_prices.*' => 'numeric',
            'row_expire_dates' => 'required|array',
            'row_expire_dates.*' => 'date',
            'purchase_date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(false);
        }
        $purchase_invoice = new PurchaseInvoice();
        $purchase_invoice->purchase_date = Carbon::createFromFormat('d-m-Y', $data['purchase_date'])->format('Y-m-d');
        $purchase_invoice->grand_total = $data['grand_total'];
        $purchase_invoice->save();
        for ($i = 0; $i < count($data['product_ids']); $i++) {
            $purchase = new Purchase();
            $purchase->purchase_invoice_id = $purchase_invoice->id;
            $purchase->product_id = $data['product_ids'][$i];
            $purchase->quantity = $data['row_quantities'][$i];
            $purchase->stock = $data['row_quantities'][$i]; // ar first the stock will be same as quantities
            $purchase->buying_price = $data['row_unit_prices'][$i];
            $purchase->expired_date = Carbon::createFromFormat('d-m-Y', $data['row_expire_dates'][$i])->format('Y-m-d');
            $purchase->save();
            //update stock
            Product::find($purchase->product_id)->updateStock($purchase->quantity)->save();
        }
        return response()->json(true);
    }

    /**
     * Display the specified resource.
     *
     * @param PurchaseInvoice $invoice
     *
     */
    public function show(PurchaseInvoice $invoice)
    {
        $purchases = Purchase::where('purchase_invoice_id', $invoice->id)->get();
        return view('purchases.show', [
            'purchases' => $purchases,
            'purchase_invoice' => $invoice,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Purchase $purchase
     *
     */
    public function edit(PurchaseInvoice $invoice)
    {
        $products = Product::select('id','name','weight','unit_id')->where('status', 1)->get();

        return view('purchases.edit', [
            'invoice' => $invoice,
            'products' => $products,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**w
     * Remove the specified resource from storage.
     *
     * @param \App\Purchase $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
