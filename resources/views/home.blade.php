@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

@section('content')
<div class="container">
    <div class="container">
        <h2>Employees Table</h2>
        <table class="table">
            <thead>
                <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employ)
                <tr>
                <td> {{$employ->name}}</td>
                <td>{{$employ->email}}</td>
                <td><a href="{{route('get_history',$employ->id)}}" class="btn btn-primary btn-sm">View</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
