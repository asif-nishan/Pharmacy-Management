@extends('layouts.layout')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
@endsection
@section('content')
    <div class="col-lg-12">
        <div class="main-card mb-6 card">
            <div class="card-body"><h5 class="card-title">Vendor</h5>
                <table id="datatable" class="mb-0 table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Company Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($vendors as $key=> $vendor)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$vendor->title}}</td>
                            <td>{{$vendor->company}}</td>
                            <td>{{$vendor->address}}</td>
                            <td>{{$vendor->phone_number}}</td>
                            <td>{{$vendor->email}}</td>
                            <td>{{$vendor->status ==1?"Active":"Deactivated"}}</td>
                            <td>
                                <a href="{{"/vendors/" .$vendor->id ."/edit"}}" class="mt-2 btn btn-primary">Edit</a>
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
    {{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}


    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>

@endsection
