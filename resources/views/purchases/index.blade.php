@extends('layouts.layout')
@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet"/>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css"/>
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
                        <td class="p-0"><input disabled class="form-control p-0 m-0 b-radius-0 text-center" type="text"
                                               value="{{$invoice_number}}"></td>
                        <td>Purchase Date</td>
                        <td class="p-0"><input id="purchase_date" class="form-control p-0 m-0 b-radius-0 datepicker text-center" value="{{date('d-m-Y')}}" type="text"></td>
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
                        <th>Qty</th>
                        <th>Buying Unit Price</th>
                        <th class="text-right">Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="main_tbody">
                    <tr>
                        <td class="row_sl">1</td>
                        {{--                        <td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-center" type="text"></td>--}}
                        <td class="p-0">
                            <select class="select2 form-control p-0 m-0 row_product_id" style="width: 100%"
                                    name="state">
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name ." - " . $product->weight. " " . $product->unit->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="p-0"><input
                                    class="form-control p-0 m-0 b-radius-0 text-center row_expire_date" value="{{date('d-m-Y')}}"
                                    type="text"></td>
                        <td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-right row_quantity"
                                                value="1" min="1"
                                                type="number"></td>
                        <td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-right row_unit_price"
                                                value="0" min="0"
                                                type="number"></td>
                        <td class="p-0  text-right"><input disabled
                                                           class="form-control p-0 m-0 b-radius-0 text-right row_total"
                                                           value="0.00"
                                                           type="number"></td>
                        <td class="p-0  text-center">
                            <button class="btn  btn-danger row_delete_btn"><i class="metismenu-icon pe-7s-trash"></i>
                            </button>
                        </td>
                    </tr>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td class="text-right" colspan="5"><b>Grand Total</b></td>
                        <td class="p-0 m-0 text-right"><b id="grand_total">0.00</b></td>
                        <input type="hidden" id="grand_total_hidden" value="0">
                        <td class="p-0 m-0 text-right"></td>
                    </tr>
                    <tr>
                        <td colspan="7" class="text-center">
                            <button id="add_new_item_btn" class="btn btn-primary">Add New Item</button>
                            <button id="save_btn" class="btn btn-success">Save and Print</button>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js" integrity="sha512-rmZcZsyhe0/MAjquhTgiUcb4d9knaFc7b5xAfju483gbEXTkeJRUMIPk6s3ySZMYUHEcjKbjLjyddGWMrNEvZg==" crossorigin="anonymous"></script>
     <script>
        $(document).ready(function () {
            var products =@json($products);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.select2').select2();
            $('.datepicker').datepicker({
                showOtherMonths: true,
                autoclose: true,
                format: 'dd-mm-yyyy',
                showRightIcon: false,
                modal: true,
                header: true,
                uiLibrary: 'bootstrap4', iconsLibrary: 'materialicons'
            });
            $('#main_tbody').on('focus',".row_expire_date", function(){
                if( $(this).hasClass('hasDatepicker') === false )  {
                    $(this).datepicker({
                        showOtherMonths: true,
                        autoclose: true,
                        format: 'dd-mm-yyyy',
                        showRightIcon: false,
                        modal: true,
                        header: true,
                        uiLibrary: 'bootstrap4', iconsLibrary: 'materialicons'
                    });
                }
            });
            //changes
            $("#main_tbody").on('change', '.row_quantity', function () {
                updateRowPrice($(this).closest('tr'));
            });
            $("#main_tbody").on('change', '.row_unit_price', function () {
                updateRowPrice($(this).closest('tr'));
            });
            $("#main_tbody").on('click', '.row_delete_btn', function () {
                $(this).closest('tr').remove();
                updateRowSerialNumber();
                updateGrandTotal();
            });
            $('#save_btn').click(function () {
                var purchase_date = $('#purchase_date').val();
                var grand_total = $('#grand_total_hidden').val();
                var product_ids = $("#main_tbody").find('.row_product_id').toArray().map(item => item.value);
                var row_quantities = $("#main_tbody").find('.row_quantity').toArray().map(item => item.value);
                var row_unit_prices = $("#main_tbody").find('.row_unit_price').toArray().map(item => item.value);
                var row_expire_dates = $("#main_tbody").find('.row_expire_date').toArray().map(item => item.value);
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '/purchases',
                    data: {
                        data: JSON.stringify({
                            product_ids, row_quantities, row_unit_prices, row_expire_dates, purchase_date, grand_total
                        })
                    },
                    cache: false,
                    success: function (objects) {
                        if (objects) {
                            Swal.fire({
                                title: "Success!",
                                text: "Successfully Saved!",
                                type: "success",
                                showCancelButton: true,
                                //useRejections: true,
                                confirmButtonText: "Go To Invoice List",
                                cancelButtonText: "Purchase Again",
                            }).then(function (result) {
                                if (result.value) {
                                    $(location).attr("href", '/purchases/invoices');
                                } else if (result.dismiss == 'cancel') {
                                    $(location).attr("href", '/purchases');
                                }

                            });

                        } else {
                            Swal.fire(
                                'Failed!',
                                'Failed To Do the operation',
                                'danger'
                            )
                        }
                    }
                });
            });

            $('#add_new_item_btn').click(function () {
                var option = '';
                $.each(products, function (index, object) {
                    option += '<option value="' + object.id + '">' + object.name + ' - ' + object.weight + ' ' + object.unit.name + '</option>'
                });
                var today = moment().format('DD-MM-YYYY');
                $('#main_tbody').append(
                    '<tr>' +
                    '<td class="row_sl">1</td>' +
                    '<td class="p-0">' +
                    '<select class="select2 form-control p-0 m-0 row_product_id" style="width: 100%" name="state">' +
                    option +
                    '</select>' +
                    '</td>' +
                    '<td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-center row_expire_date" value="' + today + '" type="text"></td>' +
                    '<td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-right row_quantity" value="1" min="0" type="number"></td>' +
                    '<td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-right row_unit_price" value="0" min="0"  type="number"></td>' +
                    '<td class="p-0  text-right"><input disabled class="form-control p-0 m-0 b-radius-0 text-right row_total" value="0.00" type="number"></td>' +
                    '<td class="p-0  text-center">' +
                    '<button class="btn  btn-danger row_delete_btn"><i class="metismenu-icon pe-7s-trash"></i>' +
                    '</button>' +
                    '</td>' +
                    '</tr>'
                );
                $('.select2').select2();
                updateRowSerialNumber();
                updateGrandTotal();
            });

            //update row price
            function updateRowPrice(row) {
                var quantity = row.find('.row_quantity').val();
                var unit_price = row.find('.row_unit_price').val();
                row.find('.row_total').val(MathUtils.roundToPrecision(eval(quantity) * eval(unit_price), 2));
                updateRowSerialNumber();
                updateGrandTotal();
            }

            function updateGrandTotal() {

                var grand_total = 0;
                var row_totals = $('#main_tbody').find(".row_total").toArray();
                $.each(row_totals, function (index, row_total) {
                    grand_total += eval($(row_total).val());
                });
                $('#grand_total').html(formatterBdt.format(MathUtils.roundToPrecision(grand_total, 2)));
                $('#grand_total_hidden').val(MathUtils.roundToPrecision(grand_total, 2));
            }

            function updateRowSerialNumber() {

                var count = 0;
                var rowSerials = $('#main_tbody').find(".row_sl").toArray();
                $.each(rowSerials, function (index, value) {
                    count += eval(1);
                    value.innerHTML = count;
                });

            }

            var formatterBdt = new Intl.NumberFormat('en-US', {
                style: 'currency',
                currency: 'BDT',
            });
            let MathUtils = {
                roundToPrecision: function (subject, precision) {
                    return +((+subject).toFixed(precision));
                }
            }
        });
    </script>
@endsection
