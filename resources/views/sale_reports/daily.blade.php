@extends('layouts.layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body col-12">
                <h5 class="card-title">Monthly Revenue Report of {{$currentDay->format('d M, Y')}}</h5>
                <table class="col-12">
                    <tbody>
                    <tr>
                        <td class="text-right">
                            <a href="#" id="prev_button" class="btn-lg" data-original-title="Previous Month">
                                <i class="fa fa-angle-double-left fa-lg text-default"></i>
                            </a>
                        </td>
                        <td style="max-width: 200px">
                            <input type="hidden" id="prev_day"
                                   value="{{$prevDay}}">
                            <input type="hidden" id="next_day"
                                   value="{{$nextDay}}">
                            <input id="datepicker" name="datetime"
                                   class="au-input docs-date datepicker" type="text" placeholder="Date"
                                   value="{{$currentDay->format('d-m-Y')}}"
                                   autocomplete="off">
                        </td>
                        <td class="text-left">
                            <a href="#" id="next_button" class="btn-lg"
                               data-original-title="Next Month"><i
                                    class="fa fa-angle-double-right fa-lg text-default"></i></a>
                        </td>
                        <td class="text-left">
                            <input id="show_report_button" title="" type="button"
                                   class="btn btn-primary btn-sm" value="Show Report">
                        </td>
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
                <h5 class="card-title">Sales Invoice</h5>
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
                    @foreach($saleInvoices as $key=> $sale_invoice)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$sale_invoice->id}}</td>
                            <td>{{number_format( $sale_invoice->grand_total - $sale_invoice->discount , 0 , '.' , ',' ) }}</td>
                            <td>{{\Carbon\Carbon::parse($sale_invoice->selling_date)->format('d-m-Y')}}</td>
                            <td>
                                <a href="{{'/sales/'.$sale_invoice->id}}" class="mt-2 btn btn-sm btn-success">View</a>
                                <a href="#" class="mt-2 btn btn-sm btn-primary">Edit</a>
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').DataTable();
            $('#datepicker').datepicker({
                showOtherMonths: true,
                autoclose: true,
                format: 'dd-mm-yyyy',
                showRightIcon: false,
                modal: true,
                header: true,
                uiLibrary: 'bootstrap4',
                iconsLibrary: 'materialicons'
            });
            $("#show_report_button").click(function () {
                let date = $("#datepicker").val();
                let url = 'daily?date=' + date;
                $(location).attr("href", url);
            });
            $("#prev_button").click(function () {
                let date = $("#prev_day").val();
                let url = 'daily?date=' + date;
                $(location).attr("href", url);
            });
            $("#next_button").click(function () {
                let date = $("#next_day").val();
                let url = 'daily?date=' + date;
                $(location).attr("href", url);
            });
        });
    </script>

@endsection
