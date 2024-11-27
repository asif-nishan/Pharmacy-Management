<?php

namespace App\Http\Controllers;

use App\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $vendors = Vendor::all();
        //
        return view('vendors.index', ['title' => 'Vendor List', 'vendors' => $vendors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vendors.create', ['title' => 'Create New Vendor']);
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
        $vendor = new Vendor($validatedData);
        $vendor->status = $request->has('status') ? true : false;
        $vendor->save();
        return redirect('/vendors');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {
        //
        return view('vendors.show', ['title' => 'View Vendor']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
        //
        return view('vendors.edit', ['title' => 'Edit Vendor', 'vendor' => $vendor]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {
        $validatedData = $this->getValidatedData();
        $vendor->status = $request->has('status') ? true : false;
        $vendor->update($validatedData);
        return redirect('/vendors');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Vendor $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
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
                'title' => 'required',
                'company' => 'required',
                'address' => 'required',
                'email' => 'required|email',
                'phone_number' => ['required', 'regex:/^(?:\+88|01)?(?:\d{11}|\d{13})$/'],
            ]
        );
    }
}
