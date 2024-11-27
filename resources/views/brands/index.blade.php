@extends('layouts.layout')
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body table-responsive">
                @isset($title)
                    <h5 class="card-title">{{$title}}</h5>
                @endisset
                <table class="mb-0 table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Brand Name</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $key=> $brand)
                        <tr>
                            <th scope="row">{{$key + $brands->firstItem()}}</th>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->status ==1?"Active":"Deactivated"}}</td>
                            <td>
                                <a href="{{"/brands/" .$brand->id ."/edit"}}" class="mt-2 btn btn-primary">Edit</a>
{{--                                <a class="mt-2 btn btn-danger">Delete</a>--}}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$brands->links()}}
            </div>
        </div>
    </div>
@endsection