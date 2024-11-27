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
            min-width: 150px;
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
                <h5 class="card-title">Sell Information</h5>
                <table id="datatable" class="mb-0 table table-bordered">
                    <tbody>
                    <tr>
                        <td>Invoice ID</td>
                        <td class="p-0"><input disabled class="form-control p-0 m-0 b-radius-0 text-center" type="text"
                                               value="{{$invoice_number}}"></td>
                        <td>Selling Date</td>
                        <td class="p-0"><input id="selling_date" value="{{date("d-m-Y")}}"
                                               class="form-control p-0 m-0 b-radius-0 datepicker text-center"
                                               type="text"></td>
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
                <h5 class="card-title">Sell List</h5>
                <table class="mb-0 table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Item</th>
                        <th>Batch</th>
                        <th>Available Qty</th>
                        <th>Selling Qty</th>
                        <th>Selling Unit Price</th>
                        <th class="text-right">Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="main_tbody">
                    <tr>
                        <td class="row_sl">1</td>
                        {{--                        <td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-center" type="text"></td>--}}
                        <td class="p-0">
                            <select class="select2 form-control p-0 m-0 row_product_id" style="width: 100%">
                                <option value="0">Select Item</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->name ." - " . $product->weight. " " . $product->unit->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="p-0">
                            <select class="select2 form-control p-0 m-0 row_purchase_id"
                                    style="min-width: 150px">
                                {{--                                @foreach($purchases as $purchase)--}}
                                {{--                                    <option value="{{$purchase->id}}">P.Invoice Id - {{$purchase->id}}</option>--}}
                                {{--                                @endforeach--}}
                            </select>
                        </td>
                        <td class="p-0 "><input disabled
                                                class="form-control p-0 m-0 b-radius-0 text-center row_available_quantity"
                                                value="0" min="1" type="number"></td>
                        <td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-center row_quantity"
                                                value="1" min="1"
                                                type="number"></td>
                        <td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-center row_unit_price"
                                                value="0" min="0"
                                                type="number"></td>

                        <td class="p-0  text-right"><input disabled
                                                           class="form-control p-0 m-0 b-radius-0 text-center row_total"
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
                        <td class="text-right" colspan="6"><b>Total</b></td>
                        <td class="p-0 m-0 text-right"><b id="total">0.00</b></td>
                        <input type="hidden" id="grand_total_hidden" value="0">
                        <td class="p-0 m-0 text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="6"><b>Discoount (-)</b></td>
                        <td class="p-0 m-0 "><input type="number" class="form-control text-right p-0 m-0 " id="discount" value="0"></td>
                        <td class="p-0 m-0 text-right"></td>
                    </tr>
                    <tr>
                        <td class="text-right" colspan="6"><b>Grand Total</b></td>
                        <td class="p-0 m-0 text-right"><b id="grand_total">0.00</b></td>
                        <input type="hidden" id="total_hidden" value="0">
                        <td class="p-0 m-0 text-right"></td>
                    </tr>
                    <tr>
                        <td colspan="8" class="text-center">
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
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
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
            //$('.datepicker').datepicker('setDate', new Date());
            //changes
            $("#main_tbody").on('change', '.row_quantity', function () {
                updateRowPrice($(this).closest('tr'));
            });
            $("#main_tbody").on('change', '.row_unit_price', function () {
                updateRowPrice($(this).closest('tr'));
            });
            $("#discount").change(function () {
                updateGrandTotal();
            });
            $("#main_tbody").on('click', '.row_delete_btn', function () {
                $(this).closest('tr').remove();
                updateRowSerialNumber();
                updateGrandTotal();
            });
            $('#save_btn').click(function () {
                $(this).attr("disabled", "disabled");
                var selling_date = $('#selling_date').val();
                var grand_total = $('#total_hidden').val();
                var discount = $('#discount').val();
                var product_ids = $("#main_tbody").find('.row_product_id').toArray().map(item => item.value);
                var purchase_ids = $("#main_tbody").find('.row_purchase_id').toArray().map(item => item.value);
                var row_quantities = $("#main_tbody").find('.row_quantity').toArray().map(item => item.value);
                var row_unit_prices = $("#main_tbody").find('.row_unit_price').toArray().map(item => item.value);
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '/sales',
                    data: {
                        data: JSON.stringify({
                            product_ids, purchase_ids, row_quantities, row_unit_prices, selling_date, grand_total,discount
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
                                cancelButtonText: "Sell Again ?",
                            }).then(function (result) {
                                if (result.value) {
                                    $(location).attr("href", '/sales');
                                } else if (result.dismiss == 'cancel') {
                                    $(location).attr("href", '/sales/create');
                                }
                                $(this).removeAttr("disabled");
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
                $('#main_tbody').append(
                    '<tr>' +
                    '<td class="row_sl">1</td>' +
                    '<td class="p-0">' +
                    '<select class="select2 form-control p-0 m-0 row_product_id" style="width: 100%" name="state">' +
                    '<option value="0">Select Item</option>' +
                    option +
                    '</select>' +
                    '</td>' +
                    '<td class="p-0"> <select class="select2 form-control p-0 m-0 row_purchase_id" style="min-width: 150px"> </select> </td>' +
                    '<td class="p-0 "><input disabled class="form-control p-0 m-0 b-radius-0 text-center row_available_quantity" value="0" min="1" type="number"></td>' +
                    '<td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-center row_quantity" value="1" min="0" type="number"></td>' +
                    '<td class="p-0 "><input class="form-control p-0 m-0 b-radius-0 text-center row_unit_price" value="0" min="0"  type="number"></td>' +
                    '<td class="p-0  text-right"><input disabled class="form-control p-0 m-0 b-radius-0 text-center row_total" value="0.00" type="number"></td>' +
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

            $("#main_tbody").on('change', '.row_product_id', function () {
                var product_id = $(this).val();
                var row = $(this).closest('tr');
                row.find('.row_purchase_id').empty();
                row.find('.row_available_quantity').val(0);
                row.find('.row_unit_price').val(0);
                //get all info
                //alert(product_id);
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '/sales/product-info',
                    data: {
                        data: JSON.stringify({
                            product_id
                        })
                    },
                    cache: false,
                    success: function (objects) {
                        if (objects) {
                            console.log(objects);
                            if (objects.purchases.length != 0) {
                                var option = '';
                                $.each(objects.purchases, function (index, object) {
                                    option += '<option value="' + object.id + '">' + 'P. Invoice ID -' + object.purchase_invoice_id + '</option>'
                                });
                                row.find('.row_purchase_id').empty();
                                row.find('.row_purchase_id').append(option);
                                row.find('.row_available_quantity').val(objects.purchases[0].stock);
                                row.find('.row_unit_price').val(objects.unit_price);
                                updateRowPrice(row);
                            } else {
                                updateRowPrice(row);
                            }
                        }
                    }
                });
            });
            $("#main_tbody").on('change', '.row_purchase_id', function () {
                var row_purchase_id = $(this).val();
                var row = $(this).closest('tr');
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: '/sales/purchase-info',
                    data: {
                        data: JSON.stringify({
                            row_purchase_id
                        })
                    },
                    cache: false,
                    success: function (objects) {
                        if (objects) {
                            row.find('.row_available_quantity').val(objects.purchase_stock);
                        }
                    }
                });
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

                let total = 0;
                let discount =$('#discount').val() ;
                let row_totals = $('#main_tbody').find(".row_total").toArray();
                $.each(row_totals, function (index, row_total) {
                    total += eval($(row_total).val());
                });
                let grand_total = eval(total) - eval(discount);
                $('#total').html(formatterBdt.format(MathUtils.roundToPrecision(total, 2)));
                $('#grand_total').html(formatterBdt.format(MathUtils.roundToPrecision(grand_total, 2)));
                $('#total_hidden').val(MathUtils.roundToPrecision(total, 2));

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
