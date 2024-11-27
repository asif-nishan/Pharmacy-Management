<?php

namespace App\Http\Controllers;

use App\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return view('brands.index', ['title' => 'Brand List', 'brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create', ['title' => 'Create New Brand']);
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
        $brand = new Brand($validatedData);
        $brand->status = $request->has('status') ? true : false;
        $brand->save();
        return redirect('/brands');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', ['title' => 'Edit Brand', 'brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $this->getValidatedData();
        $brand->status = $request->has('status') ? true : false;
        $brand->update($validatedData);

        return redirect('/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
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
            ]
        );
    }
}
