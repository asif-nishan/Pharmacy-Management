@extends('layouts.layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
@endsection
@section('content')
    <style>
        [class^='select2'] {
            width: 100%;
            border: 0 !important;
            border-radius: 0 !important;
        }

        .select2-container {
            min-width: 300px;
        }

        .form-control {
            border: 0 !important;
            margin: 0 !important;
            border-radius: 0 !important;
        }

        .form-control:disabled, .form-control[readonly] {
            background-color: white;
            opacity: 1;
        }
    </style>
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body">
                @isset($title)
                @endisset
                <h5 class="card-title">Sale Information</h5>
                <table id="datatable" class="mb-0 table table-bordered">
                    <tbody>
                    <tr>
                        <td>Invoice ID</td>
                        <td class="text-center">{{$sale_invoice->id}}</td>
                        <td>Selling Date</td>
                        <td class="text-center">{{\Carbon\Carbon::parse($sale_invoice->selling_date)->format('Y-m-y')}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="divider">
    </div>
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body table-responsive">
                <h5 class="card-title">Purchase Item</h5>
                <table class="mb-0 table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th class="text-right">Selling Quantity</th>
                        <th class="text-right">Selling Unit Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                    </thead>
                    <tbody id="main_tbody">
                    @foreach($sales as $key=> $sale)
                        <tr>
                            <td scope="rowSl" class="row_sl">{{$key +1}}</td>
                            <td>{{$sale->product->name ." - " .$sale->product->weight ." ".$sale->product->unit->name}}</td>
                            <td class="text-right">{{$sale->selling_quantity}}</td>
                            <td class="text-right">{{$sale->selling_unit_price}}</td>
                            <td class="text-right">{{ $sale->selling_quantity * $sale->selling_unit_price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-right" colspan="4"><b>Total</b></td>
                        <td class="p-0 m-0 text-right"><b id="grand_total">BDT {{number_format( $sale_invoice->grand_total , 0 , '.' , ',' ) }}</b></td>
                        <td class="p-0 m-0 text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="4"><b>Discount</b></td>
                        <td class="p-0 m-0 text-right"><b id="grand_total">BDT {{number_format( $sale_invoice->discount , 0 , '.' , ',' ) }}</b></td>
                        <td class="p-0 m-0 text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="4"><b>Grand Total</b></td>
                        <td class="p-0 m-0 text-right"><b id="grand_total">BDT {{number_format( $sale_invoice->grand_total -$sale_invoice->discount, 0 , '.' , ',' ) }}</b></td>
                        <td class="p-0 m-0 text-right"></td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <button id="save_btn" class="btn btn-success">Print</button>
                            <a href="/sales" class="btn btn-info">Back To Invoice List</a>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
