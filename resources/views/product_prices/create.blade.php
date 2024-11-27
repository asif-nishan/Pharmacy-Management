@extends('layouts.layout')
@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">

            <h5 class="card-title">Update New Price - {{$product->name}}</h5>
            <form class="" action="/product-prices" method="post">
                {{csrf_field()}}
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="position-relative form-group">
                    <label for="selling_price" class="">New Selling Price</label>
                    <input name="selling_price" id="selling_price" placeholder="" type="number"
                           value="{{ old('selling_price') }}"
                           class="form-control @error('selling_price') is-invalid @enderror">
                    @error('selling_price')
                    <em class="error invalid-feedback">{{$errors->first('selling_price')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-check">
                    <input checked name="status" id="status" type="checkbox" class="form-check-input">
                    <label for="status" class="form-check-label">Active</label>
                </div>
                <div class="position-relative form-group">
                    <input type="submit" value="Create" class="mt-2 btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection