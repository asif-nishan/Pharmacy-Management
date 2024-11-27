@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body table-responsive">
                <h5 class="card-title">Purchase Invoices</h5>
                <table id="datatable" class="mb-0 table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice Id</th>
                        <th>Total Amount (Tk)</th>
                        <th>Purchase Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchase_invoices as $key=> $purchase_invoice)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$purchase_invoice->id}}</td>
                            <td>{{number_format( $purchase_invoice->grand_total , 0 , '.' , ',' ) }}</td>
                            <td>{{\Carbon\Carbon::parse($purchase_invoice->purchase_date)->format('Y-M-d')}}</td>
                            <td>
                                <a href="{{'/purchases/invoices/'.$purchase_invoice->id}}" class="mt-2 btn btn-success">View</a>
                                <a href="{{'/purchases/invoices/edit/'.$purchase_invoice->id}}" class="mt-2 btn btn-primary">Edit</a>
                                {{--                                <a class="mt-2 btn btn-danger">Delete</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}


    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>

@endsection
