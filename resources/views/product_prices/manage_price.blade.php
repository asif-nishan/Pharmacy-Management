@extends('layouts.layout')
{{--@section('css')--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">--}}
{{--@endsection--}}
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body table-responsive">
                @isset($title)
                    <h5 class="card-title">{{$title}}</h5>
                @endisset
                <table id="datatable" class="mb-0 table ">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>name</th>
                        <th>UPC</th>
{{--                        <th>Description</th>--}}
                        <th>Brand</th>
                        <th>Product Type</th>
                        <th>Selling Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key=> $product)
                        <tr>
                            <th scope="row">{{$key + $products->firstItem()}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->upc}}</td>
{{--                            <td>{{$product->description}}</td>--}}
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->productType->name}}</td>
                            <td>{{$product->getActivePrice()}}</td>
                            @if($product->status ==1)
                                <td>Active</td>
                                <td>
                                    <a href="{{"/product-prices/" .$product->id ."/create"}}"
                                       class="mt-2 btn btn-sm btn-success">Update Price</a>
                                    <a href="{{"/product-prices/" .$product->id}}"
                                       class="mt-2 btn btn-sm btn-primary">View Price History</a>
                                </td>
                            @else
                                <td>Deactivated</td>
                                <td>
                                    <button disabled class="mt-2 btn btn-sm btn-success">Update Price</button>
                                    <button disabled class="mt-2 btn btn-sm btn-primary">View Price History</button>
                                </td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$products->links()}}
            </div>
        </div>
    </div>
@endsection
{{--@section('script')--}}
{{--    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#datatable').DataTable();--}}
{{--        });--}}
{{--    </script>--}}
{{--@endsection--}}