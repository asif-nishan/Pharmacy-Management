@extends('layouts.layout')
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body">
                <h5 class="card-title">Price History of - {{$product->name}} - {{$product->brand->name}}</h5>
                <table class="mb-0 table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Selling Price</th>
                        <th>Updated At</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($product_prices) == 0)
                        <tr>
                            <td class="text-center" colspan="4">No Data</td>
                        </tr>
                    @else
                        @foreach($product_prices as $key=> $product_price)
                            <tr>
                                <td scope="row">{{$key+1}}</td>
                                <td>{{$product_price->selling_price}}</td>
                                <td>{{\Carbon\Carbon::parse($product_price->updated_at)->format('d-M-Y')}}</td>
                                @if($product_price->status ==1)
                                    <td>
                                        <button class="mt-2 btn btn-sm btn-success" disabled>Activated</button>
                                    </td>
                                @else
                                    <td><a href="{{"/product-prices/" .$product_price->id ."/edit"}}"
                                           class="mt-2 btn btn-primary">Active</a></td>
                                @endif
                                <td>
                                    <a href="{{"/product-prices/" .$product_price->id ."/edit"}}"
                                       class="mt-2 btn btn-primary">Edit</a>
                                    {{--                                <a class="mt-2 btn btn-danger">Delete</a>--}}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="7" class="text-center">
                            <a href="/manage-prices" class="btn btn-info">Back To Manage Price</a>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection