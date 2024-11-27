@extends('layouts.layout')
@section('content')
    <div class="main-card mb-3 card">
        <div class="card-body">
            @isset($title)
                <h5 class="card-title">{{$title}}</h5>
            @endisset
            <form class="" action="/brands/{{$brand->id}}" method="post">
                @method('put')
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$brand->id}}">
                <div class="position-relative form-group">
                    <label for="name" class="">Name</label>
                    <input name="name" id="name" placeholder="" type="text"
                           value="{{ old( 'name', $brand->name) }}"
                           class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                    <em class="error invalid-feedback">{{$errors->first('name')}}
                    </em>
                    @enderror
                </div>
                <div class="position-relative form-check">
                    @if(old( 'status', $brand->status) ==1)
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