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
                <h5 class="card-title">Purchase Information</h5>
                <table id="datatable" class="mb-0 table table-bordered">
                    <tbody>
                    <tr>
                        <td>Invoice ID</td>
                        <td class="text-center">{{$purchase_invoice->id}}</td>
                        <td>Purchase Date</td>
                        <td class="text-center">{{\Carbon\Carbon::parse($purchase_invoice->purchase_date)->format('Y-m-y')}}</td>
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
                        <th>Expire Date</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Buying Unit Price</th>
                        <th class="text-right">Total</th>
                    </tr>
                    </thead>
                    <tbody id="main_tbody">
                    @foreach($purchases as $key=> $purchase)
                        <tr>
                            <td class="row_sl">{{$key +1}}</td>
                            <td>{{$purchase->product->name ." - " .$purchase->product->weight ." ".$purchase->product->unit->name}}</td>
                            <td>{{\Carbon\Carbon::parse($purchase->expired_date)->format('Y-m-d')}}</td>
                            <td class="text-right">{{$purchase->quantity}}</td>
                            <td class="text-right">{{$purchase->buying_price}}</td>
                            <td class="text-right">{{ $purchase->quantity * $purchase->buying_price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-right" colspan="5"><b>Grand Total</b></td>
                        <td class="p-0 m-0 text-right"><b
                                    id="grand_total">BDT {{number_format( $purchase_invoice->grand_total , 0 , '.' , ',' ) }}</b>
                        </td>
                        <td class="p-0 m-0 text-right"></td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <button id="save_btn" class="btn btn-success">Print</button>
                            <a href="/purchases/invoices" class="btn btn-info">Back To Invoice List</a>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
