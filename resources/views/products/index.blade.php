@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body table-responsive">
                @isset($title)
                    <h5 class="card-title">{{$title}}</h5>
                @endisset
                <table id="datatable" class="mb-0 table table-sm table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Weight</th>
                        <th>UPC</th>
                        <th class=".d-sm-none .d-md-block">Description</th>
                        <th>Brand</th>
                        <th >Product Type</th>
                        <th class=".d-sm-none .d-md-block">Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $key=> $product)
                        <tr>
                            <th scope="row">{{$key + 1}}</th>
                            <td>{{$product->name}}</td>
                            <td>{{$product->weight .' ' .$product->unit->name}}</td>
                            <td>{{$product->upc}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->productType->name}}</td>
                            <td>{{$product->status ==1?"Active":"Deactivated"}}</td>
                            <td>
                                <a href="{{"/products/" .$product->id ."/edit"}}" class="mt-2 btn btn-primary">Edit</a>
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
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection
