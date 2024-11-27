<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Product;
use App\ProductType;
use App\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        $products = Product::orderBy('id', 'desc')->get();
        return view('products.index', ['title' => 'Product List', 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        $brands = Brand::all();
        $units = Unit::all();
        $product_types = ProductType::all();
        return view('products.create', [
            'title' => 'New Product',
            'brands' => $brands,
            'units' => $units,
            'product_types' => $product_types
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
        $product = new Product($validatedData);
        $product->status = $request->has('status') ? true : false;
        $product->save();
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     *
     */
    public function edit(Product $product)
    {
        $brands = Brand::all();
        $units = Unit::all();
        $product_types = ProductType::all();

        return view('products.edit', [
            'title' => 'Edit Product',
            'brands' => $brands,
            'units' => $units,
            'product' => $product,
            'product_types' => $product_types
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     *
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $this->getValidatedData();
        $product->status = $request->has('status') ? true : false;
        $product->update($validatedData);
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
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
                'name' => 'required',
                'upc' => 'string',
                'weight' => 'string',
                'low_stock_amount' => 'required',
                'description' => 'nullable',
                'brand_id' => 'required|integer',
                'unit_id' => 'required|integer',
                'product_type_id' => 'required|integer',
            ]
        );
    }

    public function stocks()
    {
        $products = Product::all();
        return view('products.stocks', ['title' => 'Product Stocks', 'products' => $products]);
    }
}
