@extends('layouts.layout')
@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            @isset($title)
                <h5 class="card-title">{{$title}}</h5>
            @endisset
            <form class="" action="/products" method="post">
                {{csrf_field()}}
                <div class="position-relative form-group">
                    <label for="name" class="">Name</label>
                    <input name="name" id="name" placeholder="" type="text" value="{{ old('name') }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <em class="error invalid-feedback">{{$errors->first('name')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="weight" class="">Weight</label>
                    <input name="weight" id="weight" placeholder="" type="text" value="{{ old('weight') }}"
                           class="form-control @error('weight') is-invalid @enderror">
                    @error('weight')
                    <em class="error invalid-feedback">{{$errors->first('weight')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="unit_id" class="">Unit</label>
                    <select name="unit_id" id="unit_id"
                            class="form-control @error('unit_id') is-invalid @enderror">
                        @foreach($units as $unit)
                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                        @endforeach
                    </select>
                    @error('unit_id')
                    <em class="error invalid-feedback">{{$errors->first('unit_id')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="upc" class="">UPC</label>
                    <input name="upc" id="company" placeholder="" type="text" value="{{ old('upc') }}"
                           class="form-control  @error('upc') is-invalid @enderror">
                    @error('upc')
                    <em class="error invalid-feedback">{{$errors->first('upc')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="description" class="">Description (Optional)</label>
                    <input name="description" id="description" placeholder="" type="text" value="{{ old('description') }}"
                           class="form-control  @error('description') is-invalid @enderror">
                    @error('description')
                    <em class="error invalid-feedback">{{$errors->first('description')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="low_stock_amount" class="">Low Stock Alert</label>
                    <input name="low_stock_amount" id="low_stock_amount" placeholder="" type="number" value="{{ old('low_stock_amount',0) }}"
                           class="form-control  @error('low_stock_amount') is-invalid @enderror">
                    @error('low_stock_amount')
                    <em class="error invalid-feedback">{{$errors->first('low_stock_amount')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="brand_id" class="">Brand</label>
                    <select name="brand_id" id="brand_id"
                            class="form-control @error('brand_id') is-invalid @enderror">
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                    @error('brand_id')
                    <em class="error invalid-feedback">{{$errors->first('brand_id')}}
                    </em>
                    @enderror
                </div>

                <div class="position-relative form-group">
                    <label for="product_type_id" class="">Product Type</label>
                    <select name="product_type_id" id="product_type_id"
                            class="form-control @error('product_type_id') is-invalid @enderror">
                        @foreach($product_types as $product_type)
                            <option value="{{$product_type->id}}">{{$product_type->name}}</option>
                        @endforeach
                    </select>
                    @error('product_type_id')
                    <em class="error invalid-feedback">{{$errors->first('product_type_id')}}
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