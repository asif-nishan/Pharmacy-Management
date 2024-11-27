<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductPrice;
use Illuminate\Http\Request;

class ProductPriceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function managePrice()
    {
        $products = Product::paginate(10);
        return view('product_prices.manage_price', ['title' => 'Manage Price', 'products' => $products]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        //
        $product_prices = ProductPrice::where('product_id', $product->id)->get();
        return view('product_prices.index', [
            'product_prices' => $product_prices,
            'product' => $product,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('product_prices.create', [
            'product' => $product,
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
        $validatedData = $this->getValidatedData();
        $productPrice = new ProductPrice($validatedData);
        $productPrice->status = $request->has('status') ? true : false;

        //Deactivate all other Product Price of this product
        ProductPrice::where('product_id', $productPrice->product_id)->update(['status' => 0]);
        $productPrice->save();
        return redirect('/product-prices/' . $productPrice->product_id);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ProductPrice $productPrice
     * @return \Illuminate\Http\Response
     */
    public function show(ProductPrice $productPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ProductPrice $productPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPrice $productPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ProductPrice $productPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductPrice $productPrice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ProductPrice $productPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductPrice $productPrice)
    {
        //
    }

    /**
     * @return mixed
     */
    public function getValidatedData()
    {
        return request()->validate(
            [
                'product_id' => 'required',
                'selling_price' => 'required',
            ]
        );
    }
}
