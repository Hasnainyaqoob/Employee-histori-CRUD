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
    <a href="{{route('home')}}" class="btn btn-primary  my-3" >Back</a>
    <div class="form-group">

         <form action="{{route('post_history')}}" method="post">
            @csrf
            <input type="hidden" name="emp_id" value="{{$emp_id}}">


            <div class="table-responsive">

                <table class="table table-bordered" id="dynamic_field">

                    <tr>

                        <td>
                            <input type="text" name="company[0][company_name]" placeholder="Enter Company Name" class="form-control" required/>
                        </td>
                        <td>
                            <input type="text" name="country[0][country_name]" placeholder="Enter Country Name" class="form-control" required/>
                        </td>
                        <td>
                            <input type="text" name="company[0][company_email]" placeholder="Enter Company Email" class="form-control" required/>
                        </td>
                        <td>
                            <input type="text" name="company[0][company_contact]" placeholder="Enter Company Contact" class="form-control" required/>
                        </td>
                        <td>
                            <input type="text" name="company[0][company_department]" placeholder="Enter Company Departemnt" class="form-control" required/>
                        </td>
                        <td>
                            <input type="text" name="company[0][job_title]" placeholder="Enter Job Title" class="form-control" required/>
                        </td>
                        <td>
                            <input type="number" name="company[0][salary]" placeholder="Enter Salary" class="form-control" required/>
                        </td>
                        <td>
                            <input type="number" name="company[0][tax]" placeholder="Tax Deduction" class="form-control" required/>
                        </td>


                        <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>

                    </tr>

                </table>

                <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />

            </div>



         </form>

    </div>

</div>
<div class="container">
<a href="javascript:void(0)" onclick="globalFunctions.printContainer($('#printable'))" class="btn btn-primary float-right">Print</a>
<input type="text" id="searchInput" class="form-control w-25 float-right mr-2" placeholder="Search for records..">
    <div class="container table-responsive" id="printable">
        <h2>Employees History Table</h2>
        <table id="myTable" class="table table-striped table-hover">
            <thead>
                <tr>
                <th>#</th>
                <th>Company Name</th>
                <th>Company Email</th>
                <th>Company Phone</th>
                <th>Company Department</th>
                <th>Salary</th>
                <th>Tax Deduction(%)</th>
                <th>Net Salary</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employ)
                <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td> {{$employ->company_name}}</td>
                <td> {{$employ->company_email}}</td>
                <td> {{$employ->company_contact}}</td>
                <td> {{$employ->company_department}}</td>
                <td>{{$employ->salary}}</td>
                <td>{{$employ->tax_dec}}</td>
                <td>{{$employ->net_salary}}</td>
                <td>
                    <a href="{{route('edit_history',$employ->id)}}" class='btn btn-info btn-sm mx-2' >Edit</a>
                    <a href="{{route('delete_history',$employ->id)}}" onclick="return confirm('Are you sure you wish to delete this note forever? This action cannot be undone')" class='btn btn-danger btn-sm mx-2' >Delete</a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script>
                $(document).ready(function(){
                    $("#searchInput").on("keyup", function() {
                        var value = $(this).val().toLowerCase();
                        $("#myTable tbody tr").filter(function() {
                            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                        });
                    });
                });
            </script>
<script type="text/javascript">

    $(document).ready(function(){

      var postURL = "<?php echo url('addmore'); ?>";

      var i=0;

      $('#add').click(function(){

           i++;

           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="country['+ i +'][country_name]" placeholder="Enter Country Name" class="form-control" required/></td><td><input type="text" name="company['+ i +'][company_name]" placeholder="Enter Company Name" class="form-control" required/></td><td><input type="email" name="company['+ i +'][company_email]" placeholder="Enter Company Email" class="form-control" required/></td><td><input type="text" name="company['+ i +'][company_contact]" placeholder="Enter Company Contact" class="form-control" required/></td><td><input type="text" name="company['+ i +'][company_department]" placeholder="Enter Company Department" class="form-control" required/></td><td><input type="text" name="company['+ i +'][job_title]" placeholder="Enter Job Title" class="form-control" required /></td><td><input type="number" name="company['+ i +'][salary]" placeholder="Enter Salary" class="form-control" required /></td><td><input type="number" name="company['+ i +'][tax]" placeholder="Tax Deduction" class="form-control" required /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');

      });



      $(document).on('click', '.btn_remove', function(){

           var button_id = $(this).attr("id");

           $('#row'+button_id+'').remove();

      });



      $.ajaxSetup({

          headers: {

            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

      });




    });

</script>
<script>
                var globalFunctions = {
                printContainer: function(sel){
                    let divToPrint=sel[0];
                    let htmlToPrint = '' +
                        '<style type="text/css">' +
                        'table{width: 100%}' +
                        'table th.center, table td.center{text-align: center}' +
                        'table th, table td {border-right:1px solid #000;border-bottom:1px solid #000;padding;0.5em;}' +
                        '</style>';
                    let newWin=window.open('','Print-Window');
                    newWin.document.open();
                    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
                    newWin.document.write(htmlToPrint);
                    newWin.document.close();
                    setTimeout(function(){newWin.close();},10);
                }}
            </script>
@endsection
