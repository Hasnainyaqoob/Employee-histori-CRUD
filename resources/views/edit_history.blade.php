@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('content')
<div class="container">

    <h2 align="center">Add Employee History</h2>
    <a href="{{route('get_history',$employ->id)}}" class="btn btn-primary  my-3" >Back</a>
        <form action="{{route('update_history',$employ->id)}}" method="post">
            @csrf

            <div class="form-group">
            <label for="exampleInputEmail1">Company Name</label>
                <input type="text" name="company_name" value="{{$employ->company_name}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Job Title</label>
                <input type="text" name="job_title" value="{{$employ->job_title}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Company Contact</label>
                <input type="text" name="company_contact" value="{{$employ->company_contact}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Company email</label>
                <input type="text" name="company_email" value="{{$employ->company_email}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Salary</label>
                <input type="number" name="salary" value="{{$employ->salary}}" class="form-control" required/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Tax Deduction</label>
                <input type="number" name="tax" value="{{$employ->tax_dec}}" class="form-control" required/>
            </div>


            <button type="submit" class="btn btn-primary btn-sm mx-5">Update</button>
        </form>
</div>


@endsection
