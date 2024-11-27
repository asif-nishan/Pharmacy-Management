@extends('layouts.layout')
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body">
                @isset($title)
                    <h5 class="card-title">{{$title}}</h5>
                @endisset
                <table class="mb-0 table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($customers as $key=> $customer)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$customer->name}}</td>
                            <td>{{$customer->address}}</td>
                            <td>{{$customer->phone_number}}</td>
                            <td>
                                <a href="{{"/customers/" .$customer->id ."/edit"}}"
                                   class="mt-2 btn btn-primary">Edit</a>
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