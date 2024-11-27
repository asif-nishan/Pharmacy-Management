@extends('layouts.layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')

    {{--    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>--}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
          rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body">
                @isset($title)
                @endisset
                <h5 class="card-title">Monthly Revenue Report of {{$currentMonth->format('M, Y')}}</h5>
                <table id="datatable" class="mb-0 table table-bordered">
                    <tbody>
                    <tr>
                        <td>
                            <center>
                                <a href="#" id="prev_button" class="btn-lg" value="Previous"
                                   data-original-title="Previous Month"><i
                                        class="fa fa-angle-double-left fa-lg text-default"></i></a>

                                <input type="hidden" id="prev_month"
                                       value="{{$prevMonth}}">
                                <input id="monthpicker" style="max-width: 100px" name="datetime" name="monthpicker"
                                       class="au-input docs-date datepicker" type="text" placeholder="Date"
                                       value="{{$currentMonth->format('m-Y')}}"
                                       autocomplete="off">
                                <a href="#" id="next_button" class="btn-lg" value="Next"
                                   data-original-title="Next Month"><i
                                        class="fa fa-angle-double-right fa-lg text-default"></i></a>
                                <input type="hidden" id="next_month"
                                       value="{{$nextMonth}}">
                                <input id="show_report_button" title="" type="button"
                                       class="btn btn-primary btn-sm" value="Show Report">
                            </center>
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
                <h5 class="card-title">Purchase Item</h5>
                <table class="mb-0 table table-bordered">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Total Sale (Tk)</th>
                        <th class="text-center">Total Revenue (Tk)</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody id="main_tbody">
                    <?php $i = 1;?>
                    @foreach($sale_profit_by_month as $key => $sale_profit)
                        <tr>
                            <td class="text-center">{{$i}}</td>
                            <td class="text-center">{{$sale_profit['date']}}</td>
                            <td class="text-center">{{$sale_profit['sale']}}</td>
                            <td class="text-center">{{$sale_profit['profit']}}</td>
                            <td class="text-center">
                                <a class="btn  btn-success row_delete_btn" href="/reports/daily?date={{$sale_profit['date']}}"> View Sales
                                </a>
                            </td>
                        </tr>
                        <?php $i++;?>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td class="text-center"><b id="grand_total">Grand Total Sale: {{$total_sale}}</b></td>
                        <td class="text-center"><b id="grand_total">Grand Total Profit: {{$grand_total}}</b></td>
                        <td class="text-right"></td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <button id="save_btn" class="btn btn-success">Print</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    {{--    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"
            type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#monthpicker').datepicker({
                autoclose: true,
                format: "mm-yyyy",
                startView: "months",
                minViewMode: "months",
            });
            $("#show_report_button").click(function () {
                let date = $("#monthpicker").val();
                let res = date.split("-");
                let month = res[0];
                let year = res[1];
                let url = 'monthly?month=' + month + '&year=' + year;
                $(location).attr("href", url);
            });
            $("#prev_button").click(function () {
                let date = $("#prev_month").val();
                let res = date.split("-");
                let month = res[0];
                let year = res[1];
                let url = 'monthly?month=' + month + '&year=' + year;
                $(location).attr("href", url);
            });
            $("#next_button").click(function () {
                let date = $("#next_month").val();
                let res = date.split("-");
                let month = res[0];
                let year = res[1];
                let url = 'monthly?month=' + month + '&year=' + year;
                $(location).attr("href", url);
            });
        });
    </script>
@endsection
