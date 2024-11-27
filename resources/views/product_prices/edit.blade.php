@extends('layouts.layout')
@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            @isset($title)
                <h5 class="card-title">{{$title}}</h5>
            @endisset
            <form class="" action="/vendors/{{$vendor->id}}" method="post">
                @method('put')
                {{csrf_field()}}
                <div class="position-relative form-group">
                    <label for="title" class="">Title</label>
                    <input name="title" id="title" placeholder="" type="text"
                           value="{{ old( 'title', $vendor->title) }}"
                           class="form-control @error('title') is-invalid @enderror">
                    @error('title')
                    <em class="error invalid-feedback">{{$errors->first('title')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="company" class="">Company Name</label>
                    <input name="company" id="company" placeholder="" type="text"
                           value="{{ old( 'company', $vendor->company) }}"
                           class="form-control  @error('company') is-invalid @enderror">
                    @error('company')
                    <em class="error invalid-feedback">{{$errors->first('company')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="email" class="">Email</label>
                    <input name="email" id="email" placeholder="" type="email"
                           value="{{ old( 'email', $vendor->email) }}"
                           class="form-control @error('email') is-invalid @enderror">
                    @error('email')
                    <em class="error invalid-feedback">{{$errors->first('email')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="phone_number" class="">Phone</label>
                    <input name="phone_number" id="phone_number" placeholder="" type="text"
                           value="{{ old( 'phone_number', $vendor->phone_number) }}"
                           class="form-control @error('phone_number') is-invalid @enderror">
                    @error('phone_number')
                    <em class="error invalid-feedback">{{$errors->first('phone_number')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-group">
                    <label for="address" class="">Address</label>
                    <input name="address" id="address" placeholder="" type="text"
                           value="{{ old( 'address', $vendor->address) }}"
                           class="form-control @error('address') is-invalid @enderror">
                    @error('address')
                    <em class="error invalid-feedback">{{$errors->first('address')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-check">
                    @if(old( 'status', $vendor->status) ==1)
                        <input checked name="status" id="status" type="checkbox" class="form-check-input">
                    @else
                        <input name="status" id="status" type="checkbox" class="form-check-input">
                    @endif
                    <label for="status" class="form-check-label">Active</label>
                </div>
                <div class="position-relative form-group">
                    <input type="submit" value="Update" class="mt-2 btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection