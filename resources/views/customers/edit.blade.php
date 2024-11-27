@extends('layouts.layout')
@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            @isset($title)
                <h5 class="card-title">{{$title}}</h5>
            @endisset
            <form class="" action="/customers/{{$customer->id}}" method="post">
                @method('put')
                {{csrf_field()}}
                <div class="position-relative form-group">
                    <label for="name" class="">Name</label>
                    <input name="name" id="name" placeholder="" type="text"
                           value="{{ old( 'name', $customer->name) }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <em class="error invalid-feedback">{{$errors->first('name')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="address" class="">Address</label>
                    <input name="address" id="address" placeholder="" type="text"
                           value="{{ old( 'address', $customer->address) }}"
                           class="form-control  @error('address') is-invalid @enderror">
                    @error('address')
                    <em class="error invalid-feedback">{{$errors->first('address')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="phone_number" class="">Phone Number</label>
                    <input name="phone_number" id="phone_number" placeholder="" type="text"
                           value="{{ old( 'phone_number', $customer->phone_number) }}"
                           class="form-control  @error('phone_number') is-invalid @enderror">
                    @error('phone_number')
                    <em class="error invalid-feedback">{{$errors->first('phone_number')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <input type="submit" value="Update" class="mt-2 btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection